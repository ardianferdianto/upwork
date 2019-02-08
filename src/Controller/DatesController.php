<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Object\Date;
use App\Service\DateService;

/**
 * Dates Controller
 *
 * @property \App\Model\Table\DatesTable $Dates
 *
 * @method \App\Model\Entity\Date[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DatesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $dates = $this->paginate($this->Dates);

        $this->set(compact('dates'));
    }

    public function count()
    {
        if ($this->request->is('ajax')) {

            $date1 = new Date($this->request->getData('date_from'));
            $date2 = new Date($this->request->getData('date_to'));

            $dateService = new DateService;

            $diff['data'] = $dateService->date_diff($date1, $date2);
            $diff['status'] = "success";
            $this->set([
                'response' => $diff,
                '_serialize' => 'response',
            ]);

            $this->RequestHandler->renderAs($this, 'json');
        }
    }

    public function viewAll()
    {
        $dates = $this->paginate($this->Dates);
        $this->set([
            'response' => $dates,
            '_serialize' => 'response',
        ]);

        $this->RequestHandler->renderAs($this, 'json');
    }
    /**
     * View method
     *
     * @param string|null $id Date id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $date = $this->Dates->get($id, [
            'contain' => []
        ]);

        $this->set('date', $date);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $date = $this->Dates->newEntity();
        if ($this->request->is('ajax')) {
            $date = $this->Dates->patchEntity($date, $this->request->getData());
            if ($this->Dates->save($date)) {
                $response['message'] = 'The date has been saved.';
                $response['status'] = "success";
            } else {
                $response['message'] = 'The date could not be saved. Please, try again.';
                $response['status'] = "fail";
            }
        }

        $this->set([
            'response' => $response,
            '_serialize' => 'response',
        ]);
        $this->RequestHandler->renderAs($this, 'json');
    }

    /**
     * Edit method
     *
     * @param string|null $id Date id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $date = $this->Dates->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $date = $this->Dates->patchEntity($date, $this->request->getData());
            if ($this->Dates->save($date)) {
                $this->Flash->success(__('The date has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The date could not be saved. Please, try again.'));
        }
        $this->set(compact('date'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Date id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $date = $this->Dates->get($id);
        if ($this->Dates->delete($date)) {
            $this->Flash->success(__('The date has been deleted.'));
        } else {
            $this->Flash->error(__('The date could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
