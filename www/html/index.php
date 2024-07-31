<?php

use Danilocgsilva\Gauss\Gerador;
use Danilocgsilva\Gauss\Stats;

require_once ("../vendor/autoload.php");

$count = (int) filter_var($_GET["count"]) ?: 100;
$split = (int) filter_var($_GET["split"]) ?: 1000;

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

$gerador = new Gerador($count);

/** @var \Danilocgsilva\Gauss\PessoaSalario[] */
$pessoasESeusSalarios = $gerador->getPessoasESalarios();

print(
    $twig->render('index.twig', [
        'pessoas_e_seus_salarios' => $pessoasESeusSalarios,
        'pessoas_e_seus_salarios_python' => $pessoasESalariosDoPython,
        'stats' => (new Stats($pessoasESeusSalarios, $split))->get(),
        'total_pessoas' => count($pessoasESeusSalarios)
    ])
);
