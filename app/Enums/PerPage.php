<?php

namespace App\Enums;

// 表示件数
enum PerPage: int
{
    public const NEWS_LIST = 10;
    case Ten = 5;
    case Twenty = 0;
    case Fifty = 1;
    case Hundred = 2;
    case TwoHundred = 3;
    case ThreeHundred = 4;
    // 追加：ニュース一覧の既定を 10 件に


    // 10件を選択肢にも出したい場合は追加（任意）

    public function getLabel(): int
    {
        return match ($this) {
            self::Ten => 10,
            self::Twenty => 20,
            self::Fifty => 50,
            self::Hundred => 100,
            self::TwoHundred => 200,
            self::ThreeHundred => 300,
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
