<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PingsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PingsTable Test Case
 */
class PingsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PingsTable
     */
    public $Pings;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.pings'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Pings') ? [] : ['className' => PingsTable::class];
        $this->Pings = TableRegistry::getTableLocator()->get('Pings', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Pings);

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
}
