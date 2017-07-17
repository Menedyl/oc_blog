<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;


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

    /**
     * @var string $url
     *
     * @Column(name="url", type="string", length=255)
     */
    private $url;

    /**
     * @var Collection $images
     *
     * @OneToMany(targetEntity="Image", mappedBy="post", cascade={"persist", "remove"})
     */
    private $images;


    public function __construct()
    {
        $this->dateCreate = new \DateTime();
        $this->author = 'Nicolas Bostjancic';
        $this->images = new ArrayCollection();
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

    /**
     * @return Collection
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * @param Image $image
     */
    public function addImage(Image $image)
    {
        $this->images->add($image);

        $image->setPost($this);
    }

    /**
     * @param Image $image
     */
    public function removeImage(Image $image)
    {
        $this->images->remove($image);
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url)
    {
        $this->url = $url;
    }


}