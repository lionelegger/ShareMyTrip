<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Arrivals Controller
 *
 * @property \App\Model\Table\ArrivalsTable $Arrivals
 */
class ArrivalsController extends AppController
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
        $arrivals = $this->paginate($this->Arrivals);

        $this->set(compact('arrivals'));
        $this->set('_serialize', ['arrivals']);
    }

    /**
     * View method
     *
     * @param string|null $id Arrival id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $arrival = $this->Arrivals->get($id, [
            'contain' => ['Actions']
        ]);

        $this->set('arrival', $arrival);
        $this->set('_serialize', ['arrival']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $arrival = $this->Arrivals->newEntity();
        if ($this->request->is('post')) {
            $arrival = $this->Arrivals->patchEntity($arrival, $this->request->data);
            if ($this->Arrivals->save($arrival)) {
                $this->Flash->success(__('The arrival has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The arrival could not be saved. Please, try again.'));
            }
        }
        $actions = $this->Arrivals->Actions->find('list', ['limit' => 200]);
        $this->set(compact('arrival', 'actions'));
        $this->set('_serialize', ['arrival']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Arrival id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $arrival = $this->Arrivals->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $arrival = $this->Arrivals->patchEntity($arrival, $this->request->data);
            if ($this->Arrivals->save($arrival)) {
                $this->Flash->success(__('The arrival has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The arrival could not be saved. Please, try again.'));
            }
        }
        $actions = $this->Arrivals->Actions->find('list', ['limit' => 200]);
        $this->set(compact('arrival', 'actions'));
        $this->set('_serialize', ['arrival']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Arrival id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $arrival = $this->Arrivals->get($id);
        if ($this->Arrivals->delete($arrival)) {
            $this->Flash->success(__('The arrival has been deleted.'));
        } else {
            $this->Flash->error(__('The arrival could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
