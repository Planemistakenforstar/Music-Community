<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class SetUserAdmin extends Command
{
    protected $signature = 'users:set-admin {email} {status : grant or revoke}';

    protected $description = 'Grant or revoke track-review administrator access for a user';

    public function handle(): int
    {
        $status = $this->argument('status');
        if (! in_array($status, ['grant', 'revoke'], true)) {
            $this->error('Status must be either grant or revoke.');

            return self::FAILURE;
        }

        $user = User::query()->where('email', $this->argument('email'))->first();
        if ($user === null) {
            $this->error('No user exists with that email address.');

            return self::FAILURE;
        }

        $user->is_admin = $status === 'grant';
        $user->save();

        $this->info(sprintf('Administrator access %s for %s.', $status === 'grant' ? 'granted' : 'revoked', $user->email));

        return self::SUCCESS;
    }
}
