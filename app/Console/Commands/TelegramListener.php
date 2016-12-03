<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Telegram\Bot\Laravel\Facades\Telegram;
use Telegram\Bot\Objects\Update;

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

        $updates = Telegram::commandsHandler(false);

        foreach ($updates as $update) {
            /** @var Update $update */
            $telegramMessage = $update->getMessage();
            $type = $telegramMessage->detectType();
            if ($type == 'text'){
                $text = $telegramMessage->getText();
                echo $text."\r\n";
                if(stripos($telegramMessage->getText(),'hello')!==false){

                    Telegram::triggerCommand('greeting',$update);
                }
                if(stripos($telegramMessage->getText(),'activity')!==false){

                    Telegram::triggerCommand('activity',$update);
                }

            }
        }



    }
}
