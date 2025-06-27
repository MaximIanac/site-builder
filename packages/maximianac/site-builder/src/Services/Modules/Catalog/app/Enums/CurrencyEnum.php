<?php

namespace Maximianac\SiteBuilder\Services\Modules\Catalog\app\Enums;

enum CurrencyEnum: string
{
    case USD = 'USD';
    case EUR = 'EUR';
    case MDL = 'MDL';

    public function symbol(): string
    {
        return match ($this) {
            self::USD => '$',
            self::EUR => '€',
            self::MDL => 'L',
        };
    }
}
