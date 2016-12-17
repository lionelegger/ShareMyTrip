<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Arrivals Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Actions
 *
 * @method \App\Model\Entity\Arrival get($primaryKey, $options = [])
 * @method \App\Model\Entity\Arrival newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Arrival[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Arrival|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Arrival patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Arrival[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Arrival findOrCreate($search, callable $callback = null)
 */
class ArrivalsTable extends Table
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

        $this->table('arrivals');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->belongsTo('Actions', [
            'foreignKey' => 'action_id',
            'joinType' => 'INNER'
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
            ->decimal('longitude')
            ->allowEmpty('longitude');

        $validator
            ->decimal('latitude')
            ->allowEmpty('latitude');

        $validator
            ->dateTime('date')
            ->requirePresence('date', 'create')
            ->notEmpty('date');

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['action_id'], 'Actions'));

        return $rules;
    }
}
