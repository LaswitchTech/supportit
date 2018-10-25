<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Alert Entity
 *
 * @property int $id
 * @property int $owner
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $sender
 * @property int $receiver
 * @property string $subject
 * @property string $message
 * @property bool $is_read
 * @property string $type
 * @property string $icon
 * @property string $controller
 * @property string $links_to
 * @property string $action
 */
class Alert extends Entity
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
        'sender' => true,
        'receiver' => true,
        'subject' => true,
        'message' => true,
        'is_read' => true,
        'type' => true,
        'icon' => true,
        'controller' => true,
        'links_to' => true,
        'action' => true
    ];
}
