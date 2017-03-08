<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Entity\TripsUser;

/**
 * Trips Controller
 *
 * @property \App\Model\Table\TripsTable $Trips
 */
class TripsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        // Show only trips of the logged user
        $query = $this->Trips->find('all',[
            'contain' => ['Users']
        ]);
        $query->matching('Users', function ($q) {
            return $q->where([
                'Users.id' => $this->Auth->user('id')
            ]);
        });

        $trips = $query->all();

        $this->set('trips', $trips);
        $this->set('_serialize', ['trips']);
    }

    /**
     * View method
     *
     * @param string|null $id Trip id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        // the trip is sorted by its action start_date
        $trip = $this->Trips->get($id, [
            'contain' => ['Users', 'Actions' => [
                'sort' => ['Actions.start_date' => 'ASC']
            ]]
        ]);

        $this->set('trip', $trip);
        $this->set('_serialize', ['trip']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $trip = $this->Trips->newEntity();

        // This defines the currentUser and adds it to the trip
        $currentUser = $this->Trips->Users->get($this->Auth->user('id'), [
            'contain' => ['Trips']
        ]);


        if ($this->request->is('post')) {
            $trip = $this->Trips->patchEntity($trip, $this->request->data);

            // Add the authorized User as the owner of the trip
            $trip->owner_id = $this->Auth->user('id');
            if ($result=$this->Trips->save($trip)) {

                // Adds the currentUser to the joint table TripsUsers
                $this->Trips->Users->link($trip, [$currentUser]);

                $record_id=$result->id;

//                $this->Flash->success(__('The trip has been saved with ID = ') . $record_id);

//                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The trip could not be saved. Please, try again.'));
            }
        }

        $users = $this->Trips->Users->find('list', ['limit' => 200]);
        $this->set(compact('trip', 'users', 'record_id'));
        $this->set('_serialize', ['trip'], ['users'], 'record_id');
    }

    /**
     * Edit method
     *
     * @param string|null $id Trip id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        // When editing a trip, we update only the fields specified below but not 'users' who are added/removed with angularJS controllers

//        debug($this->request->data['new_date_start']);
        $this->Trips->updateAll([
            "name" => $this->request->data['name'],
            "date_start" => $this->request->data['date_start'],
            "date_end" => $this->request->data['date_end'],
            "currency" => $this->request->data['currency']
            ],["id" => $id]
        );
//        $this->Trips->updateAll(["currency" => $this->request->data['currency']], ["id" => $id]);

    }

    /**
     * Delete method
     *
     * @param string|null $id Trip id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $trip = $this->Trips->get($id);
        if ($this->Trips->delete($trip)) {
            $this->Flash->success(__('The trip has been deleted.'));
        } else {
            $this->Flash->error(__('The trip could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
