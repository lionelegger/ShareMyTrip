<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ActionsUsers Controller
 *
 * @property \App\Model\Table\ActionsUsersTable $ActionsUsers
 */
class ActionsUsersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Actions', 'Users']
        ];
        $actionsUsers = $this->paginate($this->ActionsUsers);

        $this->set(compact('actionsUsers'));
        $this->set('_serialize', ['actionsUsers']);
    }

    /**
     * View method
     *
     * @param string|null $id Actions User id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $actionsUser = $this->ActionsUsers->get($id, [
            'contain' => ['Actions', 'Users']
        ]);

        $this->set('actionsUser', $actionsUser);
        $this->set('_serialize', ['actionsUser']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $actionsUser = $this->ActionsUsers->newEntity();
        if ($this->request->is('post')) {
            $actionsUser = $this->ActionsUsers->patchEntity($actionsUser, $this->request->data);
            if ($this->ActionsUsers->save($actionsUser)) {
//                $this->Flash->success(__('The actions user has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The actions user could not be saved. Please, try again.'));
            }
        }
        $actions = $this->ActionsUsers->Actions->find('list', ['limit' => 200]);
        $users = $this->ActionsUsers->Users->find('list', ['limit' => 200]);
        $this->set(compact('actionsUser', 'actions', 'users'));
        $this->set('_serialize', ['actionsUser']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Actions User id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $actionsUser = $this->ActionsUsers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $actionsUser = $this->ActionsUsers->patchEntity($actionsUser, $this->request->data);
            if ($this->ActionsUsers->save($actionsUser)) {
//                $this->Flash->success(__('The actions user has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The actions user could not be saved. Please, try again.'));
            }
        }
        $actions = $this->ActionsUsers->Actions->find('list', ['limit' => 200]);
        $users = $this->ActionsUsers->Users->find('list', ['limit' => 200]);
        $this->set(compact('actionsUser', 'actions', 'users'));
        $this->set('_serialize', ['actionsUser']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Actions User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $actionsUser = $this->ActionsUsers->get($id);
        if ($this->ActionsUsers->delete($actionsUser)) {
//            $this->Flash->success(__('The actions user has been deleted.'));
        } else {
            $this->Flash->error(__('The actions user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
