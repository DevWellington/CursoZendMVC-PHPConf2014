<?php

namespace Application\Model;

use Zend\Stdlib\RequestInterface;

class Participante
{
    public $codigo_partic;
    public $nome;
    /**
     * @var Regiao
     */
    public $regiao;
    public $codigo_regiao;
    
    public static function getFromRequest(RequestInterface $request)
    {
        $participante = new Participante();
        
        $participante->codigo_partic = $request->getPost('codigo_partic');
        $participante->nome = $request->getPost('nome');

        $participante->regiao = new Regiao();
        $participante->regiao->codigo = $request->getPost('regiao');

        $participante->codigo_regiao = $request->getPost('regiao');
        
        return $participante;
    }
    
    public function toArray()
    {
        // retorna um array dos atributos do objeto
        return get_object_vars($this);
    }
    
    public function getArrayCopy()
    {
        $set = $this->toArray();
//        $set['codigo_regiao'] = $this->regiao->nome;
//
//        unset($set['regiao']);

        return $set;
    }
    
}