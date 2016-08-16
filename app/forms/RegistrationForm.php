<?php

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Element\Submit;
use Phalcon\Validation\Validator\Confirmation;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\PresenceOf;

class RegistrationForm extends Form
{
    public function initialize()
    {
        $this->setAction('/user/register');

        $username = new Text('username');
        $username->setLabel($this->translate->_('username'));
        $this->add($username);

        $password = new Password('password');
        $password->setLabel($this->translate->_('password'));
        $this->add($password);

        $passwordRepeat = new Password('passwordRepeat');
        $passwordRepeat->setLabel($this->translate->_('passwordRepeat'));
        $passwordRepeat->addValidator(new Confirmation(array(
            'message' => 'Password do not match', // todo translate
            'with' => 'password'
        )));
        $this->add($passwordRepeat);

        $email = new Text("email");
        $email->setLabel("E-mail"); // todo translate
        $email->addValidator(new PresenceOf(array(
            'message' => 'Email is required'        // todo translate
        )));
        $email->addValidator(new Email(array(
            'message' => 'Email must be in the proper format' // todo translate
        )));

        $this->add($email);

        $button = new Submit('submit');
        $this->add($button);

    }

}