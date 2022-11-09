<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use App\Service\WeatherUtil;

#[AsCommand(
    name: 'weather:location-id'
)]

class WeatherLocationCommand extends Command
{
    private WeatherUtil $weatherUtil;

    public function __construct(WeatherUtil $weatherUtil, string $name = null)
    {
        $this->weatherUtil = $weatherUtil;
        parent::__construct($name);
    }

    protected function configure(): void
    {
        $this
            ->addArgument('locationId', InputArgument::REQUIRED, 'Location ID');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $locationId = $input->getArgument('locationId');

        $result = $this->weatherUtil->getWeatherForLocation($locationId);
        $output->writeln(json_encode($result, JSON_PRETTY_PRINT));

        return Command::SUCCESS;
    }
}
