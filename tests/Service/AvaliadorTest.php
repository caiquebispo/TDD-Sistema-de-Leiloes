<?php

namespace Tests\Service;

use PHPUnit\Framework\TestCase;
use Caiquebispo\Tdd\Model\Leilao;
use Caiquebispo\Tdd\Model\Usuario;
use Caiquebispo\Tdd\Model\Lance;
use Caiquebispo\Tdd\Service\Avaliador;

class AvaliadorTest extends TestCase
{
    public function test_encontra_maior_lance_de_forma_crescente()
    {
        // Arrange - Given
        $leilao = new Leilao('Fiat 147 0KM');

        $joao = new Usuario('João');
        $jose = new Usuario('José');

        $leilao->recebeLance(new Lance($joao, 1000));
        $leilao->recebeLance(new Lance($jose, 2000));

        // Act - When
        $avaliador = new Avaliador();

        $avaliador->avalia($leilao);

        // Assert - Then
        self::assertEquals(2000, $avaliador->getMaiorLance());
    }

    public function test_encontra_maior_lance_de_forma_decrescente()
    {
        // Arrange - Given
        $leilao = new Leilao('Fiat 147 0KM');

        $joao = new Usuario('João');
        $jose = new Usuario('José');

        $leilao->recebeLance(new Lance($joao, 2000));
        $leilao->recebeLance(new Lance($jose, 1000));

        // Act - When
        $avaliador = new Avaliador();

        $avaliador->avalia($leilao);

        // Assert - Then
        self::assertEquals(2000, $avaliador->getMaiorLance());
    }
}
