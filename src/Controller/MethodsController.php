<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Methods Controller
 *
 * @property \App\Model\Table\MethodsTable $Methods
 */
class MethodsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $methods = $this->paginate($this->Methods);

        $this->set(compact('methods'));
        $this->set('_serialize', ['methods']);
    }

    /**
     * View method
     *
     * @param string|null $id Method id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $method = $this->Methods->get($id, [
            'contain' => ['Payments']
        ]);

        $this->set('method', $method);
        $this->set('_serialize', ['method']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $method = $this->Methods->newEntity();
        if ($this->request->is('post')) {
            $method = $this->Methods->patchEntity($method, $this->request->data);
            if ($this->Methods->save($method)) {
                $this->Flash->success(__('The method has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The method could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('method'));
        $this->set('_serialize', ['method']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Method id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $method = $this->Methods->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $method = $this->Methods->patchEntity($method, $this->request->data);
            if ($this->Methods->save($method)) {
                $this->Flash->success(__('The method has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The method could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('method'));
        $this->set('_serialize', ['method']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Method id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $method = $this->Methods->get($id);
        if ($this->Methods->delete($method)) {
            $this->Flash->success(__('The method has been deleted.'));
        } else {
            $this->Flash->error(__('The method could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
