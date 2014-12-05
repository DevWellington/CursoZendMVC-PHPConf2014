<?php

namespace Application\Model;

use Application\Form\Participante;
use Zend\Db\TableGateway\TableGatewayInterface;
use Zend\Db\Sql\Select;

class ParticipanteTable
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

        $select = new Select();
        $select
//            ->columns(
//                array(
//                    'codigo_partic' => 'codigo_partic',
//                    'nome_participante' => 'nome',
//                    'codigo_regiao' => 'codigo_regiao'
//                )
//            )
            ->from('participantes')
            ->join(
                'regioes',
                'participantes.codigo_regiao = regioes.codigo',
                array(
                    'regiao' => 'nome'
                )
            )
            ->where($where)
        ;

        $data = $this->tableGateway->selectWith($select);

//        var_dump($data);
//        exit;


        return $data;
    }
    
    public function getModel($key)
    {
        $where = array(
        	'codigo_partic' => $key
        );

        $models = $this->getModels(
            $where
        );

        if($models->count() > 0){
            return $models->current();
        }

        return new Participante();

    }
    
    public function delete($key)
    {
        $where = array(
        	'codigo' => $key
        );
        
        $this->tableGateway->delete($where);
    }
}