<?php

namespace App\Enum;

use PhpCsFixer\Fixer\ClassNotation\SelfAccessorFixer;

enum UnitEnum: string
{

    case PIECE = 'piece';
    case HOUR = 'hour';
    case DAY = 'day';
    case MONTH = 'month';
    case YEAR = 'year';

    public function getLabel(): string
    {
        return match($this) {
            self::PIECE => 'Unité(s)',
            self::HOUR => 'Heure(s)',
            self::DAY => 'Jour(s)',
            self::MONTH => 'month',
            self::YEAR => 'year',
        };
    }
}