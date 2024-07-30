<?php

namespace Danilocgsilva\Gauss;

class PessoaSalario
{
    public function __construct(
        public readonly string $nome,
        public readonly float $salario,
    ) {}
}
