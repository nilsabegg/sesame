<?php
namespace Sesame;

use Sesame\Crawler\ArticleCrawler;

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

    public function crawlArticle()
    {
        $crawler = new ArticleCrawler();

        return true;
    }
}