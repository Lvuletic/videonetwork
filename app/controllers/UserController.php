<?php

class UserController extends ControllerBase
{
    public function initialize() {
        parent::initialize();
    }

    public function indexAction() {

    }

    public function registerAction() {
        $form = new RegistrationForm();
        if ($this->request->isPost()) {
            if (!$form->isValid($this->request->getPost())) { // todo proper error msg
                foreach ($form->getMessages() as $message);
                echo $message, '<br>';
            }

            $user = new User();
            $user->setUsername($this->request->get('username'));
            $password = $this->security->hash($this->request->get('password'));
            $user->setPassword($password);
            $user->setEmail($this->request->get('email'));

            if ($user->save() == false) {
                foreach ($user->getMessages() as $message) { // todo proper error msg
                    echo $message->getMessage(), "<br/>";
                }
            }

            $this->response->redirect('en/index/index'); // todo flash messages
        }
        $this->view->form = $form;
    }

}