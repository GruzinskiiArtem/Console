<?php

namespace App\Console\Commands\Bitcoin;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\Bitcoin\Client\BitcoinConvert;
use App\Bitcoin\Client\BitcoinCurrencies;


class ConvertCommand extends Command
{
    protected function configure() {
        $this
            ->setName('bitcoin:convert')
            ->addArgument('amount', InputArgument::REQUIRED, 'Enter amount')
            ->addArgument('currency', InputArgument::REQUIRED, 'Enter currency')
            ->setDescription('Receive all available currencies')
            ->setHelp('Accepts 2 required parameters: [amount : int/float], [currency : string]')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $conversion = new BitcoinConvert(strtoupper($input->getArgument('currency')), $input->getArgument('amount'));
        $convertedCurrency = $conversion->getConversion();
        $output->write('Amount: '.$convertedCurrency.' Bit');
    }

    protected function interact(InputInterface $input, OutputInterface $output) {

        try {
            $info = new BitcoinCurrencies();
            $currencies = $info->getCurrencies('asc');
            if (!in_array(strtoupper($input->getArgument('currency')), $currencies)) {
                throw new \Exception('The selected currency is not listed!');
            } elseif (!is_numeric($input->getArgument('amount'))) {
                throw new \Exception('Amount entered incorrectly!');
            }
        }

        catch (\Exception $error) {
            echo $error->getMessage();
            exit();
        }

    }

}