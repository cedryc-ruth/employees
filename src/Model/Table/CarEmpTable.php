<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CarEmp Model
 *
 * @property \App\Model\Table\CarsTable&\Cake\ORM\Association\BelongsTo $Cars
 *
 * @method \App\Model\Entity\CarEmp newEmptyEntity()
 * @method \App\Model\Entity\CarEmp newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\CarEmp[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CarEmp get($primaryKey, $options = [])
 * @method \App\Model\Entity\CarEmp findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\CarEmp patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CarEmp[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\CarEmp|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CarEmp saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CarEmp[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\CarEmp[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\CarEmp[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\CarEmp[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class CarEmpTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('car_emp');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Cars', [
            'foreignKey' => 'car_id',
            'joinType' => 'INNER',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->integer('emp_no')
            ->requirePresence('emp_no', 'create')
            ->notEmptyString('emp_no')
            ->add('emp_no', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->date('receipt_date')
            ->requirePresence('receipt_date', 'create')
            ->notEmptyDate('receipt_date');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->isUnique(['emp_no']), ['errorField' => 'emp_no']);
        $rules->add($rules->existsIn('car_id', 'Cars'), ['errorField' => 'car_id']);

        return $rules;
    }
}
