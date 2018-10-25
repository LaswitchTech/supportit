<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Case Entity
 *
 * @property int $id
 * @property int $owner
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $account_id
 * @property int $state
 * @property int $status
 * @property int $priority
 * @property int $type
 * @property string $subject
 * @property string $description
 * @property string $resolution
 * @property int $user_id
 *
 * @property \App\Model\Entity\Account $account
 * @property \App\Model\Entity\User $user
 */
class Case extends Entity
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
        'account_id' => true,
        'state' => true,
        'status' => true,
        'priority' => true,
        'type' => true,
        'subject' => true,
        'description' => true,
        'resolution' => true,
        'user_id' => true,
        'account' => true,
        'user' => true
    ];
}
