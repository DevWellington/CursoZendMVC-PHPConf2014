<?php

namespace Application\Model;

use Application\Form\Participante,
    Zend\Db\TableGateway\TableGatewayInterface,
    Zend\Db\Sql\Select;

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

        if(empty($model->participantes_codigo)){
            $this->tableGateway->insert($set);
        } else {
            $where = array(
            	'codigo' => $model->participantes_codigo,
            );

            $this->tableGateway->update($set, $where);
        } 
    }

    public function getModels($where = [])
    {
        $select = new Select();
        $select
            ->columns(
                [
                    'participantes_codigo' => 'codigo',
                    'nome' => 'nome',
                    'codigo_regiao' => 'codigo_regiao'
                ]
            )
            ->from(['p' => 'participantes'])
            ->join(
                'regioes',
                'p.codigo_regiao = regioes.codigo',
                [
                    'regiao' => 'nome'
                ]
            )
            ->where($where)
            ->order('p.codigo')
        ;

        $data = $this->tableGateway->selectWith($select);

        return $data;
    }
    
    public function getModel($key)
    {
        $where = [
            'p.codigo' => $key
        ];

        $models = $this->getModels($where);

        if($models->count() > 0){
            return $models->current();
        }

        return new Participante();
    }
    
    public function delete($key)
    {
        $where = array(
        	'participantes.codigo' => $key
        );
        
        $this->tableGateway->delete($where);
    }
}