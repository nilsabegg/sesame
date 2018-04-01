<?php

namespace Sesame\Test;

use Defuse\Crypto\Crypto;
use Defuse\Crypto\Exception\BadFormatException;
use Defuse\Crypto\Exception\EnvironmentIsBrokenException;
use Defuse\Crypto\Exception\WrongKeyOrModifiedCiphertextException;
use Defuse\Crypto\Key;
use PHPUnit\Framework\TestCase;
use Sesame\Model\Article;
use Sesame\Sesame;

/**
 * Class SesameTest
 *
 *
 * @package Sesame\Test
 */
class SesameTest extends TestCase
{

    /**
     * testCrawlArticle
     */
    public function testCrawlArticleWithoutVariations()
    {

        $sesame = new Sesame();
        $article = new Article();
        $url = 'https://www.aliexpress.com/item/Men-Jeans-Business-Casual-Slim-Fit-Skinny-Jeans-Stretch-Denim-Pencils-Pants-Tapered-Trousers-Classic-Cowboys/32794848062.html';
        $article->setUrl($url);
        $article->setOrders(1510);
        $article->setStock(0);
        $article->setName('KSTUN Men Jeans Business Casual Thin Summer Straight Slim Fit Blue Jeans Stretch Denim Pants Trousers Classic Cowboys Young Man');

        $encryptedPage = file_get_contents(__DIR__ . '/../resources/pages/32784848062.page');
        $keyAscii = file_get_contents(__DIR__ . '/../resources/key.file');

        $key = Key::loadFromAsciiSafeString($keyAscii);
        $decryptedPage = Crypto::decrypt($encryptedPage, $key);
        $crawledArticle = $sesame->crawlArticle($decryptedPage, false);
        $crawledArticle->setUrl($url);
        $this->assertEquals($article->getOrders(), $crawledArticle->getOrders());
        $this->assertEquals($article->getUrl(), $crawledArticle->getUrl());
        $this->assertEquals($article->getName(), $crawledArticle->getName());
        $this->assertEquals($article->getStock(), $crawledArticle->getStock());
    }
}
