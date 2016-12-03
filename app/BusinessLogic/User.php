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
        $moods [] = new Mood("Anger", '0',"It seems like your partner is not that happy, to be exactly he/she is angry or bitchy.");
        $moods [] = new Mood("Disgust", '192',"Maybe your partner needs some personal time.");
        $moods [] = new Mood("Fear", '155',"Your partner feels fear and doubt. Support your sweetheart! ");
        $moods [] = new Mood("Joy", '64',"Perfect! You can do something really special: Your partner is joyful and cheery!");
        $moods [] = new Mood("Sadness", '24',"You have to cheer your partner up because he/she is feeling sad and dismal. ");

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