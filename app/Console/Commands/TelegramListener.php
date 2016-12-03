<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramListener extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'telegram:getupdates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //

        //
        $update = Telegram::commandsHandler(false);

        /*
        $offset = 0;
        $offsetArray = ['offset' => $offset];
        $update = Telegram::getUpdates($offsetArray);
        //var_dump($update);
        */


    }
}
