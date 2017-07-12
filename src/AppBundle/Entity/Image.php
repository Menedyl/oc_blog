<?php

namespace AppBundle\Entity;

use Symfony\Component\HttpFoundation\File\UploadedFile;


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
     * @ManyToOne(targetEntity="Post", inversedBy="images")
     */
    private $post;

    /** @var UploadedFile $file */
    private $file;


    public function __construct()
    {
    }


    public function upload()
    {
        $name = $this->file->getClientOriginalName();

        $this->file->move($this->getUploadRootDir(), $name);

        $this->url = $name;
        $this->alt = $name;
    }

    public function getUploadRootDir()
    {
        return __DIR__ . '/../../../web/' . $this->getUploadDir();
    }

    public function getUploadDir()
    {
        return 'img/uploads';
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

    /**
     * @return mixed
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param mixed $file
     */
    public function setFile(UploadedFile $file)
    {
        $this->file = $file;
    }

    /**
     * @return Post
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * @param Post $post
     */
    public function setPost(Post $post)
    {
        $this->post = $post;
    }


}