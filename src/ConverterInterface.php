<?php

namespace K0nias\Units;

interface ConverterInterface
{
    public function convertToBaseUnit(UnitInterface $unit): UnitInterface;

    public function convert(UnitInterface $unit, UnitTypeInterface $destinationUnitType): UnitInterface;
}