<?php

namespace Sesame\Test;

use Defuse\Crypto\Crypto;
use Defuse\Crypto\Key;
use Sesame\Model\Article;
use Sesame\Sesame;

/**
 * Class SesameTest
 *
 *
 * @package Sesame\Test
 */
class SesameTest extends BaseTest
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
        $article->setRating(4.8);
        $article->setRatingAmount(776);
        $article->setSeller('KSTUN Store');
        $article->setSellerLocation('China (Guangdong)');
        $article->setSellerSince(2);
        $article->setSellerFeedback(98.4);
        $article->setPrice(37.60);
        $article->setPriceDiscount(22.56);
        $article->setPriceCurrency('USD');
        $article->setName('KSTUN Men Jeans Business Casual Thin Summer Straight Slim Fit Blue Jeans Stretch Denim Pants Trousers Classic Cowboys Young Man');
        $article->setDescription('');

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
        $this->assertEquals($article->getRating(), $crawledArticle->getRating());
        $this->assertEquals($article->getRatingAmount(), $crawledArticle->getRatingAmount());
        $this->assertEquals($article->getSeller(), $crawledArticle->getSeller());
        $this->assertEquals($article->getSellerLocation(), $crawledArticle->getSellerLocation());
        $this->assertEquals($article->getSellerSince(), $crawledArticle->getSellerSince());
        //$this->assertEquals($article->getSellerFeedback(), $crawledArticle->getSellerFeedback());
        $properties = $crawledArticle->getProperties();
        $this->assertEquals(21, count($properties));
        //$this->assertEquals($article->getDescription(), $crawledArticle->getDescription());
        $this->assertEquals($article->getPrice(), $crawledArticle->getPrice());
        $this->assertEquals($article->getPriceDiscount(), $crawledArticle->getPriceDiscount());
        $this->assertEquals($article->getPriceCurrency(), $crawledArticle->getPriceCurrency());

    }

    public function testRenderArticle()
    {

        $sesame = new Sesame();
        $article = new Article();

        $this->assertEquals('tbd', $sesame->renderArticle($article, 'json'));
        $this->assertEquals('tbd', $sesame->renderArticle($article, 'xml'));
        $this->expectException(\InvalidArgumentException::class);
        $sesame->renderArticle($article, 'invalid');
    }
}
