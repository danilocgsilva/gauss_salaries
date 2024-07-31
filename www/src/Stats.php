<?php

namespace Danilocgsilva\Gauss;

class Stats
{
    /** @var PessoaSalario[] */
    private array $pessoasESalarios;
    
    public function __construct(array $pessoasESalarios, private int $split)
    {
        $this->pessoasESalarios = $pessoasESalarios;
    }

    public function get(): array
    {
        return $this->calcularRanges();
    }

    private function calcularRanges()
    {
        $maxValue = 20000;
        $ranges = [];
        $lower = 0;
        for ($i = 0; $i < (int) ($maxValue / $this->split); $i++) {
            $lower = $this->split * $i;
            $higher = $this->split * ($i + 1);
            $ranges[] = [
                'lower' => $lower, 
                'higher' => $higher,
                'range_title' => (string) $lower . " - " . (string) $higher,
                'pessoa_e_salario' => []
            ];
        }

        foreach ($this->pessoasESalarios as $pessoaSalario) {
            foreach ($ranges as $key => $range) {
                $lowerRangeString = (string) $range["lower"] . ".99";
                $higherRangeString = (string) $range["higher"] . ".99";
                $lowerRangeStringFloat = (float) $lowerRangeString;
                $higherRangeStringFloat = (float) $higherRangeString;
                if ($pessoaSalario->salario >= $lowerRangeStringFloat && $pessoaSalario->salario < $higherRangeStringFloat) {
                    $ranges[$key]["pessoa_e_salario"][] = $pessoaSalario;
                }
            }
        }

        return array_map(
            fn ($range) => [
                'range' => $range['range_title'],
                'quantidade' => count($range['pessoa_e_salario'])
            ],
            $ranges
        );
    }
}
