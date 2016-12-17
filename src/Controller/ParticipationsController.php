<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Participations Controller
 *
 * @property \App\Model\Table\ParticipationsTable $Participations
 */
class ParticipationsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Actions']
        ];
        $participations = $this->paginate($this->Participations);

        $this->set(compact('participations'));
        $this->set('_serialize', ['participations']);
    }

    /**
     * View method
     *
     * @param string|null $id Participation id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $participation = $this->Participations->get($id, [
            'contain' => ['Users', 'Actions']
        ]);

        $this->set('participation', $participation);
        $this->set('_serialize', ['participation']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $participation = $this->Participations->newEntity();
        if ($this->request->is('post')) {
            $participation = $this->Participations->patchEntity($participation, $this->request->data);
            if ($this->Participations->save($participation)) {
                $this->Flash->success(__('The participation has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The participation could not be saved. Please, try again.'));
            }
        }
        $users = $this->Participations->Users->find('list', ['limit' => 200]);
        $actions = $this->Participations->Actions->find('list', ['limit' => 200]);
        $this->set(compact('participation', 'users', 'actions'));
        $this->set('_serialize', ['participation']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Participation id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $participation = $this->Participations->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $participation = $this->Participations->patchEntity($participation, $this->request->data);
            if ($this->Participations->save($participation)) {
                $this->Flash->success(__('The participation has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The participation could not be saved. Please, try again.'));
            }
        }
        $users = $this->Participations->Users->find('list', ['limit' => 200]);
        $actions = $this->Participations->Actions->find('list', ['limit' => 200]);
        $this->set(compact('participation', 'users', 'actions'));
        $this->set('_serialize', ['participation']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Participation id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $participation = $this->Participations->get($id);
        if ($this->Participations->delete($participation)) {
            $this->Flash->success(__('The participation has been deleted.'));
        } else {
            $this->Flash->error(__('The participation could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
