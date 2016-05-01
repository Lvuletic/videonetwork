<?php

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Submit;


class TagForm extends Form
{
    public function initialize($object = null)
    {
        if (!$object)
            $this->setAction('add');

        // todo
        $name = new Text('name');
       // $name->setLabel($this->translate->_("tagName"));
        /*$name->addValidator(new PresenceOf(array(
            'message' => 'Tag name is required'
        )));*/
        $this->add($name);

        $button = new Submit('submit');
        $this->add($button);
    }

}