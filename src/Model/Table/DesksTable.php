<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Desks Model
 *
 * @property \App\Model\Table\EmployeesTable&\Cake\ORM\Association\HasMany $Employees
 *
 * @method \App\Model\Entity\Desk newEmptyEntity()
 * @method \App\Model\Entity\Desk newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Desk[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Desk get($primaryKey, $options = [])
 * @method \App\Model\Entity\Desk findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Desk patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Desk[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Desk|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Desk saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Desk[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Desk[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Desk[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Desk[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class DesksTable extends Table
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

        $this->setTable('desks');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('Employees', [
            'foreignKey' => 'desk_id',
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
            ->nonNegativeInteger('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('numero')
            ->maxLength('numero', 5)
            ->requirePresence('numero', 'create')
            ->notEmptyString('numero');

        $validator
            ->scalar('nom')
            ->maxLength('nom', 20)
            ->requirePresence('nom', 'create')
            ->notEmptyString('nom');

        return $validator;
    }
}
