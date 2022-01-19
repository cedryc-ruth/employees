<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CarEmpFixture
 */
class CarEmpFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'car_emp';
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'emp_no' => 1,
                'car_id' => 1,
                'receipt_date' => '2022-01-19',
            ],
        ];
        parent::init();
    }
}
