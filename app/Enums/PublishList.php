<?php

namespace App\Enums;

// サービスフラグ
enum PublishList: int
{
    case ISNOT_PUBLISHED = 0;
    case IS_PUBLISHED = 1;

    public function getLabel(): string
    {
        return match ($this) {
            self::ISNOT_PUBLISHED => '非公開',
            self::IS_PUBLISHED => '公開',
        };
    }

    public static function getKeys(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function getLabels(): array
    {
        return array_map(fn($case) => $case->getLabel(), self::cases());
    }

    public static function toArray(): array
    {
        return array_combine(self::getKeys(), self::getLabels());
    }

    public static function fromLabel(string $label): ?int
    {
        foreach (self::cases() as $case) {
            if ($case->getLabel() === $label) {
                return $case->value;
            }
        }

        return null;
    }
}
