<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Contact Entity
 *
 * @property int $id
 * @property int $owner
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property string $first_name
 * @property string $last_name
 * @property string $phone1
 * @property string $ext1
 * @property string $phone2
 * @property string $ext2
 * @property string $phone3
 * @property string $ext3
 * @property string $is_allowed_calls
 * @property string $email
 * @property string $title
 * @property string $department
 * @property string $description
 * @property int $account_id
 * @property int $user_id
 *
 * @property \App\Model\Entity\Account $account
 * @property \App\Model\Entity\User $user
 */
class Contact extends Entity
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
        'first_name' => true,
        'last_name' => true,
        'phone1' => true,
        'ext1' => true,
        'phone2' => true,
        'ext2' => true,
        'phone3' => true,
        'ext3' => true,
        'is_allowed_calls' => true,
        'email' => true,
        'title' => true,
        'department' => true,
        'description' => true,
        'account_id' => true,
        'user_id' => true,
        'account' => true,
        'user' => true
    ];
}
