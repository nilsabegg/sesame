<?php
namespace Sesame\Command;

use GuzzleHttp\Client;
use Sesame\Sesame;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class CrawlArticleCommand
 * @package Sesame\Command
 */
class CrawlArticleCommand extends Command
{

    /**
     * @var Sesame
     */
    protected $sesame;

    /**
     * CrawlArticleCommand constructor
     *
     * @param null|string $name
     */
    public function __construct(?string $name = null)
    {
        parent::__construct($name);
    }

    /**
     * setSesame
     * The setter for the dependency injection of the Sesame class.
     * @param Sesame $sesame
     */
    public function setSesame(Sesame $sesame)
    {
        $this->sesame = $sesame;
    }

    /**
     * configure
     */
    protected function configure()
    {
        $this
            ->setName('crawl:article')
            ->setDescription('Crawls an article.')
            ->setHelp('This command allows you to crawl an article on article on aliexpress.com and grab its data.')
            ->addArgument(
                'articleUrl',
                InputArgument::REQUIRED,
                'The URL of the article, which copied from your browser.'
            )
            ->addOption(
                'crawlVariations',
                'cv',
                InputOption::VALUE_REQUIRED,
                'With this option you can control if Sesame will crawl the variations for the article too. Syntax "-cv0" to ignore variations or "--crawlVariations=1" to include them.',
                1
            );
    }

    /**
     * execute
     * The actual business logic of the command.
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // get command line input
        $articleUrl = $input->getArgument('articleUrl');
        $crawlVariations = $input->getOption('crawlVariations');

        // convert to boolean
        if ($crawlVariations === 1) {
            $crawlVariations = true;
        } elseif ($crawlVariations === 0) {
            $crawlVariations = false;
        }

        // get article page
        $client = new Client();
        $response = $client->request('GET', $articleUrl);
        $responseBody = $response->getBody();

        // get article data
        $article = $this->sesame->crawlArticle((string) $responseBody, $crawlVariations);
        $article->setUrl($articleUrl);

        print_r($article);
    }
}
