<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Calls Controller
 *
 * @property \App\Model\Table\CallsTable $Calls
 *
 * @method \App\Model\Entity\Call[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CallsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Links', 'Users']
        ];
        $calls = $this->paginate($this->Calls);

        $this->set(compact('calls'));
    }

    /**
     * View method
     *
     * @param string|null $id Call id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $call = $this->Calls->get($id, [
            'contain' => ['Links', 'Users']
        ]);

        $this->set('call', $call);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $call = $this->Calls->newEntity();
        if ($this->request->is('post')) {
            $call = $this->Calls->patchEntity($call, $this->request->data);
            if ($this->Calls->save($call)) {
                $this->Flash->success(__('The {0} has been saved.', 'Call'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Call'));
            }
        }
        $links = $this->Calls->Links->find('list', ['limit' => 200]);
        $users = $this->Calls->Users->find('list', ['limit' => 200]);
        $this->set(compact('call', 'links', 'users'));
        $this->set('_serialize', ['call']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Call id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $call = $this->Calls->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $call = $this->Calls->patchEntity($call, $this->request->data);
            if ($this->Calls->save($call)) {
                $this->Flash->success(__('The {0} has been saved.', 'Call'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Call'));
            }
        }
        $links = $this->Calls->Links->find('list', ['limit' => 200]);
        $users = $this->Calls->Users->find('list', ['limit' => 200]);
        $this->set(compact('call', 'links', 'users'));
        $this->set('_serialize', ['call']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Call id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $call = $this->Calls->get($id);
        if ($this->Calls->delete($call)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Call'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Call'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
