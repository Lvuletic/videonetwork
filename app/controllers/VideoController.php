<?php

use Elasticsearch\ClientBuilder;

class VideoController extends ControllerBase
{
    public function initialize() {
        parent::initialize();
    }

    public function indexAction() {
        
    }

    public function uploadAction() {
        $form = new VideoForm();
        $tagForm = new VideoTagForm();

        if ($this->request->isPost() && $this->request->hasFiles()) {

            if (!$form->isValid($this->request->getPost())) { // todo proper error msg
                foreach ($form->getMessages() as $message);
                echo $message, '<br>';
            }

            $this->db->begin();
            foreach ($this->request->getUploadedFiles() as $videoFile) {
                $video = new Video();
                $videoFileName = md5(uniqid());

                foreach (Video::$formats as $format) {
                    $videoToolkit = new \PHPVideoToolkit\Video($videoFile->getTempName());
                    $toolkitFormat = '\PHPVideoToolkit\VideoFormat_' . $format;
                    $videoFormat = new $toolkitFormat('output');
                    $videoToolkit->save(APP_PATH . Video::PATH . $format .'/'. $videoFileName . '.' . $format, $videoFormat);
                }

                $video->setTitle($this->request->getPost('title'));
                $video->setDescription($this->request->getPost('description'));
                $video->setPath($videoFileName);

                $video->setOwner(1); // todo set proper user

                if ($video->save() == false) {
                    $this->db->rollback();
                    return; // todo proper return
                }

                foreach (Tag::find() as $tag) {
                    if ($this->request->getPost('check_' . $tag->getName())) {
                        $videoTag = new VideoTag();
                        $videoTag->setVideo($video->getId());
                        $videoTag->setTag($tag->getId());
                        if ($videoTag->save() == false) {
                            $this->db->rollback();
                            return;
                        }
                    }
                }

                $this->db->commit();
            }
        }

        // todo flash messages
        $this->view->form = $form;
        $this->view->tagForm = $tagForm;
        $this->view->pick('video/video');
    }

    public function editAction($code) {
        // todo add user specifics
        $video = Video::findFirst($code);
        $form = new VideoForm($video);

        if ($this->request->isPost()) {
            $video->setName($this->request->getPost('name'));
            $video->setDescription($this->request->getPost('description'));
            $video->save();
        }

        // todo flash messages
        $this->view->form = $form;
        $this->view->isEdit = true;
        $this->view->pick('video/video');
    }

    public function deleteAction($code) {
        // todo add user specifics
        $this->db->begin();
        $video = Video::findFirst($code);

        $tags = $video->getTags();
        foreach ($tags as $tag) {
            if ($tag->delete() == false) {
                $this->db->rollback();
                return; // todo proper return
            }
        }

        // todo add delete comments when they are implemented

        if ($video->delete() == false) {
            $this->db->rollback();
            return;
        } else {
            unlink(APP_PATH . '/public/video/' . $video->getPath());
        }

        $this->db->commit();

        $this->view->pick('video/index'); // todo flash message & proper return
    }

    public function showAction($code) {
        $video = Video::findFirst($code);
        $this->view->video = $video;
    }

}