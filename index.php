<?php

use Caiquebispo\Tdd\Model\Usuario;
use Caiquebispo\Tdd\Model\Lance;
use Caiquebispo\Tdd\Model\Leilao;
use Caiquebispo\Tdd\Service\Avaliador;

require_once 'vendor/autoload.php';

$leilao = new Leilao('Fiat 147 0KM');

$joao = new Usuario('João');
$jose = new Usuario('José');

$lanceJoao = new Lance($joao, 1000);
$lanceJose = new Lance($jose, 2000);

$leilao->recebeLance($lanceJoao);
$leilao->recebeLance($lanceJose);

$avaliador = new Avaliador();

$avaliador->avalia($leilao);

echo "O maior lance foi de: " . $avaliador->getMaiorLance() . PHP_EOL;
