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

        // extract ammount of total orders
        $ordersHtml = $articleCrawler->filter('#j-order-num');
        $ordersString = $ordersHtml->text();
        $ordersStringParts = explode(' ', $ordersString);
        $article->setOrders($ordersStringParts[0]);

        return $article;
    }
}
