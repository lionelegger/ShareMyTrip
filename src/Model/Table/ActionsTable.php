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
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\HasMany $Payments
 * @property \Cake\ORM\Association\BelongsToMany $Users
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
        $this->belongsTo('Users', [
            'foreignKey' => 'owner_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Payments', [
            'foreignKey' => 'action_id',
            // When an action is deleted, its dependant payments will be deleted too
            'dependent' => true,
            'cascadeCallbacks' => true,
        ]);
        $this->belongsToMany('Users', [
            'foreignKey' => 'action_id',
            'targetForeignKey' => 'user_id',
            'joinTable' => 'actions_users'
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
            ->allowEmpty('identifier');

        $validator
            ->allowEmpty('note');

        $validator
            ->decimal('price')
            ->allowEmpty('price');

        $validator
            ->allowEmpty('currency');

        $validator
            ->integer('status')
            ->allowEmpty('status');

        $validator
            ->allowEmpty('start_name');

        $validator
            ->dateTime('start_date')
            ->allowEmpty('start_date');

        $validator
            ->decimal('start_lng')
            ->allowEmpty('start_lng');

        $validator
            ->decimal('start_lat')
            ->allowEmpty('start_lat');

        $validator
            ->allowEmpty('end_name');

        $validator
            ->dateTime('end_date')
            ->allowEmpty('end_date');

        $validator
            ->decimal('end_lng')
            ->allowEmpty('end_lng');

        $validator
            ->decimal('end_lat')
            ->allowEmpty('end_lat');

        $validator
            ->boolean('private')
            ->allowEmpty('private');

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
        $rules->add($rules->existsIn(['owner_id'], 'Users'));

        return $rules;
    }
}
