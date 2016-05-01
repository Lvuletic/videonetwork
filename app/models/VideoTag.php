<?php

class VideoTag extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    protected $id;

    /**
     *
     * @var integer
     */
    protected $video;

    /**
     *
     * @var integer
     */
    protected $tag;

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
     * Method to set the value of field video
     *
     * @param integer $video
     * @return $this
     */
    public function setVideo($video)
    {
        $this->video = $video;

        return $this;
    }

    /**
     * Method to set the value of field tag
     *
     * @param integer $tag
     * @return $this
     */
    public function setTag($tag)
    {
        $this->tag = $tag;

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
     * Returns the value of field video
     *
     * @return integer
     */
    public function getVideo()
    {
        return $this->video;
    }

    /**
     * Returns the value of field tag
     *
     * @return integer
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->belongsTo('tag', 'Tag', 'id', array('alias' => 'Tag'));
        $this->belongsTo('video', 'Video', 'id', array('alias' => 'Video'));
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'video_tag';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return VideoTag[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return VideoTag
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
