<?php

namespace K0nias\Units\Mass;

use K0nias\Units\ConverterInterface;
use K0nias\Units\UnitInterface;
use K0nias\Units\UnitTypeInterface;

class Converter implements ConverterInterface
{
    protected const CONVERT_MAP_TO_BASIC = [
        Type::TYPE_MILLIGRAM => 1,
        Type::TYPE_GRAM => 1e3,
        Type::TYPE_KILOGRAM => 1e6,
    ];


    public function convertToBaseUnit(UnitInterface $mass): UnitInterface
    {
        $baseType = $this->createBaseType();

        if ($mass->hasSameType($baseType)) {
            return clone $mass;
        }

        $coefficient = $this->getConvertCoefficientToBasic($mass->getUnitType());

        return new Mass($mass->getValue() * $coefficient, $baseType, $this);
    }

    protected function getConvertCoefficientToBasic(UnitTypeInterface $type): int
    {
        if ( ! key_exists($type->getType(), self::CONVERT_MAP_TO_BASIC)) {
            throw new \RuntimeException('Missing type for conversion');
        }

        return self::CONVERT_MAP_TO_BASIC[$type->getType()];
    }

    protected function createBaseType(): Type
    {
        return new Type(Type::TYPE_MILLIGRAM);
    }

    public function convert(UnitInterface $mass, UnitTypeInterface $destinationUnitType): UnitInterface
    {
        if ($mass->hasSameType($destinationUnitType)) {
            return clone $mass;
        }

        $basicCoefficient = $this->getConvertCoefficientToBasic($mass->getUnitType());
        $destinationCoefficient = $this->getConvertCoefficientToBasic($destinationUnitType);

        return new Mass(($mass->getValue() * $basicCoefficient) / $destinationCoefficient, $destinationUnitType, $this);
    }
}