<?php
use Danilocgsilva\Gauss\Pair;
use Danilocgsilva\Gauss\PessoaSalario;

require_once ("../vendor/autoload.php");

use Danilocgsilva\Gauss\SalaryFaker;
use Danilocgsilva\Gauss\Stats;

$twig = new \Twig\Environment(
    new \Twig\Loader\FilesystemLoader('../views')
);

$twig->addFilter(
    new \Twig\TwigFilter('filtro1', function (float $amount) {
        return "R$ " . number_format(
                $amount,
                2,
                ",",
                "."
            );
    })
);

$faker = \Faker\Factory::create();

/** @var \Danilocgsilva\Gauss\PessoaSalario[] */
$pessoasESeusSalarios = [];

for ($i = 0; $i < 100; $i++) {
    $pessoasESeusSalarios[] = new PessoaSalario(
        $faker->name,
        SalaryFaker::amount()
    );
}

print(
    $twig->render('index.twig', [
        'pessoas_e_seus_salarios' => $pessoasESeusSalarios,
        'stats' => (new Stats($pessoasESeusSalarios))->get(),
        'total_pessoas' => count($pessoasESeusSalarios)
    ])
);
