<?php

namespace Application\Form;

use Zend\Form\Element\Select;
use Zend\Form\Form;
use Zend\Form\Element\Text;
use Zend\Form\Element\Hidden;
use Zend\Form\Element\Submit;

class Participante extends Form
{

    public function __construct($name = 'participante', array $options = array())
    {
        parent::__construct($name, $options);
        
        // Method of form
        $this->setAttribute('method', 'post');

        // Input
        $elementOrFieldset = new Text('nome');
        $elementOrFieldset->setLabel('Nome:');
        $elementOrFieldset->setAttribute('autofocus', 'autofocus');
        
        $this->add($elementOrFieldset);
        
        // Field Hidden
        $elementOrFieldset = new Hidden('participantes_codigo');

        $this->add($elementOrFieldset);


        // Input Codigo Regiao
        $elementOrFieldset = new Text('codigo_regiao');
        $elementOrFieldset->setLabel('Codigo Regiao');

        $this->add($elementOrFieldset);

        // Input nome regiao
        $elementOrFieldset = new Text('regiao');
        $elementOrFieldset->setLabel('Nome Regiao:');
        $elementOrFieldset->setAttributes(['readonly' => 'readonly']);
        
        $this->add($elementOrFieldset);
        
        // Button
        $elementOrFieldset = new Submit('gravar');
        $elementOrFieldset->setValue('Gravar');
        
        $this->add($elementOrFieldset);
        
    }
    

}
