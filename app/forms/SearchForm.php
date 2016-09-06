<?php

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Check;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Submit;

class SearchForm extends Form {

    public function initialize() {

        $this->setAction('/search/search');

        $text = new Text('search');
        $this->add($text);

        foreach (Tag::find() as $tag) {
            $check = new Check('check_' . $tag->getName());
            $check->setLabel($tag->getName());
            $this->add($check);
        }

        $button = new Submit('submit');
        $this->add($button);

    }

}