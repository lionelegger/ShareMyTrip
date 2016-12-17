<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TripsUsersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TripsUsersTable Test Case
 */
class TripsUsersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TripsUsersTable
     */
    public $TripsUsers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.trips_users',
        'app.trips',
        'app.actions',
        'app.types',
        'app.categories',
        'app.arrivals',
        'app.departures',
        'app.participations',
        'app.users',
        'app.payments',
        'app.methods'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('TripsUsers') ? [] : ['className' => 'App\Model\Table\TripsUsersTable'];
        $this->TripsUsers = TableRegistry::get('TripsUsers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TripsUsers);

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
