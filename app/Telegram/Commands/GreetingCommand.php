<?php

namespace App\Telegram\Commands;

use App\BusinessLogic\UserProcessor;
use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;

class GreetingCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = "greeting";

    /**
     * @var string Command Description
     */
    protected $description = "Greeting";

    /**
     * @inheritdoc
     */
    public function handle($arguments)
    {

        var_dump($arguments);
        $this->replyWithMessage(['text' => "Hello ", 'parse_mode' => 'html']);



    }
}