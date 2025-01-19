<?php

namespace Caiquebispo\Tdd\Service;

use Caiquebispo\Tdd\Model\Leilao;
use Caiquebispo\Tdd\Model\Lance;

class Avaliador
{
    private $maiorLance = -INF;
    private $menorLance = INF;
    private $maioresLances;

    public function avalia(Leilao $leilao)
    {

        $laces = $leilao->getLances();

        foreach ($laces as $lance) {
            if ($lance->getValor() > $this->maiorLance) {
                $this->maiorLance = $lance->getValor();
            }

            if ($lance->getValor() < $this->menorLance) {
                $this->menorLance = $lance->getValor();
            }
        }

        $laces = $leilao->getLances();

        usort($laces, function (Lance $lance1, Lance $lance2) {
            return $lance2->getValor() - $lance1->getValor();
        });

        $this->maioresLances = array_slice($laces, 0, 3);
    }

    public function getMaiorLance(): float
    {
        return $this->maiorLance;
    }

    public function getMenorLance(): float
    {
        return $this->menorLance;
    }

    public function getMaioresLances(): array
    {
        return $this->maioresLances;
    }
}
