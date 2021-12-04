<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\I18n\FrozenDate;

/**
 * Employees Controller
 *
 * @property \App\Model\Table\EmployeesTable $Employees
 * @method \App\Model\Entity\Employee[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EmployeesController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->Authentication->allowUnauthenticated(['login']);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $employees = $this->paginate($this->Employees);
        
        $total = $this->Employees->find()->count();
        
        $this->set(compact('employees','total'));
    }

    /**
     * View method
     *
     * @param string|null $id Employee id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $employee = $this->Employees->get($id, [
            'contain' => ['Salaries'],
        ]);

        /*  Remonter dans le modèle pour alléger le contrôleur
        $salaries = $employee->salaries;
        
        $dateInfinie = new FrozenDate('9999-01-01');
        
        foreach ($salaries as $salary) {
            if($salary->to_date->equals($dateInfinie)) {
                $employee->actualSalary = $salary;                
                break;
            }
        }
        */
        
        //dd($employee);
        
        $this->set(compact('employee'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $employee = $this->Employees->newEmptyEntity();     
        
        if ($this->request->is('post')) {
            //Validation des données
            $employee = $this->Employees->patchEntity($employee, $this->request->getData());
            
            //Récupérer le dernier id 
            /* Remonter dans le modèle EmployeesTable
            $query = $this->Employees->find();
            $employeeId = $query->select(['lastId' => $query->func()->max('emp_no')])
                ->first()->lastId;
            */
            /*
            $lastId = $this->Employees->find('lastId')->first()->lastId;
            
            //incrémenter l'id
            $employee->emp_no = ++$lastId;
            */
            
            if ($this->Employees->save($employee)) {
                $this->Flash->success(__('The employee has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The employee could not be saved. Please, try again.'));
        }
        
        $this->set(compact('employee'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Employee id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $employee = $this->Employees->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $employee = $this->Employees->patchEntity($employee, $this->request->getData());
            if ($this->Employees->save($employee)) {
                $this->Flash->success(__('The employee has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The employee could not be saved. Please, try again.'));
        }
        $this->set(compact('employee'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Employee id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $employee = $this->Employees->get($id);
        if ($this->Employees->delete($employee)) {
            $this->Flash->success(__('The employee has been deleted.'));
        } else {
            $this->Flash->error(__('The employee could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function login()
    {
        $result = $this->Authentication->getResult();
        
        // Si l'utilisateur est connecté, le renvoyer ailleurs
        if ($result->isValid()) {
            $target = $this->Authentication->getLoginRedirect() ?? '/pages/home';

            return $this->redirect($target);
        }

        if ($this->request->is('post') && !$result->isValid()) {
            $this->Flash->error('Identifiant ou mot de passe invalide');
        }
    }

    public function logout()
    {
        $this->Authentication->logout();
        
        return $this->redirect(['controller' => 'Employees', 'action' => 'login']);
    }
}

