<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Action Entity
 *
 * @property int $id
 * @property int $trip_id
 * @property int $type_id
 * @property int $owner_id
 * @property string $name
 * @property string $company
 * @property string $reservation
 * @property string $identifier
 * @property string $note
 * @property float $price
 * @property string $currency
 * @property int $status
 * @property string $start_name
 * @property \Cake\I18n\Time $start_date
 * @property float $start_lng
 * @property float $start_lat
 * @property string $end_name
 * @property \Cake\I18n\Time $end_date
 * @property float $end_lng
 * @property float $end_lat
 *
 * @property \App\Model\Entity\Trip $trip
 * @property \App\Model\Entity\Type $type
 * @property \App\Model\Entity\User[] $users
 * @property \App\Model\Entity\Payment[] $payments
 */
class Action extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}
