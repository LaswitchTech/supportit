<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Call Entity
 *
 * @property int $id
 * @property int $owner
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property string $subject
 * @property string $content
 * @property int $status
 * @property \Cake\I18n\FrozenTime $start
 * @property \Cake\I18n\FrozenTime $end
 * @property int $link_id
 * @property int $link_type
 * @property string $duration
 * @property int $user_id
 *
 * @property \App\Model\Entity\Link $link
 * @property \App\Model\Entity\User $user
 */
class Call extends Entity
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
        'subject' => true,
        'content' => true,
        'status' => true,
        'start' => true,
        'end' => true,
        'link_id' => true,
        'link_type' => true,
        'duration' => true,
        'user_id' => true,
        'link' => true,
        'user' => true
    ];
}
