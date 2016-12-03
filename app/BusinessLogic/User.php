<?php
namespace App\BusinessLogic;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Output\StreamOutput;
class User
{
    /**
     * @var Mood[]
     */
    protected $moods;

    public function __construct()
    {
        $moods [] = new Mood("Anger", '0');
        $moods [] = new Mood("Disgust", '192');
        $moods [] = new Mood("Fear", '155');
        $moods [] = new Mood("Joy", '64');
        $moods [] = new Mood("Sadness", '24');

        /*





        */
        $this->moods = $moods;
    }


    /**
     * @param $moods Mood[]
     * @return string
     */
    public function createMoodTable()
    {

        $f = fopen('php://memory', 'w+');
        $output = new StreamOutput($f);


        $table = new Table($output);
        $table
            ->setHeaders(array('Emotion', '', ''));

        $rows = array();
        foreach ($this->moods as $mood) {
            $rows[] = $this->createEmotion($mood);
        }
        $table->setRows($rows);


        $table->render();
        rewind($f);
        $contents = stream_get_contents($f);
        fclose($f);
        return $contents;
    }

    public function createEmotion(Mood $mood)
    {
        $percentage = $mood->getPercentage();

        $percentageTen = round($percentage / 25, 0);

        $percentageStr = str_pad("", $percentageTen, "#");
        $percentageStr = str_pad($percentageStr, 5, " ");
        $percentageStr = "[" . $percentageStr . "]";

        return array($mood->getName(), $percentageStr, $percentage . "%");
    }

    public function retrieveHighestMood()
    {
        $highestPercentage = 0;
        $highestMood = null;
        foreach ($this->moods as $mood) {
            if ($mood->getPercentage() > $highestPercentage) {
                $highestPercentage = $mood->getPercentage();
                $highestMood = $mood;
            }
        }
        return $highestMood;
    }
    public function retrieveMoods(){
        return $this->moods;
    }

}