<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Application\Model\ParticipanteTable;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Application\Model\RegiaoTable;
use Zend\Db\TableGateway\TableGateway;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    
    public function getServiceConfig()
    {
        return array(
        	'factories' => array(
        	    'RegiaoTable' => function($sm){
        	        $adapter = $sm->get('DbAdapter');
        	        $tableGateway = new TableGateway('regioes', $adapter);
        	        
        	        return new RegiaoTable($tableGateway);
        	    },
        	    'ParticipanteTable' => function($sm){
        	    	$adapter = $sm->get('DbAdapter');
        	    	$tableGateway = new TableGateway('participantes', $adapter);
        	    		
        	    	return new ParticipanteTable($tableGateway);
        	    }      
            )
        );
    }
}
