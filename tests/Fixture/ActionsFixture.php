<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ActionsFixture
 *
 */
class ActionsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'trip_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'type_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'owner_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'name' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'company' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'reservation' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'identifier' => ['type' => 'text', 'length' => 4294967295, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null],
        'note' => ['type' => 'text', 'length' => 4294967295, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null],
        'price' => ['type' => 'decimal', 'length' => 7, 'precision' => 2, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => ''],
        'currency' => ['type' => 'string', 'length' => 3, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'status' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'start_name' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'start_date' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'start_lng' => ['type' => 'decimal', 'length' => 20, 'precision' => 15, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => ''],
        'start_lat' => ['type' => 'decimal', 'length' => 20, 'precision' => 15, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => ''],
        'end_name' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'end_date' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'end_lng' => ['type' => 'decimal', 'length' => 20, 'precision' => 15, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => ''],
        'end_lat' => ['type' => 'decimal', 'length' => 20, 'precision' => 15, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => ''],
        '_indexes' => [
            'fk_actions_trips1_idx' => ['type' => 'index', 'columns' => ['trip_id'], 'length' => []],
            'fk_actions_types1_idx' => ['type' => 'index', 'columns' => ['type_id'], 'length' => []],
            'fk_actions_users1_idx' => ['type' => 'index', 'columns' => ['owner_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'fk_actions_trips' => ['type' => 'foreign', 'columns' => ['trip_id'], 'references' => ['trips', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_actions_types' => ['type' => 'foreign', 'columns' => ['type_id'], 'references' => ['types', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_actions_users1' => ['type' => 'foreign', 'columns' => ['owner_id'], 'references' => ['users', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
            'trip_id' => 1,
            'type_id' => 1,
            'owner_id' => 1,
            'name' => 'Lorem ipsum dolor sit amet',
            'company' => 'Lorem ipsum dolor sit amet',
            'reservation' => 'Lorem ipsum dolor sit amet',
            'identifier' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
            'note' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
            'price' => 1.5,
            'currency' => 'L',
            'status' => 1,
            'start_name' => 'Lorem ipsum dolor sit amet',
            'start_date' => '2017-01-19 20:56:31',
            'start_lng' => 1.5,
            'start_lat' => 1.5,
            'end_name' => 'Lorem ipsum dolor sit amet',
            'end_date' => '2017-01-19 20:56:31',
            'end_lng' => 1.5,
            'end_lat' => 1.5
        ],
    ];
}
