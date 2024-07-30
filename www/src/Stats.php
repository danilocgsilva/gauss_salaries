<?php

namespace Danilocgsilva\Gauss;

class Stats
{
    /** @var PessoaSalario[] */
    private array $pessoasESalarios;
    
    public function __construct(array $pessoasESalarios)
    {
        $this->pessoasESalarios = $pessoasESalarios;
    }

    public function get(): array
    {
        return $this->calcularRanges();
    }

    private function calcularRanges()
    {
        // $range1 = [];
        // $range2 = [];
        // $range3 = [];
        // $range4 = [];
        $ranges = [];
        $lower = 0;
        $amountIteration = 5000;
        for ($i = 0; $i < 4; $i++) {
            $lower = $lower + ($i * $amountIteration);
            $higher = ($i + 1) * $amountIteration;
            $ranges[] = [$lower, $higher];
        }

        foreach ($this->pessoasESalarios as $pessoaSalario) {
            if ($pessoaSalario->salario < 5000.99) {
                $range1[] = $pessoaSalario;
            }
            elseif ($pessoaSalario->salario >= 5000.99 && $pessoaSalario->salario < 10000.99) {
                $range2[] = $pessoaSalario;
            }
            elseif ($pessoaSalario->salario >= 10000.99 && $pessoaSalario->salario < 15000.99) {
                $range3[] = $pessoaSalario;
            }
            elseif ($pessoaSalario->salario >= 15000.99) {
                $range4[] = $pessoaSalario;
            }
        }
        
        return [
            [
                'range' => '1000 - 5000',
                'quantidade' => count($range1)
            ],
            [
                'range' => '5001 - 10.000',
                'quantidade' => count($range2)
            ],
            [
                'range' => '10.001 - 15.000',
                'quantidade' => count($range3)
            ],
            [
                'range' => '15.001 - 20.000',
                'quantidade' => count($range4)
            ]
        ];
    }
}
