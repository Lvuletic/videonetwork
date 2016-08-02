<?php

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Password;

class LoginForm extends Form
{
    public function initialize()
    {
        $username = new Text('username');
        $username->setLabel($this->translate->_('username'));
        $this->add($username);

        $password = new Password('password');
        $password->setLabel($this->translate->_('password'));
        $this->add($password);

    }

}