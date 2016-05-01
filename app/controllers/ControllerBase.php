<?php

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{
    public function initialize() {
        
    }

    public function loadTranslation() {
        $translationPath = '../app/messages/';
        $language = $this->dispatcher->getParam('language');
        if (!$language) {
            $this->dispatcher->setParam('language', 'en');
            $language = 'en';
        }
        require $translationPath . $language . '.php';
        $translator = new Phalcon\Translate\Adapter\NativeArray(array(
           'content' => $messages,
        ));

        $this->view->setVar('t', $translator);
    }

}
