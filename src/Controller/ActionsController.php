<?php
namespace App\Controller;

use App\Controller\AppController;

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
        $action = $this->Actions->get($id, [
            'contain' => ['Trips', 'Types', 'Participations', 'Payments']
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
            if ($this->Actions->save($action)) {
                $this->Flash->success(__('The action has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The action could not be saved. Please, try again.'));
            }
        }
        $trips = $this->Actions->Trips->find('list', ['limit' => 200]);
        $types = $this->Actions->Types->find('list', ['limit' => 200]);
        $this->set(compact('action', 'trips', 'types'));
        $this->set(['trip_id' => $trip_id]);
        $this->set('_serialize', ['action']);
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
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $action = $this->Actions->patchEntity($action, $this->request->data);
            if ($this->Actions->save($action)) {
                $this->Flash->success(__('The action has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The action could not be saved. Please, try again.'));
            }
        }
        $trips = $this->Actions->Trips->find('list', ['limit' => 200]);
        $types = $this->Actions->Types->find('list', ['limit' => 200]);
        $this->set(compact('action', 'trips', 'types'));
        $this->set('_serialize', ['action']);
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
}
