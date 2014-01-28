<?php
App::uses('EmailQueueAppController', 'EmailQueue.Controller');

/**
 * EmailQueues Controller
 *
 * @property EmailQueue $EmailQueue
 */
class EmailQueuesController extends EmailQueueAppController
{
    public $helpers = array(
        //'DebugKit.HtmlToolbar',
    );

    /**
     * index method
     *
     * @return void
     */
    public function index()
    {
        $this->EmailQueue->recursive = 0;
        $this->set('emailQueues', $this->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null)
    {
        $data = $this->EmailQueue->read(null,$id);

        $configName = $data['EmailQueue']['config'];
        $template = $data['EmailQueue']['template'];
        $layout = $data['EmailQueue']['layout'];

        $email = new CakeEmail($configName);

        $email->transport('Debug')
            ->to($data['EmailQueue']['to'])
            ->subject($data['EmailQueue']['subject'])
            ->template($template, $layout)
            ->emailFormat($data['EmailQueue']['format'])
            ->viewVars($data['EmailQueue']['template_vars']);

        if (isset($data['EmailQueue']['template_vars']['language'])) {
            Configure::write('Config.language', $data['EmailQueue']['template_vars']['language']);
            Router::getRequest()->params['language'] = $data['EmailQueue']['template_vars']['language'];
        }

        $email_text = $email->send();
        $this->set(compact('email_text'));
        $this->set(compact('data'));
    }

/**
 * add method
 *
 * @return void
 */
    public function add() {
        if ($this->request->is('post')) {
            $this->EmailQueue->create();
            if ($this->EmailQueue->save($this->request->data)) {
                $this->Session->setFlash(__('The email queue has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The email queue could not be saved. Please, try again.'));
            }
        }
    }

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function edit($id = null) {
        if (!$this->EmailQueue->exists($id)) {
            throw new NotFoundException(__('Invalid email queue'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->EmailQueue->save($this->request->data)) {
                $this->Session->setFlash(__('The email queue has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The email queue could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('EmailQueue.' . $this->EmailQueue->primaryKey => $id));
            $this->request->data = $this->EmailQueue->find('first', $options);
        }
    }

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function delete($id = null) {
        $this->EmailQueue->id = $id;
        if (!$this->EmailQueue->exists()) {
            throw new NotFoundException(__('Invalid email queue'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->EmailQueue->delete()) {
            $this->Session->setFlash(__('Email queue deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Email queue was not deleted'));
        $this->redirect(array('action' => 'index'));
    }
}
