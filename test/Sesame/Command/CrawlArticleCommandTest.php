<?php

namespace Sesame\Test\Command;

use Sesame\Sesame;
use Sesame\Command\CrawlArticleCommand;
use Sesame\Test\BaseTest;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

/**
 * Class SesameTest
 *
 *
 * @package Sesame\Test
 */
class CrawlArticleCommandTest extends BaseTest
{

    /**
     * @throws \Exception
     */
    public function testCommandCurlError()
    {
        $application = new Application();

        $sesame = new Sesame();
        $crawlArticleCommand = new CrawlArticleCommand();
        $crawlArticleCommand->setSesame($sesame);
        $application->add($crawlArticleCommand);
        $command = $application->find('crawl:article');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array(
            'command'  => $command->getName(),
            'articleUrl' => 'notworking.xml',
        ));

        $output = $commandTester->getDisplay();
        $this->assertContains('cURL error 6:', substr($output, 0, 13));
    }
}