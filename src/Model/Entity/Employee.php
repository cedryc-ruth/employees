<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\I18n\FrozenDate;
use Authentication\PasswordHasher\DefaultPasswordHasher;

/**
 * Employee Entity
 *
 * @property int $emp_no
 * @property \Cake\I18n\FrozenDate $birth_date
 * @property string $first_name
 * @property string $last_name
 * @property string $gender
 * @property \Cake\I18n\FrozenDate $hire_date
 */
class Employee extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'birth_date' => true,
        'first_name' => true,
        'last_name' => true,
        'gender' => true,
        'hire_date' => true,
        'password' => true,
        'email' => true,
        'desk_id' => true,
    ];
    
    //Champs virtuels
    protected function _getAge() {
        return $this->birth_date->diffInYears(new FrozenDate());
    }
    
    protected function _getActualSalary() {
        $actualSalary = null;
        
        $salaries = $this->salaries;
        
        $dateInfinie = new FrozenDate('9999-01-01');
        
        foreach ($salaries as $salary) {
            if($salary->to_date->equals($dateInfinie)) {
                $actualSalary = $salary;
                break;
            }
        }
        
        return $actualSalary;
    }

    protected function _getActualDepartment() {
        $actualDepartment = null;   //dd($this->departments);
        $dateInfinie = new FrozenDate('9999-01-01');      

        foreach($this->departments as $department) {
            if($department->_joinData->to_date->equals($dateInfinie)) {
                $actualDepartment = $department;
            }
        }

        return $actualDepartment;
    }

    //

    // Hacher automatiquement les mots de passe quand ils sont modifiés.
    protected function _setPassword(string $password)
    {
        $hasher = new DefaultPasswordHasher();
        return $hasher->hash($password);
    }
    
}
