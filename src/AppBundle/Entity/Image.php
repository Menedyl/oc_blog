<?php

namespace AppBundle\Entity;


/**
 * Class Image
 *
 * @Entity(repositoryClass="AppBundle\Repository\ImageRepository")
 * @Table(name="image")
 */
class Image
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
     * @Column(name="url", type="string")
     */
    private $url;

    /**
     * @var string
     *
     * @Column(name="alt", type="string")
     */
    private $alt;

    /**
     * @var Post $post
     *
     * @ManyToOne(targetEntity="Post", inversedBy="images" ,cascade={"persist", "remove"})
     */
    private $post;


    public function __construct()
    {
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getUrl(): string
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

    /**
     * @return string
     */
    public function getAlt(): string
    {
        return $this->alt;
    }

    /**
     * @param string $alt
     */
    public function setAlt(string $alt)
    {
        $this->alt = $alt;
    }


}