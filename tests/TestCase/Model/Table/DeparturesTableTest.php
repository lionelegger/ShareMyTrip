<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DeparturesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DeparturesTable Test Case
 */
class DeparturesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\DeparturesTable
     */
    public $Departures;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.departures',
        'app.actions',
        'app.trips',
        'app.users',
        'app.participations',
        'app.payments',
        'app.methods',
        'app.trips_users',
        'app.types',
        'app.categories',
        'app.arrivals'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Departures') ? [] : ['className' => 'App\Model\Table\DeparturesTable'];
        $this->Departures = TableRegistry::get('Departures', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Departures);

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
