<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Employee;
use Authorization\IdentityInterface;

/**
 * Employee policy
 */
class EmployeePolicy
{
    /**
     * Check if $user can add Employee
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Employee $employee
     * @return bool
     */
    public function canAdd(IdentityInterface $user, Employee $employee)
    {
    }

    /**
     * Check if $user can edit Employee
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Employee $employee
     * @return bool
     */
    public function canEdit(IdentityInterface $user, Employee $employee)
    {
        $userEmp = $user->getOriginalData();
       // dump($userEmp);
       // dump($userEmp->actualDepartment);
       // dd($employee->actualDepartment);

        //Déterminer si $user est manager, si oui récupérer son numéro de département
        //Déterminer si $employee est dans le même département
        return $userEmp->actualDepartment->dept_no == $employee->actualDepartment;
    }
    
    /**
     * Check if $user can delete Employee
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Employee $employee
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Employee $employee)
    {
    }

    /**
     * Check if $user can view Employee
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Employee $employee
     * @return bool
     */
    public function canView(IdentityInterface $user, Employee $employee)
    {
    }
}
