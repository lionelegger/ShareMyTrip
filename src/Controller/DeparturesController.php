<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Departures Controller
 *
 * @property \App\Model\Table\DeparturesTable $Departures
 */
class DeparturesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Actions']
        ];
        $departures = $this->paginate($this->Departures);

        $this->set(compact('departures'));
        $this->set('_serialize', ['departures']);
    }

    /**
     * View method
     *
     * @param string|null $id Departure id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $departure = $this->Departures->get($id, [
            'contain' => ['Actions']
        ]);

        $this->set('departure', $departure);
        $this->set('_serialize', ['departure']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $departure = $this->Departures->newEntity();
        if ($this->request->is('post')) {
            $departure = $this->Departures->patchEntity($departure, $this->request->data);
            if ($this->Departures->save($departure)) {
                $this->Flash->success(__('The departure has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The departure could not be saved. Please, try again.'));
            }
        }
        $actions = $this->Departures->Actions->find('list', ['limit' => 200]);
        $this->set(compact('departure', 'actions'));
        $this->set('_serialize', ['departure']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Departure id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $departure = $this->Departures->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $departure = $this->Departures->patchEntity($departure, $this->request->data);
            if ($this->Departures->save($departure)) {
                $this->Flash->success(__('The departure has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The departure could not be saved. Please, try again.'));
            }
        }
        $actions = $this->Departures->Actions->find('list', ['limit' => 200]);
        $this->set(compact('departure', 'actions'));
        $this->set('_serialize', ['departure']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Departure id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $departure = $this->Departures->get($id);
        if ($this->Departures->delete($departure)) {
            $this->Flash->success(__('The departure has been deleted.'));
        } else {
            $this->Flash->error(__('The departure could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
