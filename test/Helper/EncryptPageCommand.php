<?php
namespace Sesame\Test\Helper;

use Defuse\Crypto\Crypto;
use Defuse\Crypto\Exception\BadFormatException;
use Defuse\Crypto\Exception\EnvironmentIsBrokenException;
use Defuse\Crypto\Key;
use GuzzleHttp\Client;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class EncryptPageCommand
 * @package Sesame\Test\Helper
 */
class EncryptPageCommand extends Command
{

    /**
     * configure
     */
    protected function configure()
    {
        $this
            ->setName('encrypt:page')
            ->setDescription('Encrypts and saves an page for unit tests.')
            ->setHelp('This command allows you to encrypt an page on aliexpress.com and save it to the project for testing purpose.')
            ->addArgument(
                'pageUrl',
                InputArgument::REQUIRED,
                'The URL of the page, which copied from your browser.'
            )
            ->addArgument(
                'absoluteFilePath',
                InputArgument::REQUIRED,
                'The absolute path of the file, which is saved with the encrypted content of the page.'
            );
    }

    /**
     * execute
     * The actual business logic of the command.
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     * @throws \Defuse\Crypto\Exception\EnvironmentIsBrokenException
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $pageUrl = $input->getArgument('pageUrl');
        $filePath = $input->getArgument('absoluteFilePath');

        $client = new Client();

        $response = $client->request('GET', $pageUrl);
        $responseBody = $response->getBody();

        try {
            $keyAscii = file_get_contents('/Users/nils/Sites/sesame/test/resources/key.file');
            $key = Key::loadFromAsciiSafeString($keyAscii);
        } catch (BadFormatException $e) {
            $output->writeln($e->getMessage());

            return 1;
        }
        $encryptedContent = Crypto::encrypt($responseBody, $key);

        file_put_contents($filePath, $encryptedContent);

        return 0;
    }
}
