<?php

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\File;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\TextArea;
use Phalcon\Forms\Element\Submit;


class VideoForm extends Form
{
    public function initialize($object = null)
    {
        if (!$object)
            $this->setAction('upload');

        $file = new File('video');
        $this->add($file);

        // todo
        $name = new Text('name');
       // $name->setLabel($this->translate->_("videoName"));
        /*$name->addValidator(new PresenceOf(array(
            'message' => 'Video name is required'
        )));*/
        $this->add($name);

        $description = new TextArea('description');
       // $description->setLabel($this->translate->_("videoDescription"));
        $this->add($description);

        $button = new Submit('submit');
        $this->add($button);
    }

}