<?php

namespace App\Consol\Bitcoin;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ConvertCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('bitcoin:conver')
            ->setDescription('List')
            ->setHelp('Help')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        echo "hello";
    }
}