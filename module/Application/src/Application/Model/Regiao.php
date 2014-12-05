<?php

namespace Application\Model;

use Zend\Stdlib\RequestInterface;

class Regiao
{
    public $codigo;
    public $nome;
    
    public static function getFromRequest(RequestInterface $request)
    {
        $regiao = new Regiao();
        
        $regiao->codigo = $request->getPost('codigo');
        $regiao->nome = $request->getPost('nome');
        
        return $regiao;
    }
    
    public function toArray()
    {
        // retorna um array dos atributos do objeto
        return get_object_vars($this);
    }
    
    public function getArrayCopy()
    {
        return $this->toArray();
    }
    
}