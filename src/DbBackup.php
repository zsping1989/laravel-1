<?php namespace BackupManager\Laravel;

use Illuminate\Console\Command;

class DbBackup extends Command {

    use CommandHelpers, DbBackupConfigurationAndQuestions;

    public function handle() {
        dd($this->askQuestions($this->input, $this->output));
    }
}