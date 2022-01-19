<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Database\Expression\QueryExpression;
use Cake\ORM\Query;
use App\Model\Entity\Employee;
use Cake\Database\Schema\TableSchema;

/**
 * Cars Controller
 *
 * @property \App\Model\Table\CarsTable $Cars
 * @method \App\Model\Entity\Car[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CarsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->Authorization->skipAuthorization();

        $cars = $this->paginate($this->Cars);

        $this->set(compact('cars'));
    }

    /**
     * View method
     *
     * @param string|null $id Car id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $car = $this->Cars->get($id, [
            'contain' => ['CarEmp'],
        ]);

        $this->set(compact('car'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $car = $this->Cars->newEmptyEntity();
        if ($this->request->is('post')) {
            $car = $this->Cars->patchEntity($car, $this->request->getData());
            if ($this->Cars->save($car)) {
                $this->Flash->success(__('The car has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The car could not be saved. Please, try again.'));
        }
        $this->set(compact('car'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Car id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $car = $this->Cars->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $car = $this->Cars->patchEntity($car, $this->request->getData());
            if ($this->Cars->save($car)) {
                $this->Flash->success(__('The car has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The car could not be saved. Please, try again.'));
        }
        $this->set(compact('car'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Car id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $car = $this->Cars->get($id);
        if ($this->Cars->delete($car)) {
            $this->Flash->success(__('The car has been deleted.'));
        } else {
            $this->Flash->error(__('The car could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * switchCars method
     * Permet d'échanger les voitures entre deux employés.
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function switchCars()
    {
        $this->Authorization->skipAuthorization();
        
        /* Heavy controller
        $query = $this->getTableLocator()->get('carEmp')->find('all')->contain([
            'Employees',
            'Cars',
        ]);*/

        //Heavy model
        $query = $this->Cars->CarEmp->find('Attributions');

        //Traitement du formulaire
        if ($this->request->is(['patch', 'post', 'put'])) {
            $carEmpIds = $this->request->getData();

            //dd($carEmpIds);
            if(sizeof($carEmpIds)==2) {
                $carEmpTable = $this->getTableLocator()->get('carEmp');

                //Récupérer les 2 attributions
                $attributions[] = $carEmpTable->findById(array_pop($carEmpIds))->first();
                $attributions[] = $carEmpTable->findById(array_pop($carEmpIds))->first();
                //dd($attributions);

                try {
                    $carEmpTable->getConnection()->transactional(function () use ($carEmpTable, $attributions) {
                        //Copie des numéros d'employé
                        $employee1_empNo = $attributions[0]->emp_no;
                        $employee2_empNo = $attributions[1]->emp_no;

                        //Suppression des références d'employés
                        $attributions[0]->emp_no = null;
                        $attributions[1]->emp_no = null;
                        $carEmpTable->save($attributions[0], ['atomic' => false]);
                        $carEmpTable->save($attributions[1], ['atomic' => false]);

                        //Echange des références d'employés
                        $attributions[0]->emp_no = $employee2_empNo;
                        $attributions[1]->emp_no = $employee1_empNo;
                        $carEmpTable->save($attributions[0], ['atomic' => false]);
                        $carEmpTable->save($attributions[1], ['atomic' => false]);

                        $this->Flash->success(__('The exchange has been saved.'));
                   });
                } catch(\Cake\ORM\Exception\PersistenceFailedException $e) {
                    $carEmpTable->getConnection()->getConnection()->rollback();

                    $this->Flash->error(__('The exchange could not be saved. Please, try again.'));
                }
            } else {
                $this->Flash->error(__('Vous devez choisir exactement 2 employés!'));
            }
        }

        $carEmps = $this->paginate($query);

        $this->set(compact('carEmps'));
    }
}
