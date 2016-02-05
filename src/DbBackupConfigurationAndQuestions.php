<?php namespace BackupManager\Laravel;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

trait DbBackupConfigurationAndQuestions {

    protected function configure() {
        $this
            ->setName('db:backup')
            ->setDescription('Create database dump and save it on a service')
            ->addOption('yell', null, InputOption::VALUE_NONE, 'If set, the task will yell in uppercase letters');
    }

    protected function askQuestions(InputInterface $input, OutputInterface $output) {
        $database = $this->choiceQuestion('Which database do you want to dump?', ['master' => 'Master (MySQL)'], $input, $output);
        $this->lineBreak($output);

        $provider = $this->choiceQuestion('On which storage provider do you want to store this dump?', ['backups' => 'Backups (AWS S3)'], $input, $output);
        $this->lineBreak($output);

        $output->writeln("<question>And what path?</question>");
        $remoteFilePath = $this->askInput($input, $output);
        $this->lineBreak($output);

        $compress = $this->confirmation('Do you want to compress this dump?', false, $input, $output);

        return compact('database', 'provider', 'remoteFilePath', 'compress');
    }
}