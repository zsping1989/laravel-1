<?php namespace BackupManager\Laravel;

use Illuminate\Console\Command;

class DbBackup extends Command {

    use CommandHelpers, DbBackupConfigurationAndQuestions;

    public function handle() {
        $databases = $this->structureDatabases($this->laravel->make('config')->get('database'));
        $filesystems = $this->structureFilesystems($this->laravel->make('config')->get('filesystems'));
        $answers = $this->askQuestions($this->input, $this->output, $databases, $filesystems);
        dd($answers);
    }

    private function structureDatabases($config) {
        $connections = [];
        foreach ($config['connections'] as $key => $connection) {
            $driver = $connection['driver'] == 'mysql' ? 'MySQL' : 'PostgreSQL';
            $connections[$key] = "({$driver})";
        }
        return [
            'default' => $config['default'],
            'connections' => $connections
        ];
    }

    private function structureFilesystems($config) {
        $providers = [];
        foreach ($config['disks'] as $key => $provider) {
            $driver = ucfirst($provider['driver']);
            $providers[$key] = "({$driver})";
        }
        return [
            'default' => $config['default'],
            'providers' => $providers
        ];
    }
}