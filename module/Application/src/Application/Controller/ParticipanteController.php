<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
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

        // TODO Auto-generated RegiaoController::indexAction() default action
        return ['models'=>$models];
    }
    
    public function editAction()
    {
        $key = $this->params('key');

        $model = $this->getTable('Participante')
            ->getModel($key);

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