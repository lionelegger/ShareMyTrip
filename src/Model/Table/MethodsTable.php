<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Methods Model
 *
 * @property \Cake\ORM\Association\HasMany $Payments
 *
 * @method \App\Model\Entity\Method get($primaryKey, $options = [])
 * @method \App\Model\Entity\Method newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Method[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Method|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Method patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Method[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Method findOrCreate($search, callable $callback = null)
 */
class MethodsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('methods');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->hasMany('Payments', [
            'foreignKey' => 'method_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        return $validator;
    }
}
