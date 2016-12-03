<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Helper\Table;

class TestChat extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'amour:testchat';

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


        $table = new Table($this->output);
        $table
            ->setHeaders(array('Emotion', '', ''))
            ->setRows(array(
                $this->createEmotion('Anger'),
                $this->createEmotion('Disgust'),
                $this->createEmotion('Fear'),
                $this->createEmotion('Joy'),
                $this->createEmotion('Sadness'),
            ));


        $table->render();
    }

    public function createEmotion($string)
    {
        $percentage = rand(0, 100);
        $percentageTen = round($percentage / 10, 0);

        $percentageStr = str_pad("",$percentageTen,"#");
        $percentageStr = str_pad($percentageStr,10," ");
        $percentageStr = "[".$percentageStr."]";

        return array($string, $percentageStr, $percentage."%");
    }
}
