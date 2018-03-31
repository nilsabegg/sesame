<?php

namespace Sesame;

use Sesame\Crawler\ArticleCrawler;
use Sesame\Model\Article;

/**
 * Class Sesame
 *
 *
 *
 * @package Sesame
 */
class Sesame
{

    /**
     * Sesame constructor
     */
    public function __construct()
    {
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
        $crawler = new ArticleCrawler();

        return $crawler->crawlArticle($responseBody, $crawlVariations);
    }
}
