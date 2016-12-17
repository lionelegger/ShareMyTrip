<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * TripsUsers Controller
 *
 * @property \App\Model\Table\TripsUsersTable $TripsUsers
 */
class TripsUsersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Trips', 'Users']
        ];
        $tripsUsers = $this->paginate($this->TripsUsers);

        $this->set(compact('tripsUsers'));
        $this->set('_serialize', ['tripsUsers']);
    }

    /**
     * View method
     *
     * @param string|null $id Trips User id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tripsUser = $this->TripsUsers->get($id, [
            'contain' => ['Trips', 'Users']
        ]);

        $this->set('tripsUser', $tripsUser);
        $this->set('_serialize', ['tripsUser']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tripsUser = $this->TripsUsers->newEntity();
        if ($this->request->is('post')) {
            $tripsUser = $this->TripsUsers->patchEntity($tripsUser, $this->request->data);
            if ($this->TripsUsers->save($tripsUser)) {
                $this->Flash->success(__('The trips user has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The trips user could not be saved. Please, try again.'));
            }
        }
        $trips = $this->TripsUsers->Trips->find('list', ['limit' => 200]);
        $users = $this->TripsUsers->Users->find('list', ['limit' => 200]);
        $this->set(compact('tripsUser', 'trips', 'users'));
        $this->set('_serialize', ['tripsUser']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Trips User id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tripsUser = $this->TripsUsers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tripsUser = $this->TripsUsers->patchEntity($tripsUser, $this->request->data);
            if ($this->TripsUsers->save($tripsUser)) {
                $this->Flash->success(__('The trips user has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The trips user could not be saved. Please, try again.'));
            }
        }
        $trips = $this->TripsUsers->Trips->find('list', ['limit' => 200]);
        $users = $this->TripsUsers->Users->find('list', ['limit' => 200]);
        $this->set(compact('tripsUser', 'trips', 'users'));
        $this->set('_serialize', ['tripsUser']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Trips User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tripsUser = $this->TripsUsers->get($id);
        if ($this->TripsUsers->delete($tripsUser)) {
            $this->Flash->success(__('The trips user has been deleted.'));
        } else {
            $this->Flash->error(__('The trips user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
