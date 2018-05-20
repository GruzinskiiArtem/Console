<?php

namespace App\Console\Commands\Bitcoin;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Helper\Table;
use App\Bitcoin\Client\BitcoinInfo;

class InfoCommand extends Command
{
    protected function configure() {
        $this
            ->setName('bitcoin:info')
            ->setDescription('Displays the current course')
            ->setHelp('help')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $bitcoinInfo = new BitcoinInfo();
        $table = new Table($output);
        $rows = $bitcoinInfo->getBitcoinInfo();
        $table->setHeaders(array('Currency', '15m', 'Last', 'Buy', 'Sell'));
        $table->setRows($rows);
        $table->render();
    }
}