<?php

namespace Caiquebispo\Tdd\Service;

use Caiquebispo\Tdd\Model\Leilao;
use Caiquebispo\Tdd\Model\Lance;

class Avaliador
{
    private $maiorLance = -INF;

    public function avalia(Leilao $leilao)
    {

        $laces = $leilao->getLances();

        foreach ($laces as $lance) {
            if ($lance->getValor() > $this->maiorLance) {
                $this->maiorLance = $lance->getValor();
            }
        }
    }

    public function getMaiorLance(): float
    {
        return $this->maiorLance;
    }
}
