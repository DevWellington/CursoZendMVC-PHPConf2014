<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Form\Regiao as RegiaoForm;
use Application\Model\Regiao;

/**
 * RegiaoController
 *
 * @author
 *
 * @version
 *
 */
class RegiaoController extends AbstractActionController
{

    /**
     * The default action - show the home page
     */
    public function indexAction()
    {
        $models = $this->getTable('Regiao')->getModels(); 
        
        // TODO Auto-generated RegiaoController::indexAction() default action
        return ['models'=>$models];
    }
    
    public function editAction()
    {
        $key = $this->params('key');
        
        $model = $this->getTable('Regiao')
            ->getModel($key);
        
        $form = new RegiaoForm();
        $form->setAttribute(
            'action', 
            $this->url()->fromRoute(
                'application/default',
                array(
        	        'controller' => 'regiao',
                    'action' => 'save'
                )
            )
        );
        
        $form->bind($model);
        
        return ['form' => $form];
    }
    
    public function saveAction()
    {
        $regiao = Regiao::getFromRequest(
            $this->getRequest()
        );

        $this->getTable('Regiao')->save($regiao);
        
        return $this->redirect()->toRoute(
            'application/default',
            array(
                'controller' => 'regiao'
            )
        );

    }

    public function deleteAction()
    {
    	$key = $this->params('key');
        
    	$model = $this->getTable('Regiao')
    	   ->delete($key);
    	
    	return $this->redirect()->toRoute(
            'application/default',
            array(
                'controller' => 'regiao'
            )
        );
    
    }
    
    private function getTable($name)
    {
        return $this->getServiceLocator()->get($name.'Table');
    }
}