<?php

use Phalcon\Mvc\Controller;
use Phalcon\Translate\Adapter\NativeArray;

class ControllerBase extends Controller
{
    public function initialize() {

        $this->loadTranslation();
        $this->tag->setDoctype(\Phalcon\Tag::HTML5);

    }

    public function loadTranslation() {
        $translationPath = '../app/messages/';
        $language = $this->dispatcher->getParam('language');
        if (!$language) {
            $this->dispatcher->setParam('language', 'en');
            $language = 'en';
        }
        //var_dump($translationPath . $language . '.php'); die();
        require $translationPath . $language . '.php';
        $translator = new NativeArray(array(
           'content' => $messages,
        ));

        $this->view->setVar('t', $translator);
        $this->view->setVar('lang', $language);
    }

}
