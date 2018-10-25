<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Mailer\Email;
use Cake\ORM\TableRegistry;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $total = TableRegistry::get('Users')->find()->count();
        $this->paginate = [
            'limit' => $total
        ];
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Roles', 'Tasks', 'Logs', 'Devices', 'Nics', 'Pings', 'Permissions']
        ]);

        $this->set('user', $user);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            //Generate Auth_key
            $length = 32;
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            $user = $this->Users->patchEntity($user, $this->request->data);
            $user->auth_key = $randomString;
            $user->owner = $this->request->getSession()->read('Auth.User.id');
            
            //Update log
            $logsTable = TableRegistry::get('logs');
            $log = $logsTable->newEntity();
            $log->type = 0;
            $log->tbl = 'users';
            $log->content = "SQL query $user";
            $log->user_id = $this->request->getSession()->read('Auth.User.id');
            $log->owner = $this->request->getSession()->read('Auth.User.id');
            $log->ipv4 = $_SERVER["REMOTE_ADDR"];
            
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The {0} has been saved.', 'User'));
                $log->is_success = 1;
                $logsTable->save($log);
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'User'));
                $log->is_success = 0;
                $logsTable->save($log);
            }
        }
        $roles = $this->Users->Roles->find('list', ['limit' => 200]);
        $this->set(compact('user', 'roles'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            //Update log
            $logsTable = TableRegistry::get('logs');
            $log = $logsTable->newEntity();
            $log->type = 1;
            $log->tbl = 'users';
            $log->content = "SQL query $user";
            $log->user_id = $this->request->getSession()->read('Auth.User.id');
            $log->owner = $this->request->getSession()->read('Auth.User.id');
            $log->ipv4 = $_SERVER["REMOTE_ADDR"];
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The {0} has been saved.', 'User'));
                $log->is_success = 1;
                $logsTable->save($log);
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'User'));
                $log->is_success = 0;
                $logsTable->save($log);
            }
        }
        $roles = $this->Users->Roles->find('list', ['limit' => 200]);
        $this->set(compact('user', 'roles'));
        $this->set('_serialize', ['user']);
    }
    
    public function editUser($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            //Update log
            $logsTable = TableRegistry::get('logs');
            $log = $logsTable->newEntity();
            $log->type = 1;
            $log->tbl = 'users';
            $log->content = "SQL query $user";
            $log->user_id = $this->request->getSession()->read('Auth.User.id');
            $log->owner = $this->request->getSession()->read('Auth.User.id');
            $log->ipv4 = $_SERVER["REMOTE_ADDR"];
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The {0} has been saved.', 'User'));
                $log->is_success = 1;
                $logsTable->save($log);
                return $this->redirect(['action' => 'view', $user->id]);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'User'));
                $log->is_success = 0;
                $logsTable->save($log);
            }
        }
        $roles = $this->Users->Roles->find('list', ['limit' => 200]);
        $this->set(compact('user', 'roles'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        //Update log
        $logsTable = TableRegistry::get('logs');
        $log = $logsTable->newEntity();
        $log->type = 2;
        $log->tbl = 'users';
        $log->content = "SQL query $user";
        $log->user_id = $this->request->getSession()->read('Auth.User.id');
        $log->owner = $this->request->getSession()->read('Auth.User.id');
        $log->ipv4 = $_SERVER["REMOTE_ADDR"];
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The {0} has been deleted.', 'User'));
            $log->is_success = 1;
            $logsTable->save($log);
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'User'));
            $log->is_success = 0;
            $logsTable->save($log);
        }
        return $this->redirect(['action' => 'index']);
    }
    public function login(){
        if($this->request->is('post')){
            $user = $this->Auth->identify();
            if($user){
                $this->Auth->setUser($user);
                $this->redirect($this->Auth->redirectUrl());
                $this->Flash->success('User successfully signed in');
            } else {
                $this->Flash->error('Wrong Username and/or Password');
            }
        }
    }
    public function logout(){
        return $this->redirect($this->Auth->logout());
    }
}
