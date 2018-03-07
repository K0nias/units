<?php

namespace K0nias\Units;

interface UnitTypeInterface
{
    public function getType(): string;

    public function isSameType(UnitTypeInterface $unitType): bool;
}