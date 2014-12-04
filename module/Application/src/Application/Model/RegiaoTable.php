<?php

namespace Application\Model;

use Zend\Db\TableGateway\TableGatewayInterface;

class RegiaoTable
{
    /**
     * @var TableGatewayInterface 
     */
    private $tableGateway;
    
    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }
    
    public function save($model)
    {
        $set = $model->toArray();
        
        if(empty($model->codigo)){
            $this->tableGateway->insert($set);
        } else {
            $where = array(
            	'codigo' => $model->codigo,
            );

            $this->tableGateway->update($set, $where);
        } 
    }
    
    public function getModels($where = null)
    {
        return $this->tableGateway->select($where);
    }
    
    public function getModel($key)
    {
        $where = array(
        	'codigo' => $key
        );
        
        $models = $this->getModels(
            $where
        );
        
        if($models->count() > 0){
            return $models->current();
        } 
        
        return new Regiao();
        
    }
    
    public function delete($key)
    {
        $where = array(
        	'codigo' => $key
        );
        
        $this->tableGateway->delete($where);
    }
}