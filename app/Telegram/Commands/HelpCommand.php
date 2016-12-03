<?php

namespace App\Telegram\Commands;

use App\BusinessLogic\UserProcessor;
use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;

class HelpCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = "getorders";

    /**
     * @var string Command Description
     */
    protected $description = "Help yourself";

    /**
     * @inheritdoc
     */
    public function handle($arguments)
    {

        $moodGenerator = new UserProcessor();
        $user = $moodGenerator->getUser('');

        $text = $user->createMoodTable();
        $text = '<pre>' . $text . '</pre>';
        $this->replyWithMessage(['text' => $text, 'parse_mode' => 'html']);
        $colorValue = $user->retrieveHighestMood()->getColorValue();
        echo $colorValue."\r\n";
        file_get_contents(sprintf("http://192.168.168.24/mood?color=%s", $colorValue));


    }
}