<?php
namespace Models;

class Movie
{
    private $id;
    private $name;
    private $duration;
    private $language;
    private $image;
    private $overview;
    private $genreList;

    public function __construct($id, $name, $language, $duration, $image, $overview)
    {
        $this->id = $id;
        $this->name = $name;
        $this->duration = $duration;
        $this->language = $language;
        $this->image = $image;
        $this->overview = $overview;
        $this->genreList = array();
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of duration
     */ 
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Set the value of duration
     *
     * @return  self
     */ 
    public function setDuration($duration)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get the value of language
     */ 
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set the value of language
     *
     * @return  self
     */ 
    public function setLanguage($language)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get the value of image
     */ 
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set the value of image
     *
     * @return  self
     */ 
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get the value of overview
     */ 
    public function getOverview()
    {
        return $this->overview;
    }

    /**
     * Set the value of overview
     *
     * @return  self
     */ 
    public function setOverview($overview)
    {
        $this->overview = $overview;

        return $this;
    }

    /**
     * Get the value of genreList
     */ 
    public function getGenreList()
    {
        return $this->genreList;
    }

    /**
     * Add a Genre to genreList
     *
     * @return  self
     */ 
    public function addToGenreList($genre)
    {
        array_push($this->genreList, $genre);

        return $this;
    }
}
?>