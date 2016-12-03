<?php

namespace App\Telegram\Commands;

use App\BusinessLogic\UserProcessor;
use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;

class ActivityCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = "activity";

    /**
     * @var string Command Description
     */
    protected $description = "Get Activity";
    protected $user;

    /**
     * @inheritdoc
     */
    public function handle($arguments)
    {
        $moodGenerator = new UserProcessor();
        $this->user = $moodGenerator->getUser('');

        $this->checkMood();
        $this->getPlaces();





    }
    public function getPlaces(){
        $user = $this->user;
        $moodName = strtolower($user->retrieveHighestMood()->getName());
        echo $moodName."\r\n";
        $url = sprintf("http://localhost:8080/test?mood=%s", $moodName);


        $request = \Requests::get($url);
        $decodedValues = \GuzzleHttp\json_decode($request->body);

        $text = "";
        foreach($decodedValues as $value){
            $text.= sprintf("[%s](%s)\r\n", $value->name,$value->url);
        }



        $this->replyWithMessage(['text' => $text, 'parse_mode' => 'markdown']);
    }
    public function checkMood(){

        $user = $this->user;

        $this->replyWithMessage(['text' => "Ok checking the mood..."]);

        $colorValue = $user->retrieveHighestMood()->getColorValue();
        $url = sprintf("http://192.168.168.24/mood?color=%s", $colorValue);
        $request = \Requests::get($url);
        sleep(5);


        $this->replyWithMessage(['text' => $user->retrieveHighestMood()->getMoodText()]);


        $text = $user->createMoodTable();
        $text = '<pre>' . $text . '</pre>';
        $this->replyWithMessage(['text' => $text, 'parse_mode' => 'html']);


    }
}