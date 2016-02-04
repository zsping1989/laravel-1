<?php namespace BackupManager\Laravel;

use Illuminate\Support\ServiceProvider;

class LaravelServiceProvider extends ServiceProvider {

    /**
     * Register the service provider.
     * @return void
     */
    public function register() {
        $this->commands([
            DbBackup::class
        ]);
    }
}