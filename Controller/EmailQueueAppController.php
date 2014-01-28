<?php
App::uses('AppController', 'Controller');
/**
 * EmailQueues Controller
 *
 */
class EmailQueueAppController extends AppController
{
    public function beforeFilter()
    {
        // Install admin-wide authorization.
        $this->_installAuthorization('Admin.Admin');

        parent::beforeFilter();

        // Treat Admin views as fallback
        foreach (App::path('View', 'Admin') as $viewPath) {
            App::build(
                array(
                    'View' => $viewPath,
                ),
                App::PREPEND
            );
        }
    }

}
