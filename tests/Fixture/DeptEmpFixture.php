<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * DeptEmpFixture
 */
class DeptEmpFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'dept_emp';
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
                'dept_no' => '',
                'from_date' => '2021-12-08',
                'to_date' => '2021-12-08',
            ],
        ];
        parent::init();
    }
}
