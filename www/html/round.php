<?php

require_once ("../vendor/autoload.php");

$entity1 = "17.000002";
$entity2 = "1";
$entity3 = "17.000001";

$entity1Float = (float) $entity1;
$entity2Float = (float) $entity2;
$entity3Float = (float) $entity3;

$resultado = $entity1Float + $entity2Float - $entity3Float;

$twig = new \Twig\Environment(
    new \Twig\Loader\FilesystemLoader('../views')
);

print(
    $twig->render('round.twig', [
        'entity1' => $entity1,
        'entity2' => $entity2,
        'entity3' => $entity3,
        'entity1Float' => $entity1Float,
        'entity2Float' => $entity2Float,
        'entity3Float' => $entity3Float,
        'resultado' => $resultado,
    ])
);

print($resultado);