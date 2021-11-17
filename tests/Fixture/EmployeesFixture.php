<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * EmployeesFixture
 */
class EmployeesFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'emp_no' => 1,
                'birth_date' => '2021-11-17',
                'first_name' => 'Lorem ipsum ',
                'last_name' => 'Lorem ipsum do',
                'gender' => 'Lorem ipsum dolor sit amet',
                'hire_date' => '2021-11-17',
            ],
        ];
        parent::init();
    }
}
