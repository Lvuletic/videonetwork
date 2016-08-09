<?php

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\File;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\TextArea;
use Phalcon\Forms\Element\Submit;
use Phalcon\Validation\Validator\PresenceOf;


class VideoForm extends Form
{
    public function initialize($object = null)
    {
        if (!$object)
            $this->setAction('upload');

        $file = new File('video');
        $this->add($file);

        // todo
        $title = new Text('title');
        $title->setLabel($this->translate->_('videoTitle'));
        $title->addValidator(new PresenceOf(array(
            'message' => $this->translate->_('videoTitleRequired')
        )));
        $this->add($title);

        $description = new TextArea('description');
        $description->setLabel($this->translate->_('videoDescription'));
        $this->add($description);

        $button = new Submit('submit');
        $this->add($button);
    }

}