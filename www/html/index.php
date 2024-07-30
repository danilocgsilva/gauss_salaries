<?php
use Danilocgsilva\Gauss\Gerador;
use Danilocgsilva\Gauss\Stats;

require_once ("../vendor/autoload.php");





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

$gerador = new Gerador();

/** @var \Danilocgsilva\Gauss\PessoaSalario[] */
$pessoasESeusSalarios = $gerador->phpPessoas();

/** @var \Danilocgsilva\Gauss\PessoaSalario[] */
$pessoasESalariosDoPython = $gerador->pythonPessoas();

print(
    $twig->render('index.twig', [
        'pessoas_e_seus_salarios' => $pessoasESeusSalarios,
        'pessoas_e_seus_salarios_python' => $pessoasESalariosDoPython,
        'stats' => (new Stats($pessoasESeusSalarios))->get(),
        'total_pessoas' => count($pessoasESeusSalarios)
    ])
);
