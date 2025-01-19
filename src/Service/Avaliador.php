<?php

namespace Caiquebispo\Tdd\Service;

use Caiquebispo\Tdd\Model\Leilao;

class Avaliador
{
    private $maiorLance = 0;
    
    public function avalia(Leilao $leilao){

        $laces = $leilao->getLances();
        $this->maiorLance = $laces[count($laces) - 1]->getValor();
    }

    public function getMaiorLance(): float
    {
        return $this->maiorLance;
    }
}
