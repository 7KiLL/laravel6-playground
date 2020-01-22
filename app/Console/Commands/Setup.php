<?php

namespace App\Console\Commands;

use App\Models\Article;
use App\Models\User;
use Illuminate\Console\Command;

class Setup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Runs the application';

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
        $this->call('migrate');
        $this->call('passport:install');
        factory(User::class, 5)->create()->each(function (User $user) {
           $user->articles()->saveMany(factory(Article::class, 2)->make());
        });
        $this->info('Now you can try to use my pet project');
        $this->call('route:list');

        $user = User::first();
        $this->info("Here is user credentials, you can try to login via `/v1/auth/login` endpoint:");
        $this->table(['Email', 'Password'], [[$user->email, 'password']]);


    }
}
