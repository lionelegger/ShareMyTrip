<?php
namespace App\Test\TestCase\Controller;

use App\Controller\DeparturesController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\DeparturesController Test Case
 */
class DeparturesControllerTest extends IntegrationTestCase
{

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
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
