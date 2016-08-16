<?php

class LoginController extends ControllerBase
{
    public function initialize() {
        parent::initialize();
    }

    public function indexAction() {
        $this->view->form = new LoginForm();
    }

    public function loginAction() {
        if ($this->request->isPost()) {
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');
            $user = User::findFirst("username = '$username'");
            if ($user && $this->security->checkHash($password, $user->getPassword())) {
                $this->session->set("user_id", $user->getId());
                $this->session->set("username", $user->getUsername());
                $this->cookies->set("user_id", $user->getId()); // todo check why exactly
                $this->flash->success($this->translate->_("loginGreet") ." ". $user->getUsername()); // todo check proper method once model is up
            } else {
                $this->flash->error($this->translate->_("loginError"));
                return $this->dispatcher->forward(array(
                    "action" => "index"
                ));
            }
        }

        $lang = $this->dispatcher->getParam("language");        // todo decide what to do with admin
        return $this->response->redirect($lang."/index/index");

    }

    public function logoutAction() {
        $this->session->remove("user_id");
        $this->flashSession->success($this->translate->_("logout"));
        $lang = $this->dispatcher->getParam("language"); // todo check langs
        return $this->response->redirect($lang."/index/index");
    }

}