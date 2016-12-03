<?php
namespace App\BusinessLogic;
use Mexitek\PHPColors\Color;

class Mood
{
    protected $name;
    protected $color;
    protected $percentage;
    protected $moodText;

    /**
     * Mood constructor.
     * @param $name
     * @param $color
     */
    public function __construct($name, $color,$moodText)
    {
        $this->name = $name;
        $this->color = $color;
        $this->percentage = rand(0, 100);
        $this->moodText = $moodText;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @param mixed $color
     */
    public function setColor($color)
    {
        $this->color = $color;
    }

    public function getColorValue(){
        /*
        $myBlue = new Color("#".$this->getColor());
        $arr = $myBlue->getHsl();
        $value = $arr["H"];
        return (int)$value;
        */
        return $this->getColor();

    }

    public function getPercentage()
    {
        return $this->percentage;
    }

    /**
     * @return mixed
     */
    public function getMoodText()
    {
        return $this->moodText;
    }

    /**
     * @param mixed $moodText
     */
    public function setMoodText($moodText)
    {
        $this->moodText = $moodText;
    }
}