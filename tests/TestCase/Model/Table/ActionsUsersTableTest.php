<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ActionsUsersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ActionsUsersTable Test Case
 */
class ActionsUsersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ActionsUsersTable
     */
    public $ActionsUsers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.actions_users',
        'app.actions',
        'app.trips',
        'app.users',
        'app.payments',
        'app.methods',
        'app.trips_users',
        'app.types',
        'app.categories'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ActionsUsers') ? [] : ['className' => 'App\Model\Table\ActionsUsersTable'];
        $this->ActionsUsers = TableRegistry::get('ActionsUsers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ActionsUsers);

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
