<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CarEmpTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CarEmpTable Test Case
 */
class CarEmpTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\CarEmpTable
     */
    protected $CarEmp;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.CarEmp',
        'app.Cars',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('CarEmp') ? [] : ['className' => CarEmpTable::class];
        $this->CarEmp = $this->getTableLocator()->get('CarEmp', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->CarEmp);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\CarEmpTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\CarEmpTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
