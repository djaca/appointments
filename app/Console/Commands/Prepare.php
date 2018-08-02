<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Prepare extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'prepare:files';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add .env, generate key, add ide_helper files.';

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
        copy(base_path('.env.example'), base_path('.env'));

        $this->call('key:generate');

        $this->generateIdeHelper();
    }

    protected function generateIdeHelper()
    {
        shell_exec('php artisan clear-compiled');
        shell_exec('php artisan ide-helper:generate');
        shell_exec('php artisan ide-helper:meta');
    }
}
