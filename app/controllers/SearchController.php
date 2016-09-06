<?php

use Elasticsearch\ClientBuilder;

class SearchController extends ControllerBase
{
    public function initialize() {
        parent::initialize();
    }

    public function searchAction() {
        $search = $this->request->getPost('search');
        $tags = $this->request->getPost('tags');

        $client = ClientBuilder::create()->build();
        $params = [
            'index' => 'video',
            'type' => 'video',
            'body' => [
                'query' => [
                    'match' => [
                        'title' => $search
                    ]
                ]
            ]
        ];  // todo search by tags

        $response = $client->search($params);
        //echo '<pre>';
        //var_dump($response); die();
        foreach ($response as $r) {
            echo '<pre>';
            var_dump($r);

        } die();

        /* $video = new stdClass();
         $video->title = $response['_source']['title'];
         $video->description = $response['_source']['description'];
         $video->upload_date = $response['_source']['upload_date'];
         $video->views = $response['_source']['views'];*/
    }

}