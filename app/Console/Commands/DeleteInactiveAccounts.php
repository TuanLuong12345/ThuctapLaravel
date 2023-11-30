<?php

namespace App\Console\Commands;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Log;

class DeleteInactiveAccounts extends Command
{
    use SoftDeletes;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-inactive-users';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::where('created_at', '<=', Carbon::now()->subDays(90))
            ->whereDoesntHave('news')
            ->where('created_at', '<=', Carbon::now()->subDays(90))
            ->get();

        foreach ($users as $user) {
            // Kiểm tra xem người dùng có vai trò admin không
            if ($user->role !== 'admin') {
                // Soft delete user account or perform any other necessary actions
                Log::info('Deleting user: ' . $user->id . ' - ' . $user->name);
                $user->delete();
            }
        }

        $this->info('Inactive user accounts deleted successfully.');
    }
}
