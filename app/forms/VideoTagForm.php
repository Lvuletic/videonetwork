<?php

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Check;
use Phalcon\Forms\Element\Submit;


class VideoTagForm extends Form
{
    public function initialize()
    {
        foreach (Tag::find() as $tag) {
            $check = new Check('check_' . $tag->getName());
            $this->add($check);
        }

        $button = new Submit('submit');
        $this->add($button);
    }

}