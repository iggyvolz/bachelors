<?php

namespace iggyvolz\Bachelors\CLI;

use iggyvolz\Bachelors\Renderer\Renderer;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Logger\ConsoleLogger;
use Symfony\Component\Console\Output\OutputInterface;

class StartCommand extends Command
{
    protected static $defaultName = "start";
    protected function configure()
    {
        $this->addArgument("file", InputArgument::REQUIRED);
        $this->addArgument("output", InputArgument::REQUIRED);
        $this->addOption("filter", "f", InputOption::VALUE_OPTIONAL, "Filter to one class");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $file = $input->getArgument("file");
        $outputDir = $input->getArgument("output");
        if(!file_exists($file)) {
            $output->writeln("File does not exist!");
            return Command::FAILURE;
        }
        if(!is_dir($outputDir)) {
            $output->writeln("Output directory does not exist!");
            return Command::FAILURE;
        }
        $dom = new \DOMDocument();
        $dom->load($file);
        $filter = $input->getOption("filter");
        if(!is_null($filter)) $filter = explode(",", $filter);
        $renderer = new Renderer($dom, new ConsoleLogger($output), $filter);
        $renderer->process($outputDir);
        return Command::SUCCESS;
    }
}