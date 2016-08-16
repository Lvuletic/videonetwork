<?php

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Element\Submit;

class LoginForm extends Form
{
    public function initialize()
    {
        $this->setAction('/login/login');

        $username = new Text('username');
        $username->setLabel($this->translate->_('username'));
        $this->add($username);

        $password = new Password('password');
        $password->setLabel($this->translate->_('password'));
        $this->add($password);

        $button = new Submit('submit');
        $this->add($button);

    }

}