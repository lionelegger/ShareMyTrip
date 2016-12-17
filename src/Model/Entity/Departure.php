<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Departure Entity
 *
 * @property int $id
 * @property float $longitude
 * @property float $latitude
 * @property \Cake\I18n\Time $date
 * @property int $action_id
 * @property string $name
 *
 * @property \App\Model\Entity\Action $action
 */
class Departure extends Entity
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
