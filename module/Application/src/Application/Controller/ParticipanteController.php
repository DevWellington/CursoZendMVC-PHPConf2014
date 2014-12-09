<?php

namespace Application\Controller;

use Application\Form\Regiao;
use Zend\Mvc\Controller\AbstractActionController;
use Application\Form\Participante as ParticipanteForm;
use Application\Model\Participante;

/**
 * ParticipanteController
 *
 * @author
 *
 * @version
 *
 */
class ParticipanteController extends AbstractActionController
{

    /**
     * The default action - show the home page
     */
    public function indexAction()
    {
        $models = $this->getTable('Participante')->getModels();

        return ['models'=>$models];
    }
    
    public function editAction()
    {
        $key = $this->params('key');

        if (isset($key))
            $model = $this
                ->getTable('Participante')
                ->getModel($key)
            ;

        $form = new ParticipanteForm();
        $form->setAttribute(
            'action',
            $this->url()->fromRoute(
                'application/default',
                array(
        	        'controller' => 'participante',
                    'action' => 'save'
                )
            )
        );

        $modelRegiao = $this->getTable('Regiao')->getModels();

        $arrayOptions = $modelRegiao->toArray();
        $arrayOptionsCorrigido = [];
        foreach($arrayOptions as $key => $value)
            $arrayOptionsCorrigido[$value['codigo']] = $value['nome'];

        $form->get('select_regiao')->setValueOptions($arrayOptionsCorrigido);
        $form->get('select_regiao')
            ->setValue(
                $form->get('codigo_regiao')
            )
        ;

        if (isset($model))
            $form->bind($model);

        return ['form' => $form];
    }
    
    public function saveAction()
    {
        $participante = Participante::getFromRequest(
            $this->getRequest()
        );

        $this->getTable('Participante')->save($participante);
        
        return $this->redirect()->toRoute(
            'application/default',
            array(
                'controller' => 'participante'
            )
        );

    }

    public function deleteAction()
    {
    	$key = $this->params('key');

    	$this->getTable('Participante')->delete($key);
    	
    	return $this->redirect()->toRoute(
            'application/default',
            array(
                'controller' => 'participante'
            )
        );
    }
    
    private function getTable($name)
    {
        return $this->getServiceLocator()->get($name.'Table');
    }
}