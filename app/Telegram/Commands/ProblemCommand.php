<?php

namespace App\Telegram\Commands;

use App\BusinessLogic\UserProcessor;
use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;

class ProblemCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = "problem";

    /**
     * @var string Command Description
     */
    protected $description = "Problem";

    /**
     * @inheritdoc
     */
    public function handle($arguments)
    {

        var_dump($arguments);
        $this->replyWithMessage(['text' => "Whats the matter? How can i help you?", 'parse_mode' => 'html']);



    }
}