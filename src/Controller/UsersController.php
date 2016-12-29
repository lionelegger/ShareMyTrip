<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        // Add 'logout' to the allowed actions list.
        // Add 'add' to allow register new user (when not authorized)
        $this->Auth->allow(['logout', 'add']);
    }

    // to get the current user
    public function current() {
        $this->set('user', $this->request->session()->read('Auth.User'));
    }

    // to get the user from the email (to add a user to a trip)
    public function getUserFromEmail() {

        if ($this->request->is('post')) {
            $query = $this->Users->find('all')
                ->where([$this->request->data]);
            $user = $query->first();
            // debug($user);
            if($user) {
                $this->Flash->success(__('The user has been found.'));
            } else {
                $this->Flash->error(__('The user could not be found. Please, try again.'));
            }
        }

        $this->set('user', $this->paginate());
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);

    }

    // login
    public function login()
    {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                // TODO: Change redirection URL to list of trips
                return $this->redirect($this->Auth->redirectUrl("/"));
            }
            $this->Flash->error('Your username or password is incorrect.');
        }
    }

    // logout
    public function logout()
    {
        $this->Flash->success('You are now logged out.');
        return $this->redirect($this->Auth->logout());
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
        $this->set('_serialize', ['users']);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [
                'Trips' => function ($q) {
                    return $q
                        -> select(['id', 'name'])
                        -> group(['trips.id'])
                        -> order(['trips.id' => 'ASC']);
                },
                'Participations',
                'Payments'
            ]
        ]);

        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        debug($user);
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $trips = $this->Users->Trips->find('list', ['limit' => 200]);
        $this->set(compact('user', 'trips'));
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
            'contain' => ['Trips']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $trips = $this->Users->Trips->find('list', ['limit' => 200]);
        $this->set(compact('user', 'trips'));
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
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
