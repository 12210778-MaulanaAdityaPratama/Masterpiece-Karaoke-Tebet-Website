<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class BackupDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'backup database ke folder database/backups';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $filename = 'backup-' . now()->format('Y-m-d_H-i-s') . '.sql';
        $path     = database_path('backups/' . $filename);

        if (!is_dir(database_path('backups'))) {
            mkdir(database_path('backups'), 0755, true);
        }

        $host     = config('database.connections.mysql.host');
        $port     = config('database.connections.mysql.port');
        $database = config('database.connections.mysql.database');
        $username = config('database.connections.mysql.username');
        $password = config('database.connections.mysql.password');

        $command = "mysqldump --host={$host} --port={$port} "
                 . "--user={$username} --password={$password} "
                 . "{$database} > {$path}";

        exec($command, $output, $result);

        if ($result === 0) {
            $this->info("✅ Backup berhasil: database/backups/{$filename}");
        } else {
            $this->error("❌ Backup gagal.");
        }
    }
}