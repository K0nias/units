<?php

namespace K0nias\Units\Mass;

use K0nias\Units\UnitTypeInterface;

final class Type implements UnitTypeInterface
{
    public const TYPE_MILLIGRAM = 'milligram';
    public const TYPE_GRAM = 'gram';
    public const TYPE_KILOGRAM = 'kilogram';

    protected const AVAILABLE_TYPES = [
        self::TYPE_MILLIGRAM,
        self::TYPE_GRAM,
        self::TYPE_KILOGRAM,
    ];

    /**
     * @var string
     */
    private $type;

    public function __construct(string $type)
    {
        $type = strtolower($type);

        $this->validType($type);

        $this->type = $type;
    }

    protected function validType(string $type)
    {
        if ( ! in_array($type, self::AVAILABLE_TYPES)) {
            throw new \RuntimeException('Invalid type');
        }
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function isSameType(UnitTypeInterface $unitType): bool
    {
        return $this->type === $unitType->getType();
    }
}