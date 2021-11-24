<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SalariesFixture
 */
class SalariesFixture extends TestFixture
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
                'salary' => 1,
                'from_date' => '2021-11-24',
                'to_date' => '2021-11-24',
            ],
        ];
        parent::init();
    }
}
