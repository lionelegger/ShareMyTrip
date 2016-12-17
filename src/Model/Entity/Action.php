<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Action Entity
 *
 * @property int $id
 * @property string $name
 * @property string $company
 * @property string $reservation
 * @property string $notes
 * @property int $trip_id
 * @property float $price
 * @property string $currency
 * @property int $type_id
 *
 * @property \App\Model\Entity\Trip $trip
 * @property \App\Model\Entity\Type $type
 * @property \App\Model\Entity\Arrival[] $arrivals
 * @property \App\Model\Entity\Departure[] $departures
 * @property \App\Model\Entity\Participation[] $participations
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
