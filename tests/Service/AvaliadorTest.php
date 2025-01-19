<?php

namespace Tests\Service;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;

use Caiquebispo\Tdd\Model\Leilao;
use Caiquebispo\Tdd\Model\Usuario;
use Caiquebispo\Tdd\Model\Lance;
use Caiquebispo\Tdd\Service\Avaliador;

class AvaliadorTest extends TestCase
{

    #[DataProvider('leiloesParaTestar')]
    public function test_encontra_maior_valor_do_lance(Leilao $leilao)
    {
        // Act - When
        $avaliador = new Avaliador();

        $avaliador->avalia($leilao);

        // Assert - Then
        self::assertEquals(3000, $avaliador->getMaiorLance());
    }
    #[DataProvider('leiloesParaTestar')]
    public function test_encontra_menor_valor_do_lance(Leilao $leilao)
    {
        // Act - When
        $avaliador = new Avaliador();

        $avaliador->avalia($leilao);

        // Assert - Then
        self::assertEquals(1000, $avaliador->getMenorLance());
    }
    #[DataProvider('leiloesParaTestar')]
    public function test_encontra_tres_maiores_lances(Leilao $leilao)
    {

        $avaliador = new Avaliador();

        $avaliador->avalia($leilao);

        // Assert - Then
        self::assertCount(3, $avaliador->getMaioresLances());
        self::assertEquals(3000, $avaliador->getMaioresLances()[0]->getValor());
        self::assertEquals(2500, $avaliador->getMaioresLances()[1]->getValor());
        self::assertEquals(2000, $avaliador->getMaioresLances()[2]->getValor());
    }
    public static function leilaoEmOrdemCrescente()
    {
        $leilao = new Leilao('Fiat 147 0KM');

        $joao = new Usuario('João');
        $jose = new Usuario('José');
        $ana = new Usuario('Ana');
        $maria = new Usuario('Maria');

        $leilao->recebeLance(new Lance($joao, 1000));
        $leilao->recebeLance(new Lance($jose, 2000));
        $leilao->recebeLance(new Lance($ana, 3000));
        $leilao->recebeLance(new Lance($maria, 2500));

        return [
            [$leilao]
        ];
    }
    public static function leilaoEmOrdemDecrescente()
    {
        $leilao = new Leilao('Fiat 147 0KM');

        $joao = new Usuario('João');
        $jose = new Usuario('José');
        $ana = new Usuario('Ana');
        $maria = new Usuario('Maria');

        $leilao->recebeLance(new Lance($maria, 3000));
        $leilao->recebeLance(new Lance($ana, 2500));
        $leilao->recebeLance(new Lance($jose, 2000));
        $leilao->recebeLance(new Lance($joao, 1000));

        return [
            [$leilao]
        ];
    }
    public static function leilaoEmOrdemAleatoria()
    {
        $leilao = new Leilao('Fiat 147 0KM');

        $joao = new Usuario('João');
        $jose = new Usuario('José');
        $ana = new Usuario('Ana');
        $maria = new Usuario('Maria');

        $leilao->recebeLance(new Lance($ana, 3000));
        $leilao->recebeLance(new Lance($maria, 2500));
        $leilao->recebeLance(new Lance($joao, 1000));
        $leilao->recebeLance(new Lance($jose, 2000));

        return [
            [$leilao]
        ];
    }
    public static function leiloesParaTestar()
    {
        return array_merge(
            self::leilaoEmOrdemCrescente(),
            self::leilaoEmOrdemDecrescente(),
            self::leilaoEmOrdemAleatoria()
        );
    }
}
