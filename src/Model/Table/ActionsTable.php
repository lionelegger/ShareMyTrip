<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Actions Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Trips
 * @property \Cake\ORM\Association\BelongsTo $Types
 * @property \Cake\ORM\Association\HasMany $Participations
 * @property \Cake\ORM\Association\HasMany $Payments
 *
 * @method \App\Model\Entity\Action get($primaryKey, $options = [])
 * @method \App\Model\Entity\Action newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Action[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Action|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Action patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Action[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Action findOrCreate($search, callable $callback = null)
 */
class ActionsTable extends Table
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

        $this->table('actions');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->belongsTo('Trips', [
            'foreignKey' => 'trip_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Types', [
            'foreignKey' => 'type_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Participations', [
            'foreignKey' => 'action_id'
        ]);
        $this->hasMany('Payments', [
            'foreignKey' => 'action_id'
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

        $validator
            ->allowEmpty('company');

        $validator
            ->allowEmpty('reservation');

        $validator
            ->allowEmpty('notes');

        $validator
            ->decimal('price')
            ->allowEmpty('price');

        $validator
            ->allowEmpty('currency');

        $validator
            ->dateTime('start_date')
            ->allowEmpty('start_date');

        $validator
            ->allowEmpty('start_name');

        $validator
            ->decimal('start_long')
            ->allowEmpty('start_long');

        $validator
            ->decimal('start_lat')
            ->allowEmpty('start_lat');

        $validator
            ->dateTime('end_date')
            ->allowEmpty('end_date');

        $validator
            ->allowEmpty('end_name');

        $validator
            ->decimal('end_long')
            ->allowEmpty('end_long');

        $validator
            ->decimal('end_lat')
            ->allowEmpty('end_lat');

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
        $rules->add($rules->existsIn(['trip_id'], 'Trips'));
        $rules->add($rules->existsIn(['type_id'], 'Types'));

        return $rules;
    }
}
