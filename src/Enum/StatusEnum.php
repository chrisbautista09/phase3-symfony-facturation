<?php

namespace App\Enum;

use

PhpCsFixer\Fixer\ClassNotation\SelfAccessorFixer;

    enum StatusEnum: string
    {

        case DRAFT = 'draft';
        case PENDING_PAYMENT = 'pending_payment';
        case PAID = 'paid';

        public function getLabel(): string
        {
            return match($this) {
                self::PENDING_PAYMENT => 'pending_payment',
                self::DRAFT => 'draft',
                self::PAID => 'paid',
            };
        }
    }
?>