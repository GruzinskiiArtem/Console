<?php

namespace App\Console\Commands\Bitcoin;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use App\Bitcoin\Client\BitcoinCurrencies;

class CurrenciesCommand extends Command
{
    protected function configure() {
        $this
            ->setName('bitcoin:currencies')
            ->addOption('sort', 's', InputOption::VALUE_REQUIRED, 'Sorting','asc')
            ->setDescription('Currency conversion')
            ->setHelp('help')
        ;
    }

    protected function interact(InputInterface $input, OutputInterface $output) {

        try {
            if (($input->getOption('sort') != "asc") && ($input->getOption('sort') != "desc")) {
                throw new \Exception('You entered an invalid option value');
            }
        }

        catch (\Exception $error) {
            $output->write($error->getMessage());
            exit();
        }
    }

    protected function execute(InputInterface $input, OutputInterface $output)  {
        $info = new BitcoinCurrencies();
        $currencies = $info->getCurrencies($input->getOption('sort'));
        foreach ($currencies as $key=>$currencyName) {
            $output->writeln($currencyName);
        }
    }
}