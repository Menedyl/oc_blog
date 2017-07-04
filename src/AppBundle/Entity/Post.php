<?php

namespace AppBundle\Entity;



/**
 * Post
 *
 * @Entity(repositoryClass="AppBundle\Repository\PostRepository")
 * @Table(name="post")
 */
class Post
{

    /**
     * @var int
     *
     * @Column(name="id", type="integer")
     * @Id
     * @GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @Column(name="content", type="text")
     */
    private $content;

    /**
     * @var string
     *
     * @Column(name="author", type="string", length=255)
     */
    private $author;

    /**
     * @var \DateTime
     *
     * @Column(name="date_create", type="datetime")
     */
    private $dateCreate;

    /**
     * @var \DateTime
     *
     * @Column(name="date_update", type="datetime", nullable=true)
     */
    private $dateUpdate;


    public function __construct()
    {
        $this->dateCreate = new \DateTime();
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param string $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return \DateTime
     */
    public function getDateCreate()
    {
        return $this->dateCreate;

    }

    /**
     * @param \DateTime $dateCreate
     */
    public function setDateCreate(\DateTime $dateCreate)
    {
        $this->dateCreate = $dateCreate;
    }

    /**
     * @return \DateTime
     */
    public function getDateUpdate()
    {
        return $this->dateUpdate;
    }





}