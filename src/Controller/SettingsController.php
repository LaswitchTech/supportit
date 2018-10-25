<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
use PDO;

class SettingsController extends AppController{

    public function update(){
      $old_path = getcwd();
      chdir('/usr/share/SeeIT/master/bin');
      $new_path = getcwd();
      $output = shell_exec('sudo ./update --no-colors --debug --check-update --install-update');
      chdir($old_path);
      $this->set('output', $output);
    }

    public function index() {
        include "../config.php";
        $users = TableRegistry::get('users')->find();
        $users->count = TableRegistry::get('users')->find()->count();
        $this->set('users', $users);
    }

    public function sql() {
        include "../config.php";
        $this->set('DB_CONNECT', $DB_CONNECT);
        if ($this->request->is('post')) {
          // Create Temp SQL Connection
          $dsn = 'mysql://'.$this->request->data('Username').':'.$this->request->data('Password').'@'.$this->request->data('Host').'/'.$this->request->data('Database');
          ConnectionManager::config('SQL-TEST', ['url' => $dsn]);
          $CONN_TEST = 0;
          try {
              $connection = ConnectionManager::get('SQL-TEST');
              $connected = $connection->connect();
          } catch (\Exception $connectionError) {
              //Couldn't connect
              $CONN_TEST = 1;
              $this->Flash->error(__('Unable to connect with these SQL settings'));
          }
          //Display connected
          if ($CONN_TEST == 0):
            //$this->Flash->success(__('The SQL Settings work'));
            $CONN_TEST = 0;
            //Test Table
            try {
                $connection = ConnectionManager::get('SQL-TEST');
                $results = $connection
                  ->execute('SELECT * FROM sessions')
                  ->fetchAll('assoc');
            } catch (\Exception $connectionError) {
                //Couldn't connect
                $CONN_TEST = 1;
                $this->Flash->error(__('Missing table sessions in this database'));
            }
          endif;
          //Display connected
          if ($CONN_TEST == 0):
            $CONFIG = "../config.php";
            $FILE_O = fopen($CONFIG, "r");
            $FILE_W = fopen($CONFIG.'.tmp', "w");
            $SIZE = filesize($CONFIG);
            $REPLACE = false;
            while (!feof($FILE_O)){
              $LINE = fgets($FILE_O);
              if (stristr($LINE, '"Username" =>')){
                $LINE = '      "Username" => "'.$this->request->data('Username').'",'."\n";
                $REPLACE = true;
              } elseif (stristr($LINE, '"Password" =>')){
                $LINE = '      "Password" => "'.$this->request->data('Password').'",'."\n";
                $REPLACE = true;
              } elseif (stristr($LINE, '"Database" =>')){
                $LINE = '      "Database" => "'.$this->request->data('Database').'",'."\n";
                $REPLACE = true;
              } elseif (stristr($LINE, '"Host" =>')){
                $LINE = '      "Host" => "'.$this->request->data('Host').'",'."\n";
                $REPLACE = true;
              }
              fputs($FILE_W, $LINE);
            }
            fclose($FILE_O);fclose($FILE_W);
            if ($REPLACE){
              rename($CONFIG.'.tmp', $CONFIG);
              $this->Flash->success(__('The SQL Settings saved'));
            } else {
              $this->Flash->error(__('These SQL Settings not saved'));
              unlink($CONFIG.'.tmp');
            }
            chmod($CONFIG, 0777);
            sleep(3);
          endif;

          return $this->redirect(['controller' => 'Settings', 'action' => 'sql']);
        }
        //return $this->redirect(['controller' => 'Settings', 'action' => 'index']);
    }

    public function site() {
        include "../config.php";
        if ($SITE['login']['show_remember'] == 'false'){
          $SITE['login']['show_remember'] = 0;
        }
        if ($SITE['login']['show_register'] == 'false'){
          $SITE['login']['show_register'] = 0;
        }
        if ($SITE['login']['show_social'] == 'false'){
          $SITE['login']['show_social'] = 0;
        }
        $this->set('SITE', $SITE);
        if ($this->request->is('post')) {
          $CONFIG = "../config.php";
          $FILE_O = fopen($CONFIG, "r");
          $FILE_W = fopen($CONFIG.'.tmp', "w");
          $SIZE = filesize($CONFIG);
          $REPLACE = false;
          while (!feof($FILE_O)){
            $LINE = fgets($FILE_O);
            if (stristr($LINE, '"skin" =>')){
              $LINE = '      "skin" => "'.$this->request->data('skin').'",'."\n";
              $REPLACE = true;
            } elseif (stristr($LINE, '"title" =>')){
              $LINE = '      "title" => "'.$this->request->data('title').'",'."\n";
              $REPLACE = true;
            } elseif (stristr($LINE, '"mini" =>')){
              $LINE = '        "mini" => "'.$this->request->data('logo-mini').'",'."\n";
              $REPLACE = true;
            } elseif (stristr($LINE, '"large" =>')){
              $LINE = '        "large" => "'.$this->request->data('logo-large').'",'."\n";
              $REPLACE = true;
            } elseif (stristr($LINE, '"show_remember" =>')){
              if ($this->request->data('login-show_remember') == 1){
                $VAR = "true";
              } else {
                $VAR = "false";
              }
              $LINE = '        "show_remember" => "'.$VAR.'",'."\n";
              $REPLACE = true;
            } elseif (stristr($LINE, '"show_register" =>')){
              if ($this->request->data('login-show_register') == 1){
                $VAR = "true";
              } else {
                $VAR = "false";
              }
              $LINE = '        "show_register" => "'.$VAR.'",'."\n";
              $REPLACE = true;
            } elseif (stristr($LINE, '"show_social" =>')){
              if ($this->request->data('login-show_social') == 1){
                $VAR = "true";
              } else {
                $VAR = "false";
              }
              $LINE = '        "show_social" => "'.$VAR.'",'."\n";
              $REPLACE = true;
            }
            fputs($FILE_W, $LINE);
          }
          fclose($FILE_O);fclose($FILE_W);
          if ($REPLACE){
            rename($CONFIG.'.tmp', $CONFIG);
          } else {
            unlink($CONFIG.'.tmp');
          }
          chmod($CONFIG, 0777);
          sleep(3);
          $this->Flash->success(__('The Site Settings has been saved.'));
          return $this->redirect(['controller' => 'Settings', 'action' => 'site']);
        }
        //return $this->redirect(['controller' => 'Settings', 'action' => 'index']);
    }
}
