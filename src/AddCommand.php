<?php

namespace Shuv;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;

class AddCommand extends Command {
    public function configure(){
        $this->setName('add')
             ->setDescription('Add a new task')
             ->addArgument('description', InputArgument::REQUIRED);
    }

    public function execute(InputInterface $input, OutputInterface $output){
        $description = $input->getArgument('description');
        // die(var_dump(compact($description)));
        $this->database->query(
            'insert into tasks (description) values (:description)',
            compact("description")
        );

        $output->writeln("<info>New task added</info>");

        $this->showTasks($output);
    }
}