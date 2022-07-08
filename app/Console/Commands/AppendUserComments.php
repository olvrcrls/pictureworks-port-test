<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Repositories\UserRepository;
use Exception;

class AppendUserComments extends Command
{
    /**
     * User variable
     */
    protected $user;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:comments {user_id} {comments}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command for updating comments of the provided user id and the new comment to append.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(UserRepository $user)
    {
        parent::__construct();
        $this->user = $user;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $user_id = $this->argument('user_id');
        $comments = $this->argument('comments');
        $password = env('PASSWORD');
        $data = compact('user_id', 'comments', 'password');
        try {
            $this->user->create_or_update($data, $user_id);
            $this->info("Successfully appended comment: '{$comments}' to User ID {$user_id}");
        } catch (Exception $e) {
            $this->error("Failed to append comment to User ID {$user_id}. {$e->getMessage()}");
        }
    }
}
