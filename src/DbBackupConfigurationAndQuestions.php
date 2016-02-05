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

    protected function askQuestions(InputInterface $input, OutputInterface $output, array $databases, array $filesystems) {
        $database = $this->choiceQuestion($input, $output, 'Which database do you want to dump?', $databases['connections'], $databases['default']);
        $this->lineBreak($output);

        $provider = $this->choiceQuestion($input, $output, 'On which storage provider do you want to store this dump?', $filesystems['providers'], $filesystems['default']);
        $this->lineBreak($output);

        $output->writeln("<question>And what path?</question>");
        $remoteFilePath = $this->askInput($input, $output);
        $this->lineBreak($output);

        $compress = $this->confirmation($input, $output, 'Do you want to compress this dump?', false);

        return compact('database', 'provider', 'remoteFilePath', 'compress');
    }
}