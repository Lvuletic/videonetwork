<?php

class IndexController extends ControllerBase
{
    public function initialize() {
        parent::initialize();
    }

    public function indexAction() {
        $this->view->searchForm = new SearchForm();
        $this->view->tagForm = new VideoTagForm();

        $allVideos = Video::find();
        $this->view->allVideos = $allVideos;
    }


}

