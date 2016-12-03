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

    /**
     * @inheritdoc
     */
    public function handle($arguments)
    {

        $moodGenerator = new UserProcessor();
        $user = $moodGenerator->getUser('');

        $this->replyWithMessage(['text' => "Ok checking the mood..."]);

        $colorValue = $user->retrieveHighestMood()->getColorValue();
        $url = sprintf("http://192.168.168.24/mood?color=%s", $colorValue);
        $request = \Requests::get($url);
        sleep(5);


        $this->replyWithMessage(['text' => $user->retrieveHighestMood()->getMoodText()]);


        $text = $user->createMoodTable();
        $text = '<pre>' . $text . '</pre>';
        $this->replyWithMessage(['text' => $text, 'parse_mode' => 'html']);

        $url = sprintf("http://localhost:8080/test?mood=%s", strtolower($user->retrieveHighestMood()->getName()));


        $request = \Requests::get($url);



    }
}