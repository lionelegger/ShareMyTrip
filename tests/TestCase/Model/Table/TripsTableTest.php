<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TripsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TripsTable Test Case
 */
class TripsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TripsTable
     */
    public $Trips;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.trips',
        'app.actions',
        'app.users',
        'app.participations',
        'app.payments',
        'app.trips_users'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Trips') ? [] : ['className' => 'App\Model\Table\TripsTable'];
        $this->Trips = TableRegistry::get('Trips', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Trips);

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
