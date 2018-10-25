<?php
namespace App\View\Helper;

use Cake\View\Helper;
use Cake\ORM\TableRegistry;

class UserHelper extends Helper{
    public function getUser($id){
        $records = TableRegistry::get('users');
        $query = $records->find()->where(['id' => $id]);
        return $query->first();
    }
    public function getUsercount(){
        $records = TableRegistry::get('users');
        $query = $records->find()->count();
        return $query;
    }
}
