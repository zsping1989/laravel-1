<?php namespace BackupManager\Laravel;

use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;
use Symfony\Component\Console\Question\ConfirmationQuestion;
use Symfony\Component\Console\Question\Question;

trait CommandHelpers {

    protected function choiceQuestion($text, array $choices, InputInterface $input, OutputInterface $output) {
        /** @var QuestionHelper $helper */
        $helper = $this->getHelper('question');
        $question = new ChoiceQuestion("<question>{$text}</question>", $choices);
        return $helper->ask($input, $output, $question);
    }

    protected function askInput(InputInterface $input, OutputInterface $output) {
        /** @var QuestionHelper $helper */
        $helper = $this->getHelper('question');
        $question = new Question(" > ");
        return $helper->ask($input, $output, $question);
    }

    protected function lineBreak(OutputInterface $output) {
        $output->writeln('');
    }

    protected function confirmation($text, $default = false, InputInterface $input, OutputInterface $output) {
        /** @var QuestionHelper $helper */
        $helper = $this->getHelper('question');
        $defaultOption = $default ? '[Y/n]' : '[y/N]';
        $question = new ConfirmationQuestion("<question>{$text} {$defaultOption}</question> ", $default);
        return $helper->ask($input, $output, $question);
    }
}