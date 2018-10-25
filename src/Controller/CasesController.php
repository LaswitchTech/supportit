<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Cases Controller
 *
 * @property \App\Model\Table\CasesTable $Cases
 *
 * @method \App\Model\Entity\Case[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CasesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Accounts', 'Users']
        ];
        $cases = $this->paginate($this->Cases);

        $this->set(compact('cases'));
    }

    /**
     * View method
     *
     * @param string|null $id Case id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $case = $this->Cases->get($id, [
            'contain' => ['Accounts', 'Users']
        ]);

        $this->set('case', $case);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $case = $this->Cases->newEntity();
        if ($this->request->is('post')) {
            $case = $this->Cases->patchEntity($case, $this->request->data);
            if ($this->Cases->save($case)) {
                $this->Flash->success(__('The {0} has been saved.', 'Case'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Case'));
            }
        }
        $accounts = $this->Cases->Accounts->find('list', ['limit' => 200]);
        $users = $this->Cases->Users->find('list', ['limit' => 200]);
        $this->set(compact('case', 'accounts', 'users'));
        $this->set('_serialize', ['case']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Case id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $case = $this->Cases->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $case = $this->Cases->patchEntity($case, $this->request->data);
            if ($this->Cases->save($case)) {
                $this->Flash->success(__('The {0} has been saved.', 'Case'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Case'));
            }
        }
        $accounts = $this->Cases->Accounts->find('list', ['limit' => 200]);
        $users = $this->Cases->Users->find('list', ['limit' => 200]);
        $this->set(compact('case', 'accounts', 'users'));
        $this->set('_serialize', ['case']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Case id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $case = $this->Cases->get($id);
        if ($this->Cases->delete($case)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Case'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Case'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
