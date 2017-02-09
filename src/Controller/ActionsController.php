<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;
use Cake\Utility\Hash;


/**
 * Actions Controller
 *
 * @property \App\Model\Table\ActionsTable $Actions
 */
class ActionsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Trips', 'Types']
        ];
        $actions = $this->paginate($this->Actions);

        $this->set(compact('actions'));
        $this->set('_serialize', ['actions']);
    }

    /**
     * View method
     *
     * @param string|null $id Action id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
//        We get the users of the trip and also the users of the action !!!
//        See http://127.0.0.1:8888/UNIGE/Projects/ShareMyTrip/Actions/view/67.json
//        TODO: Make the participants controller cleaner
        $action = $this->Actions->get($id, [
            'contain' => ['Trips' => ['Users'], 'Types', 'Users', 'Payments' => ['Users'], 'Users']
        ]);

        $this->set('action', $action);
        $this->set('_serialize', ['action']);
    }

    /**
     * Add method
     *
     * @param string|null $trip_id Action trip_id.
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add($trip_id = null)
    {
        $action = $this->Actions->newEntity();

        if ($this->request->is('post')) {
            $action = $this->Actions->patchEntity($action, $this->request->data);
            $action->trip_id = $trip_id;


            // Add the authorized User as the owner of the action
            $action->owner_id = $this->Auth->user('id');

            if ($result=$this->Actions->save($action)) {
                $this->Flash->success(__('The action has been saved.'));
                $record_id=$result->id;

                // Get all users of the current trip
                $query = $this->Actions->Trips->find('all')
                    ->where([ 'Trips.id' => $trip_id ])
                    ->contain('Users');
                $results = $query->all();
                $data = $results->toArray();

                // Add all trip users as participants of the action (by default when add an action)
                foreach ($data[0]['users'] as $user):
                    $user->_joinData = $this->Actions->Users->newEntity();
                    $this->Actions->Users->link($action, [$user]);
                endforeach;

                return $this->redirect(array('controller' => 'actions', 'action' => 'edit', $record_id));
            } else {
                $this->Flash->error(__('The action could not be saved. Please, try again.'));
            }
        }
        $trips = $this->Actions->Trips->find('list', ['limit' => 200]);
        $types = $this->Actions->Types->find('list', ['limit' => 200]);
        $users = $this->Actions->Users->find('list', ['limit' => 200]);

        // $allTypes is an array with all available types
        $queryTypes = $this->Actions->Types->find('all')
            ->contain(['Categories']);
        $allTypes = $queryTypes->all();

        // $allCategory is an array with all available categories
        $queryCategories = $this->Actions->Types->Categories->find();
        $allCategories = $queryCategories->all();

        $trip = $this->Actions->Trips->get($trip_id);
        $this->set(compact('trip', 'allTypes', 'allCategories'));

        $this->set(compact('action', 'trips', 'types', 'users', 'allTypes', 'allCategories'));
        $this->set('_serialize', ['trip', 'allTypes', 'allCategories']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Action id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $action = $this->Actions->get($id, [
            'contain' => ['Trips','Users', 'Types']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $action = $this->Actions->patchEntity($action, $this->request->data);
            if ($this->Actions->save($action)) {
                $this->Flash->success(__('The action has been saved.'));
                return $this->redirect(array('controller' => 'actions', 'action' => 'plan', $action->trip_id));
            } else {
                $this->Flash->error(__('The action could not be saved. Please, try again.'));
            }
        }
        $trips = $this->Actions->Trips->find('list', ['limit' => 200]);
        $types = $this->Actions->Types->find('list', ['limit' => 200]);
        $users = $this->Actions->Users->find('list', ['limit' => 200]);

        // $allTypes is an array with all available types
        $queryTypes = $this->Actions->Types->find('all')
            ->contain(['Categories']);
        $allTypes = $queryTypes->all();

        // $allCategory is an array with all available categories
        $queryCategories = $this->Actions->Types->Categories->find();
        $allCategories = $queryCategories->all();

        $this->set(compact('action', 'trips', 'types', 'users', 'allTypes', 'allCategories'));
        $this->set('_serialize', ['action', 'allTypes', 'allCategories']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Action id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $action = $this->Actions->get($id);
        if ($this->Actions->delete($action)) {
            $this->Flash->success(__('The action has been deleted.'));
        } else {
            $this->Flash->error(__('The action could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Budget method
     *
     * @param string|null $id Trip id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function budget($trip_id = null) {

        // $actions is an array that contains all the following tables
        $queryActions = $this->Actions->find('all',[
            'contain' => ['Users', 'Trips', 'Types', 'Payments'],
            'order' => ['start_date' => 'ASC']
        ]);
        // Choose only actions related to the specified trip ($trip_id)
        $queryActions->matching('Trips', function ($q) use ($trip_id) {
            return $q
                ->where(['Trips.id' => $trip_id]);
        });
        // Choose only actions where the authentified user is participating
        $queryActions->matching('Users', function ($q) {
            return $q->where(['users.id' => $this->Auth->user('id')]);
        });
        $actions = $queryActions->all();

        // $tripUsers is an array with all users of the given trip
        $queryTrip = $this->Actions->Trips->find()
            ->contain('Users')
            ->where(['Trips.id' => $trip_id]);

        $trip = $queryTrip->first();
        $tripUsers = $trip->users;

        // we pass the variables to the view
        $this->set([
            'actions' => $actions,
            'trip' => $trip,
            'tripUsers' => $tripUsers
        ]);
        $this->set(compact('actions', 'trip', 'tripUsers'));
        $this->set('_serialize', ['actions', 'users', 'tripUsers']);
    }

    /**
     * Map method
     *
     * @param string|null $id Trip id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function map($trip_id = null) {

        // $actions is an array that contains all the following tables
        $queryActions = $this->Actions->find('all',[
            'contain' => ['Users', 'Trips', 'Types', 'Payments'],
            'order' => ['start_date' => 'ASC']
        ]);
        // Choose only actions related to the specified trip ($trip_id)
        $queryActions->matching('Trips', function ($q) use ($trip_id) {
            return $q->where(['Trips.id' => $trip_id]);
        });
        // Choose only actions where the authentified user is participating
        $queryActions->matching('Users', function ($q) {
            return $q->where(['users.id' => $this->Auth->user('id')]);
        });
        $actions = $queryActions->all();

        // $tripUsers is an array with all users of the given trip
        $queryTrip = $this->Actions->Trips->find()
            ->contain('Users')
            ->where(['Trips.id' => $trip_id]);

        $trip = $queryTrip->first();
        $tripUsers = $trip->users;

        // we pass the variables to the view
        $this->set([
            'actions' => $actions,
            'trip' => $trip,
            'tripUsers' => $tripUsers
        ]);
        $this->set(compact('actions', 'trip', 'tripUsers'));
        $this->set('_serialize', ['actions', 'users', 'tripUsers']);
    }

    /**
     * Plan method
     *
     * @param string|null $id Trip id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function plan($trip_id = null) {

        /**
         * The following block to allow only the participant of an action to see the action
         */

        // $actions is an array that contains all the following tables
        $queryActions = $this->Actions->find('all',[
            'contain' => ['Users', 'Trips', 'Types', 'Payments'],
            'order' => ['start_date' => 'ASC']
        ]);
        // Choose only actions related to the specified trip ($trip_id)
        $queryActions->matching('Trips', function ($q) use ($trip_id) {
            return $q
                ->where(['Trips.id' => $trip_id]);
        });
        // Choose only actions where the authentified user is participating
        $queryActions->matching('Users', function ($q) {
            return $q
                ->where(['users.id' => $this->Auth->user('id')]);
        });
        $actions = $queryActions->all();

        // $tripUsers is an array with all users of the given trip
        $queryTrip = $this->Actions->Trips->find()
            ->contain('Users')
            ->where(['Trips.id' => $trip_id]);
        $trip = $queryTrip->first();
        $tripUsers = $trip->users;

        // we pass the variables to the view
        $this->set([
            'actions' => $actions,
            'trip' => $trip,
            'tripUsers' => $tripUsers
        ]);
        $this->set(compact('actions', 'trip', 'tripUsers'));
        $this->set('_serialize', ['actions', 'users', 'tripUsers']);
    }


    /*
    TODO: The following function is for version 2 (not used):
    Plan, Map and Budget show all trip actions except when private and not participating in the action
    */
    public function private($trip_id = null) {

        /**
         * SHOW ALL TRIP ACTIONS EXCEPT THE PRIVATE ONES WHEN AUTHENTIFIED USER IS INVOLVED
         */

        /* GET ALL PRIVATE ACTIONS THAT INVOLVE ME (private=1) */
        /* ----------------------------------------------------*/
        // $queryActionsP1 is an array that contains all the following tables
        $queryActionsP1 = $this->Actions->find('all',[
            'contain' => ['Users', 'Trips', 'Types', 'Payments']
        ]);
        // Select only actions related to the specified trip ($trip_id)
        $queryActionsP1->matching('Trips', function ($q) use ($trip_id) {
            $q->where(['Trips.id' => $trip_id]);
            return $q;
        });
        // Select private actions where the authorized user is involved in
        $currentUserId = $this->Auth->user('id');
        $queryActionsP1->matching('Users', function($q) use ($currentUserId) {
            $q->where([
                'Users.id' => $currentUserId,
                'AND' => ['private' => 1]
            ]);
            return $q;
        });

        $actionsP1 = $queryActionsP1->toArray();

        // Set 'participating' value to true to fade when not participating
        // TODO: do the same for non private actions (but how?)
        foreach($actionsP1 as $action) {
            $action['participating'] = true;
        };

        /* GET ALL PUBLIC ACTIONS (private=0) */
        /* -----------------------------------*/
        // $queryActionsP0 is an array that contains all the following tables
        $queryActionsP0 = $this->Actions->find('all',[
            'contain' => ['Users', 'Trips', 'Types', 'Payments']
        ]);
        // Select only actions related to the specified trip ($trip_id)
        $queryActionsP0->matching('Trips', function ($q) use ($trip_id) {
            $q->where(['Trips.id' => $trip_id]);
            return $q;
        });
        // Select all public actions (private=0)
        $queryActionsP0->where(['private' => 0]);
        $actionsP0 = $queryActionsP0->toArray();

        // Merge the two actionsP1 and actionsP0 arrays and sort them by start_date
        $actions = Hash::merge($actionsP1, $actionsP0);
        $actions = Hash::sort($actions, '{n}.start_date', 'asc');


        // $tripUsers is an array with all users of the given trip
        $queryTrip = $this->Actions->Trips->find()
            ->contain('Users')
            ->where(['Trips.id' => $trip_id]);
        $trip = $queryTrip->first();
        $tripUsers = $trip->users;

        // we pass the variables to the view
        $this->set([
            'actions' => $actions,
            'trip' => $trip,
            'tripUsers' => $tripUsers
        ]);
        $this->set(compact('actions', 'trip', 'tripUsers'));
        $this->set('_serialize', ['actions', 'users', 'tripUsers']);
    }
}
