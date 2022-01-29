<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * DesksFixture
 */
class DesksFixture extends TestFixture
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
                'id' => 1,
                'numero' => 'Lor',
                'nom' => 'Lorem ipsum dolor ',
            ],
        ];
        parent::init();
    }
}
