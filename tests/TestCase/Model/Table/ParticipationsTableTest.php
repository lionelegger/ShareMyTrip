<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ParticipationsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ParticipationsTable Test Case
 */
class ParticipationsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ParticipationsTable
     */
    public $Participations;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.participations',
        'app.users',
        'app.payments',
        'app.actions',
        'app.trips',
        'app.trips_users',
        'app.types',
        'app.categories',
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
        $config = TableRegistry::exists('Participations') ? [] : ['className' => 'App\Model\Table\ParticipationsTable'];
        $this->Participations = TableRegistry::get('Participations', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Participations);

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
