<?php

namespace Application\Form;

use Zend\Form\Form;
use Zend\Form\Element\Text;
use Zend\Form\Element\Hidden;
use Zend\Form\Element\Submit;

class Regiao extends Form
{

    public function __construct($name = 'regiao', array $options = array())
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
        $elementOrFieldset = new Hidden('codigo');
        
        $this->add($elementOrFieldset);
        
        // Button
        $elementOrFieldset = new Submit('gravar');
        $elementOrFieldset->setValue('Gravar');
        
        $this->add($elementOrFieldset);
        
    }
    
    
    
    
}
