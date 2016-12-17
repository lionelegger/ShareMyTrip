<?php
namespace App\Test\TestCase\Controller;

use App\Controller\MethodsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\MethodsController Test Case
 */
class MethodsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.methods',
        'app.payments',
        'app.actions',
        'app.trips',
        'app.users',
        'app.participations',
        'app.trips_users',
        'app.types',
        'app.categories',
        'app.arrivals',
        'app.departures'
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
