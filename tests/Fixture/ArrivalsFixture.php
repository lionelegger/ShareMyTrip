<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ArrivalsFixture
 *
 */
class ArrivalsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'longitude' => ['type' => 'decimal', 'length' => 9, 'precision' => 6, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => ''],
        'latitude' => ['type' => 'decimal', 'length' => 9, 'precision' => 6, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => ''],
        'date' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'action_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'name' => ['type' => 'string', 'length' => 45, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        '_indexes' => [
            'fk_position_lodgings10_idx' => ['type' => 'index', 'columns' => ['action_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'fk_arrivals_actions' => ['type' => 'foreign', 'columns' => ['action_id'], 'references' => ['actions', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_general_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => 1,
            'longitude' => 1.5,
            'latitude' => 1.5,
            'date' => '2016-12-17 17:46:20',
            'action_id' => 1,
            'name' => 'Lorem ipsum dolor sit amet'
        ],
    ];
}
