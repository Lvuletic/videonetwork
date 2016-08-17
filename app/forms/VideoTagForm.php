<?php

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Check;

class VideoTagForm extends Form
{
    public function initialize()
    {
        foreach (Tag::find() as $tag) {
            $check = new Check($tag->getName(), array('id' => $tag->getName(), 'name' => 'tags[]', 'value' => $tag->getId()));
            $check->setLabel($tag->getName());
            $this->add($check);
        }
    }

}