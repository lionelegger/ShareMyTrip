<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ArrivalsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ArrivalsTable Test Case
 */
class ArrivalsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ArrivalsTable
     */
    public $Arrivals;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.arrivals',
        'app.actions',
        'app.trips',
        'app.users',
        'app.participations',
        'app.payments',
        'app.methods',
        'app.trips_users',
        'app.types',
        'app.categories',
        'app.departures'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Arrivals') ? [] : ['className' => 'App\Model\Table\ArrivalsTable'];
        $this->Arrivals = TableRegistry::get('Arrivals', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Arrivals);

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
