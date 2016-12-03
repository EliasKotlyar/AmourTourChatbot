<?php

namespace App\Telegram\Commands;

use App\BusinessLogic\UserProcessor;
use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;

class PlacesCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = "places";

    /**
     * @var string Command Description
     */
    protected $description = "Places";

    /**
     * @inheritdoc
     */
    public function handle($arguments)
    {





    }
}