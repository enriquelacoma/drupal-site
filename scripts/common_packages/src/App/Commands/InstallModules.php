<?php

namespace Console\App\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use Symfony\Component\Yaml\Yaml;

/**
 * Install drupal modules and import custom configuration.
 */
class InstallModules extends Command {

  /**
   * The configuration to install drupal modules.
   * @var array
   */
  protected array $packagesConfiguration;

  /**
   * {@inheritDoc}
   */
  protected function execute(InputInterface $input, OutputInterface $output): int {
    // Get configuration.
    $this->packagesConfiguration = Yaml::parseFile($input->getArgument('config-file'));
    $this->checkRootPath();
    $this->checkDependencies();
    $this->requireModules();
    $this->addPatches();
    // Run composer.
    // Import configuration.
    return Command::SUCCESS;
  }

  /**
   * {@inheritDoc}
   */
  protected function configure(): void {
    $this->setHelp('This command allows you to create a user...');
    $this->setName('install-modules')
      ->setDescription('Install and configure drupal modules.')
      ->setHelp('This scripts uses the module.yml file to add, install and configure a set of drupal modules to your project.');
    $this->addArgument('config-file', InputArgument::REQUIRED, 'The configuration file.');
  }

  /**
   * Check if current path matches project root path.
   */
  protected function checkRootPath() {
    $process = new Process(['pwd']);
    $process->run();
    $pwd = trim($process->getOutput());
    if ($this->packagesConfiguration['project']['root_path'] !== $pwd) {
      $msg = sprintf("The path of the running %s script doesn't match the project root_path %s.", $this->packagesConfiguration['project']['root_path'], $pwd);
      throw new \LogicException($msg);
    }
  }

  /**
   * Check necessary tools are installed.
   */
  protected function checkDependencies() {
    foreach ($this->packagesConfiguration['project']['dependencies']['tools'] as $tool) {
      $process = new Process([$tool]);
      $process->run();
      if (!$process->isSuccessful()) {
        throw new ProcessFailedException($process);
      }
    }
  }

  /**
   * Use composer to require modules in the project.
   */
  protected function requireModules() {
    foreach ($this->packagesConfiguration['packages'] as $packages => $packageConfiguration) {
      $composerCommand = [
        'composer',
        'require',
        $packageConfiguration['composer_package'] . ":" . $packageConfiguration['version'],
        '-W',
      ];
      $process = new Process($composerCommand);
      $process->run(function ($type, $buffer): void {
        echo $buffer;
      });
      if (!$process->isSuccessful()) {
        throw new ProcessFailedException($process);
      }
    }

  }

  /**
   * Add patches to composer.json.
   */
  protected function addPatches() {

  }

  /**
   * Install composer packages.
   */
  protected function importModulesConfig() {

  }

}
