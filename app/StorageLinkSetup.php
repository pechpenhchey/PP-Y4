<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class StorageLinkSetup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'storage:setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automate the storage link setup process.';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->info('Running storage:link command...');
        $this->call('storage:link');
        $this->info('storage:link completed!');
    }
}
