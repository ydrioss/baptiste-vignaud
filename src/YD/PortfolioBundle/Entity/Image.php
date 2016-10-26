<?php

namespace YD\PortfolioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Image
 *
 * @ORM\Table(name="yd_image")
 * @ORM\Entity(repositoryClass="YD\PortfolioBundle\Repository\ImageRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Image
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255, nullable=false)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="alt", type="string", length=255, nullable=true)
     */
    private $alt;

    private $file;
    private $tempFileName;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return Image
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set alt
     *
     * @param string $alt
     *
     * @return Image
     */
    public function setAlt($alt)
    {
        $this->alt = $alt;

        return $this;
    }

    /**
     * Get alt
     *
     * @return string
     */
    public function getAlt()
    {
        return $this->alt;
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
      if (null === $this->file) {
        return;
      }
      $this->url = $this->file->guessExtension();
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
      if (null === $this->file) {
        return;
      }
      //Si on avait un ancien fichier, on le supprime
      if (null !== $this->tempFileName) {
        $oldfile = $this->getUploadRootDir().'/'.$this->id.'.'.$this->tempFileName;
        if (file_exists($oldfile)) {
          unlink($oldfile);
        }
      }

      $this->file->move(
        $this->getUploadRootDir(),
        $this->id.'.'.$this->url
      );
    }

    /**
     * @ORM\PreRemove()
     */
    public function preRemoveUpload()
    {
      //On sauvegarde temporairement le nom du fichier
      $this->tempFileName = $this->getUploadRootDir().'.'.$this->id.'.'.$this->url;
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
      if (file_exists($this->tempFileName)) {
        unlink($this->tempFileName);
      }
    }

    public function getUploadDir()
    {
      // On retourne le chemin relatif vers l'image pour un navigateur (relatif au répertoire /web donc)
      return 'uploads/img';
    }

    protected function getUploadRootDir()
    {
      // On retourne le chemin relatif vers l'image pour notre code PHP
      return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    public function getWebPath()
    {
      return $this->getUploadDir().'/'.$this->getId().'.'.$this->getUrl();
    }

    public function getFile()
    {
      return $this->file;
    }

    public function setFile(UploadedFile $file = null)
    {
      $this->file = $file;
      if (null !== $this->url) {
        $this->tempFileName = $this->url;

        //On réinitialise url et alt
        $this->url = null;
      }
    }
}
