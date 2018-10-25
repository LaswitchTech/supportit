<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Account Entity
 *
 * @property int $id
 * @property int $owner
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property string $name
 * @property string $phone
 * @property string $website
 * @property string $type
 * @property string $description
 * @property int $user_id
 *
 * @property \App\Model\Entity\User[] $users
 * @property \App\Model\Entity\Contact[] $contacts
 * @property \App\Model\Entity\Ticket[] $tickets
 */
class Account extends Entity
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
        'website' => true,
        'type' => true,
        'description' => true,
        'user_id' => true,
        'users' => true,
        'contacts' => true,
        'tickets' => true
    ];
}
