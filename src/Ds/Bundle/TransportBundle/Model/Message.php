<?php

namespace Ds\Bundle\TransportBundle\Model;

/**
 * Class Message
 */
class Message
{
    /**
     * @var string
     */
    protected $to; # region accessors

    /**
     * Set to
     *
     * @param string $to
     * @return \Ds\Bundle\TransportBundle\Model\Message
     */
    public function setTo($to)
    {
        $this->to = $to;

        return $this;
    }

    /**
     * Get to
     *
     * @return string
     */
    public function getTo()
    {
        return $this->to;
    }

    # endregion

    /**
     * @var string
     */
    protected $from; # region accessors

    /**
     * Set from
     *
     * @param string $from
     * @return \Ds\Bundle\TransportBundle\Model\Message
     */
    public function setFrom($from)
    {
        $this->from = $from;

        return $this;
    }

    /**
     * Get from
     *
     * @return string
     */
    public function getFrom()
    {
        return $this->from;
    }

    # endregion

    /**
     * @var string
     */
    protected $title; # region accessors

    /**
     * Set title
     *
     * @param string $title
     * @return \Ds\Bundle\TransportBundle\Model\Message
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    # endregion

    /**
     * @var string
     */
    protected $content; # region accessors

    /**
     * Set content
     *
     * @param string $content
     * @return \Ds\Bundle\TransportBundle\Model\Message
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    # endregion
}
