<?php

class TagController extends ControllerBase
{
    public function initialize() {
        parent::initialize();
    }

    public function addAction() {
        $form = new TagForm();

        if ($this->request->isPost()) {
            $tag = new Tag();
            $tag->setName($this->request->getPost('name'));
            $tag->save();
        }

        // todo flash messages
        $this->view->form = $form;
        $this->view->pick('tag/edit');
    }

    public function editAction($code) {
        $tag = Tag::findFirst($code);
        $form = new TagForm($tag);

        if ($this->request->isPost()) {
            $tag->setName($this->request->getPost('name'));
            $tag->save();
        }

        // todo flash messages
        $this->view->form = $form;
    }

}