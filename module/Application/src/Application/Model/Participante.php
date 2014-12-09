<?php

namespace Application\Model;

use Zend\Stdlib\RequestInterface;

class Participante
{
    public $participantes_codigo;
    public $nome;
    /**
     * @var Regiao
     */
    public $regiao;

    public static function getFromRequest(RequestInterface $request)
    {
        $participante = new Participante();

        $participante->participantes_codigo = $request->getPost('participantes_codigo');
        $participante->nome = $request->getPost('nome');

        $participante->regiao = new Regiao();
        $participante->regiao->codigo = $request->getPost('select_regiao');

        return $participante;
    }
    
    public function toArray()
    {
        // retorna um array dos atributos do objeto
        $toArray = get_object_vars($this);
        $toArray['codigo_regiao'] = $this->regiao->codigo;
        $toArray['codigo'] = $this->participantes_codigo;
        unset($toArray['regiao']);
        unset($toArray['participantes_codigo']);

        return $toArray;
    }
    
    public function getArrayCopy()
    {
        return $this->toArray();
    }
    
}