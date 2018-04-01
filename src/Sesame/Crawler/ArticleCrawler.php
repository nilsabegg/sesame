<?php

namespace Sesame\Crawler;

use Sesame\Model\Article;
use \Symfony\Component\DomCrawler\Crawler as DomCrawler;

/**
 * Class ArticleCrawler
 *
 * @package Sesame\Crawler
 */
class ArticleCrawler extends Crawler
{

    /**
     * ArticleCrawler constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * crawlArticle
     *
     * @param string $responseBody
     * @param bool $crawlVariations
     * @return Article
     */
    public function crawlArticle(string $responseBody, bool $crawlVariations): Article
    {
        $articleCrawler = new DomCrawler($responseBody);
        $article = new Article();

        // extract name of the article
        $nameHtml = $articleCrawler->filter('h1.product-name');
        $article->setName($nameHtml->text());

        // extract ammount of total orders
        $article->setOrders($this->extractOrders($articleCrawler));

        // extract amount of articles in stock
        $article->setStock($this->extractStock($articleCrawler));

        return $article;
    }

    /**
     * @param DomCrawler $articleCrawler
     * @return int
     */
    protected function extractOrders(DomCrawler $articleCrawler): int
    {
        $ordersHtml = $articleCrawler->filter('#j-order-num');
        $ordersString = $ordersHtml->text();
        $ordersStringParts = explode(' ', $ordersString);

        return (int) $ordersStringParts[0];
    }

    /**
     * @param DomCrawler $articleCrawler
     * @return int
     */
    protected function extractStock(DomCrawler $articleCrawler): int
    {
        $stockAmountHtml = $articleCrawler->filter('#j-sell-stock-num');
        $stockAmountString = $stockAmountHtml->text();
        $stockAmountStringParts = explode(' ', $stockAmountString);

        return (int) $stockAmountStringParts[0];
    }
}
