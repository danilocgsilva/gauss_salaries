<?php

namespace Danilocgsilva\Gauss;

use GuzzleHttp\Client as HttpClient;
use Faker\Generator as FakerGenerator;

class Gerador
{
    private FakerGenerator $faker;

    public function __construct()
    {
        $this->faker = \Faker\Factory::create();
    }

    /**
     * @return \Danilocgsilva\Gauss\PessoaSalario[]
     */
    public function phpPessoas(): array
    {
        /** @var \Danilocgsilva\Gauss\PessoaSalario[] */
        $pessoasESeusSalarios = [];
        for ($i = 0; $i < 100; $i++) {
            $pessoasESeusSalarios[] = new PessoaSalario(
                $this->faker->name,
                SalaryFaker::amount()
            );
        }
        return $pessoasESeusSalarios;
    }

    public function pythonPessoas(): array
    {
        return array_map(
            fn ($entry) => new PessoaSalario($entry->nome, $entry->salario),
            json_decode(
                (
                    (new HttpClient())->request(
                        'GET',
                        "http://pythonenvgauss:5000"
                    )
                )
                ->getBody()
                ->getContents()
            )
        );
    }
}
