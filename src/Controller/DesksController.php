<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Desks Controller
 *
 * @property \App\Model\Table\DesksTable $Desks
 * @method \App\Model\Entity\Desk[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DesksController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->Authorization->skipAuthorization();
        
        $desks = $this->paginate($this->Desks);

        $this->set(compact('desks'));
    }

    /**
     * View method
     *
     * @param string|null $id Desk id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $desk = $this->Desks->get($id, [
            'contain' => ['Employees'],
        ]);

        $this->set(compact('desk'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $desk = $this->Desks->newEmptyEntity();
        if ($this->request->is('post')) {
            $desk = $this->Desks->patchEntity($desk, $this->request->getData());
            if ($this->Desks->save($desk)) {
                $this->Flash->success(__('The desk has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The desk could not be saved. Please, try again.'));
        }
        $this->set(compact('desk'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Desk id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $desk = $this->Desks->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $desk = $this->Desks->patchEntity($desk, $this->request->getData());
            if ($this->Desks->save($desk)) {
                $this->Flash->success(__('The desk has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The desk could not be saved. Please, try again.'));
        }
        $this->set(compact('desk'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Desk id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $desk = $this->Desks->get($id);
        if ($this->Desks->delete($desk)) {
            $this->Flash->success(__('The desk has been deleted.'));
        } else {
            $this->Flash->error(__('The desk could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
