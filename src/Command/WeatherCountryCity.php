<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use App\Service\WeatherUtil;

#[AsCommand(
    name: 'weather:country-city'
)]
class WeatherCountryCityCommand extends Command
{
    private WeatherUtil $weatherUtil;

    public function __construct(WeatherUtil $weatherUtil, string $name = null)
    {
        $this->weatherUtil = $weatherUtil;
        parent::__construct($name);
    }

    protected function configure(): void
    {
        $this->addArgument('cityName', InputArgument::REQUIRED, 'City Name');
        $this->addArgument('countryCode', InputArgument::REQUIRED, 'Country Code');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $city = $input->getArgument('cityName');
        $country = $input->getArgument('countryCode');

        $result = $this->weatherUtil->getWeatherForCountryAndCity($country, $city);
        $output->writeln(json_encode($result, JSON_PRETTY_PRINT));

        return Command::SUCCESS;
    }
}
