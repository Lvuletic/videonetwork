<?php

use Elasticsearch\ClientBuilder;

class Video extends \Phalcon\Mvc\Model
{

    const PATH = '/public/video/';
    const THUMBNAIL = '/img/thumbnail/';

    static $formats = array('mp4','webm','ogg');

    /**
     *
     * @var integer
     */
    protected $id;

    /**
     *
     * @var string
     */
    protected $title;

    /**
     *
     * @var string
     */
    protected $description;

    /**
     *
     * @var string
     */
    protected $upload_date;

    /**
     *
     * @var integer
     */
    protected $views = 0;

    /**
     *
     * @var string
     */
    protected $path;

    /**
     *
     * @var integer
     */
    protected $owner;

    /**
     *
     * @var integer
     */
    protected $duration;

    /**
     * Method to set the value of field id
     *
     * @param integer $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Method to set the value of field title
     *
     * @param string $title
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Method to set the value of field description
     *
     * @param string $description
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Method to set the value of field upload_date
     *
     * @param string $upload_date
     * @return $this
     */
    public function setUploadDate($upload_date)
    {
        $this->upload_date = $upload_date;

        return $this;
    }

    /**
     * Method to set the value of field views
     *
     * @param integer $views
     * @return $this
     */
    public function setViews($views)
    {
        $this->views = $views;

        return $this;
    }

    /**
     * Method to set the value of field path
     *
     * @param string $path
     * @return $this
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Method to set the value of field owner
     *
     * @param integer $owner
     * @return $this
     */
    public function setOwner($owner)
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * Method to set the value of field duration
     *
     * @param integer $duration
     * @return $this
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Returns the value of field id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns the value of field title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Returns the value of field description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Returns the value of field upload_date
     *
     * @return string
     */
    public function getUploadDate()
    {
        return $this->upload_date;
    }

    /**
     * Returns the value of field views
     *
     * @return integer
     */
    public function getViews()
    {
        return $this->views;
    }

    /**
     * Returns the value of field path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Returns the value of field owner
     *
     * @return integer
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * Returns the value of field duration
     *
     * @return integer
     */
    public function getDuration()
    {
        return $this->duration;
    }


    public function beforeSave() {
        $this->setUploadDate(time());
    }


    public function afterSave() {  //before save ili after save? odluciti jos sto s ID
        $client = ClientBuilder::create()->build();

        $tags = array();
        foreach ($this->videoTag as $videoTag) {
            $tags[] = $videoTag->tag->getName();
        }

        $params = [
            'index' => 'video',
            'type' => 'video',
            'id' => $this->id,
            'body' => [
                'title' => $this->title,
                'description' => $this->description,
                'upload_date' => $this->upload_date,
                'views' => $this->views,
                'tags' => $tags
            ]
        ];

        $client->index($params);
    }

    public function getThumbnail() {
        return self::THUMBNAIL . $this->path;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->hasMany('id', 'VideoTag', 'video', array('alias' => 'VideoTag'));
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Video[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Video
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }


    public function getTags()
    {
        return VideoTag::find("video = '$this->id'");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'video';
    }

    public function formatDuration() {
        $minutes = $this->duration / 60;
        $seconds = $this->duration % 60;
        return (int) $minutes . ':' . $seconds;
    }

    public function generateRoute() {
    }

}
