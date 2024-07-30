<?php

namespace Danilocgsilva\Gauss;

use GuzzleHttp\Client as HttpClient;
use Faker\Generator as FakerGenerator;

class Gerador
{
    private FakerGenerator $faker;

    public function __construct(private int $count)
    {
        $this->faker = \Faker\Factory::create();
    }

    /**
     * @return \Danilocgsilva\Gauss\PessoaSalario[]
     */
    public function getPessoasESalarios(): array
    {
        return array_map(
            fn ($entry) => new PessoaSalario($this->faker->name, $entry),
            $this->getNormalDistribuition()
        );
    }

    public function getNormalDistribuition(): array
    {
        return json_decode(
            (
                (new HttpClient())->request(
                    'GET',
                    "http://pythonenvgauss:5000/normal",
                    [
                        'query' => [
                            'count' => $this->count
                        ]
                    ]
                )
            )
                ->getBody()
                ->getContents()
        );
    }
}
