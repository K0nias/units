<?php

namespace K0nias\Units\Mass;

use K0nias\Units\ConverterInterface;
use K0nias\Units\Mass\Converter;
use K0nias\Units\UnitInterface;
use K0nias\Units\UnitTypeInterface;

class Mass implements UnitInterface
{
    /**
     * @var float
     */
    private $value;
    /**
     * @var Type
     */
    private $unit;
    /**
     * @var ConverterInterface
     */
    private $converter;

    public function __construct(float $value, Type $unit, ConverterInterface $converter = null)
    {
        $this->value = $value;
        $this->unit = $unit;
        $this->converter = $converter ?: new Converter();
    }

    public function convertTo(UnitTypeInterface $unit): UnitInterface
    {
        return $this->converter->convert($this, $unit);
    }

    public function hasSameType(UnitTypeInterface $unit): bool
    {
        return $this->unit->isSameType($unit);
    }

    public function getValue(): float
    {
        return $this->value;
    }

    public function getUnitType(): UnitTypeInterface
    {
        return $this->unit;
    }


}