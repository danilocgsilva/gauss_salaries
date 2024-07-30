<?php

namespace Danilocgsilva\Gauss;

class Pair
{
    public function __construct(
        public readonly string $key, 
        public readonly string $value
    ) {}
}
