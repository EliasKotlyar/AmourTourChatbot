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
        echo $url."\r\n";

        $request = \Requests::get($url);
        $decodedValues = \GuzzleHttp\json_decode($request->body);

        $text = "Here are the best rated activitys for you:\r\n";
        foreach($decodedValues as $value){
            $text.= sprintf("[%s](%s)\r\n", $value->name,$value->url);
        }

        $text.= "If you need more activitys , go on our page: \r\n";


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