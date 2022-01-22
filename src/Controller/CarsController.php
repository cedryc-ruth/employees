<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Datasource\Exception\RecordNotFoundException;
use  App\Model\Entity\CarEmp;
use Cake\I18n\FrozenDate;

/**
 * Cars Controller
 *
 * @property \App\Model\Table\CarsTable $Cars
 * @method \App\Model\Entity\Car[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CarsController extends AppController
{
    public $paginate = [
        'contain' => ['Employees','CarEmp'],
    ];

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->Authorization->skipAuthorization();

        /*$car = $this->Cars->get(5, [
            'contain'=>'Employees'
        ]);
        dd($car);*/
        //dd($this->Cars->Employees->get('10001'));

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
     * switchCars method : Echange de deux attributions de voitures
     *
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function switchCars()
    {
        $this->Authorization->skipAuthorization();

        $carEmpIds = $this->request->getData();

        if(empty($carEmpIds)) {
            return $this->redirect(['action' => 'index']);
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            if(sizeof($carEmpIds)!=2) {
                $this->Flash->error(__('Vous devez choisir 2 attributions!'));
                
                return $this->redirect(['action' => 'index']);
            }

            $id1 = array_shift($carEmpIds);
            $id2 = array_shift($carEmpIds);

            try {
                $carEmp1 = $this->Cars->CarEmp->get($id1);
                $carEmp2 = $this->Cars->CarEmp->get($id2);

                $car1 = new CarEmp([
                    'emp_no' => $carEmp2->emp_no,
                    'car_id' => $carEmp1->car_id,
                    'receipt_date' => FrozenDate::now() //On fixe à la date du jour
                    //OU BIEN
                    //'receipt_date' => $carEmp1->receipt_date    //On garde les anciennes dates
                 ]);

                $car2 = new CarEmp([
                    'emp_no' => $carEmp1->emp_no,
                    'car_id' => $carEmp2->car_id,
                    'receipt_date' => FrozenDate::now()
                ]);

                if($this->Cars->CarEmp->delete($carEmp1)) {
                    if($this->Cars->CarEmp->delete($carEmp2)) {
                        if($this->Cars->CarEmp->save($car1)) {
                            if($this->Cars->CarEmp->save($car2)) {
                                $this->Flash->success(__('The car has been saved.'));
    
                                return $this->redirect(['action' => 'index']);
                            }
                        }
                    }
                }

                $this->Flash->error(__('The car could not be saved. Please, try again.'));

                return $this->redirect(['action' => 'index']);
            } catch(RecordNotFoundException $e) {
                $this->Flash->error(__('Ces attributions semblent ne pas exister!'));
                
                return $this->redirect(['action' => 'index']);
            }
        }
        
        return $this->redirect(['action' => 'index']);
    }
}
