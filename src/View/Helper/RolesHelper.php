<?php
namespace App\View\Helper;

use Cake\View\Helper;
use Cake\ORM\TableRegistry;

class RolesHelper extends Helper{
    public function getRole($id, $role_field, $level){
        $users = TableRegistry::get('users');
        $user = $users->find()->where(['id' => $id])->first();
        $roles = TableRegistry::get('roles');
        $role = $roles->find()->where(['id' => $user->role_id])->first();
        $permissions = TableRegistry::get('permissions');
        $permission = $permissions->find()->where(['role_id' => $role->id, 'name' => $role_field])->first();
        return $permission->level >= $level;
    }
}
