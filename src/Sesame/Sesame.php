<?php

namespace Sesame;

use Sesame\Crawler\ArticleCrawler;
use Sesame\Model\Article;
use Sesame\Renderer\JsonRenderer;
use Sesame\Renderer\XmlRenderer;

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

    /**
     * renderArticle
     *
     * @param Article $article
     * @param string $format
     * @return string
     */
    public function renderArticle(Article $article, string $format = 'json'): string
    {
        if ($format == 'json') {
            $renderer = new JsonRenderer();
        } elseif ($format == 'xml') {
            $renderer = new XmlRenderer();
        } else {
            throw new \InvalidArgumentException();
        }

        return $renderer->renderArticle($article);
    }
}
