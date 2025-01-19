<?php

namespace Tests\Models;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;

use Caiquebispo\Tdd\Model\Leilao;
use Caiquebispo\Tdd\Model\Lance;
use Caiquebispo\Tdd\Model\Usuario;

class LeilaoTest extends TestCase
{
    #[DataProvider('gerarLances')]
    public function test_leilao_deve_receber_lances($qtdLances, Leilao $leilao, array $valores)
    {

        $this->assertCount($qtdLances, $leilao->getLances());

        foreach ($valores as $i => $valor) {
            $this->assertEquals($valor, $leilao->getLances()[$i]->getValor());
        }
    }
    public function test_leilao_nao_deve_receber_lances_repetidos()
    {

        $maria = new Usuario('Maria');

        $leilao = new Leilao('Honda Civic');

        $leilao->recebeLance(new Lance($maria, 1800));
        $leilao->recebeLance(new Lance($maria, 5000));

        $this->assertCount(1, $leilao->getLances());
        $this->assertEquals(1800, $leilao->getLances()[0]->getValor());
    }
    public function test_leilao_nao_pode_receber_mais_de_5_lances_do_mesmo_usuario()
    {

        $leilao = new Leilao('Honda POP 110');

        $joao = new Usuario('Joao');
        $maria = new Usuario('Maria');

        $leilao->recebeLance(new Lance($joao, 1500));
        $leilao->recebeLance(new Lance($maria, 2000));
        $leilao->recebeLance(new Lance($joao, 3500));
        $leilao->recebeLance(new Lance($maria, 4000));
        $leilao->recebeLance(new Lance($joao, 5500));
        $leilao->recebeLance(new Lance($maria, 6000));
        $leilao->recebeLance(new Lance($joao, 700));
        $leilao->recebeLance(new Lance($maria, 8000));
        $leilao->recebeLance(new Lance($joao, 9500));
        $leilao->recebeLance(new Lance($maria, 10000));

        $leilao->recebeLance(new Lance($joao, 11500));

        $this->assertCount(10, $leilao->getLances());
        $this->assertEquals(10000, $leilao->getLances()[array_key_last($leilao->getLances())]->getValor());
    }
    public static function gerarLances()
    {
        $joao = new Usuario('João');
        $maria = new Usuario('Maria');

        $leilaoCom2Lances = new Leilao('Fiat 147 0KM');

        $leilaoCom2Lances->recebeLance(new Lance($joao, 1000));
        $leilaoCom2Lances->recebeLance(new Lance($maria, 2000));

        $leilaoCom1Lance = new Leilao('Fusca 1972 0KM');

        $leilaoCom1Lance->recebeLance(new Lance($joao, 1000));

        return [
            '2-lances' => [2, $leilaoCom2Lances, [1000, 2000]],
            '1-lance' => [1, $leilaoCom1Lance, [1000]]
        ];
    }
}
