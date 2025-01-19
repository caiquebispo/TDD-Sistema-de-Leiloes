<?php

namespace Caiquebispo\Tdd\Model;

use Caiquebispo\Tdd\Model\Lance;

class Leilao
{
    /** @var Lance[] */
    private $lances;
    /** @var string */
    private $descricao;

    public function __construct(string $descricao)
    {
        $this->descricao = $descricao;
        $this->lances = [];
    }

    public function recebeLance(Lance $lance)
    {
        if (!empty($this->lances) && $this->jaTemLanceDoUsuario($lance)) {
            return;
        }
        $this->lances[] = $lance;
    }
    private function jaTemLanceDoUsuario(Lance $lance)
    {
        return $this->lances[array_key_last($this->lances)]->getUsuario() == $lance->getUsuario();
    }
    /**
     * @return Lance[]
     */
    public function getLances(): array
    {
        return $this->lances;
    }
}
