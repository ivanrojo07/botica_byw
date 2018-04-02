<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class LogDemo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'log:demo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Agrega una linea al archivo log.';

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
     *0
     * @return mixed
     */
    public function handle()
    {
        //
        \Log::info('Estoy aqui a las '.\Carbon\Carbon::now());


    }
}
