<?php
namespace App\View\Helper;

use Cake\View\Helper;
use Cake\ORM\TableRegistry;

class AlertHelper extends Helper{
    public function getAlert(){
        $id = $this->request->getSession()->read('Auth.User.id');
        $query = TableRegistry::get('alerts');
        $alerts = $query->find()->where(['receiver' => $id, 'is_read' => 0]);
        return $alerts;
    }

    public function getAlertcount(){
        $id = $this->request->getSession()->read('Auth.User.id');
        $total = TableRegistry::get('alerts')->find()->where(['receiver' => $id, 'is_read' => 0])->count();
        return $total;
    }
}