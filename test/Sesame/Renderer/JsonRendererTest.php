<?php

namespace Sesame\Test\Renderer;

use Defuse\Crypto\Crypto;
use Defuse\Crypto\Key;
use Sesame\Model\Article;
use Sesame\Renderer\JsonRenderer;
use Sesame\Sesame;
use Sesame\Test\BaseTest;

/**
 * Class SesameTest
 *
 *
 * @package Sesame\Test
 */
class JsonRendererTest extends BaseTest
{

    /**
     * testCrawlArticle
     */
    public function testCrawlArticleWithoutVariations()
    {
        $renderer = new JsonRenderer();
        $article = new Article();

        $this->assertEquals('tbd', $renderer->renderArticle($article));
    }
}
