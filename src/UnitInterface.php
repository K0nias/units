<?php

namespace K0nias\Units;

interface UnitInterface
{
    public function getUnitType(): UnitTypeInterface;

    public function getValue(): float;

    public function hasSameType(UnitTypeInterface $unitType): bool;
}