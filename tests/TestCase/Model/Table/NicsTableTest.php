<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\NicsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\NicsTable Test Case
 */
class NicsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\NicsTable
     */
    public $Nics;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.nics',
        'app.devices'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Nics') ? [] : ['className' => NicsTable::class];
        $this->Nics = TableRegistry::getTableLocator()->get('Nics', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Nics);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
