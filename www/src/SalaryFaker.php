<?php

namespace Danilocgsilva\Gauss;

class SalaryFaker
{
    public static function amount(): float
    {
        return rand(140000, 2000000) / 100;
    }
}
