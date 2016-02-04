<?php namespace BackupManager\Laravel;

use Symfony\Component\Console\Command\Command as ConsoleCommand;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;

abstract class Command extends ConsoleCommand {

    protected function choiceQuestion($text, array $choices, InputInterface $input, OutputInterface $output) {
        /** @var QuestionHelper $helper */
        $helper = $this->getHelper('question');
        $question = new ChoiceQuestion("<question>{$text}</question>", $choices);
        $question->setAutocompleterValues(array_values($choices));
        return $helper->ask($input, $output, $question);
    }
}