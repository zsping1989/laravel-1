<?php namespace BackupManager\Laravel;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class DbBackup extends Command {

    protected $database;

    protected function configure() {
        $this
            ->setName('db:backup')
            ->setDescription('Create database dump and save it on a service')
            ->addOption('yell', null, InputOption::VALUE_NONE, 'If set, the task will yell in uppercase letters');
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $database = $this->choiceQuestion('Which database do you want to dump?', ['master' => 'Master (MySQL)'], $input, $output);
        $output->writeln($database);
    }
}