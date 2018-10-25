<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Address Entity
 *
 * @property int $id
 * @property int $owner
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property string $name
 * @property string $phone
 * @property string $street
 * @property string $city
 * @property string $zipcode
 * @property string $state
 * @property string $country
 * @property int $link_id
 * @property int $link_type
 *
 * @property \App\Model\Entity\Link $link
 */
class Address extends Entity
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
        'owner' => true,
        'created' => true,
        'modified' => true,
        'name' => true,
        'phone' => true,
        'street' => true,
        'city' => true,
        'zipcode' => true,
        'state' => true,
        'country' => true,
        'link_id' => true,
        'link_type' => true,
        'link' => true
    ];
}
