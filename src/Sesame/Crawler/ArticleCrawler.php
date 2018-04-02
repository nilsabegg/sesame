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

        // extract rating information
        $article->setRating($this->extractRating($articleCrawler));
        $article->setRatingAmount($this->extractRatingAmount($articleCrawler));

        // extract seller information
        $article->setSeller($this->extractSeller($articleCrawler));
        $article->setSellerLocation($this->extractSellerLocation($articleCrawler));
        $article->setSellerSince($this->extractSellerSince($articleCrawler));
        //$article->setSellerFeedback($this->extractSellerFeedback($articleCrawler));

        // extract product properties
        $article->setProperties($this->extractProperties($articleCrawler));

        // extract description
        $article->setDescription($this->extractDescription($articleCrawler));

        // extract price information
        $article->setPrice($this->extractPrice($articleCrawler));
        $article->setPriceDiscount($this->extractPriceDiscount($articleCrawler));
        $article->setPriceCurrency($this->extractPriceCurrency($articleCrawler));

        return $article;
    }

    /**
     * @param DomCrawler $articleCrawler
     * @return string
     */
    protected function extractDescription(DomCrawler $articleCrawler): string
    {
        $descriptionHtml = $articleCrawler->filter('#j-product-description');
        $descriptionString = $descriptionHtml->text();

        return $descriptionString;
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
     * @return float
     */
    protected function extractPrice(DomCrawler $articleCrawler): float
    {
        $priceHtml = $articleCrawler->filter('#j-sku-price');
        $priceString = $priceHtml->text();

        return (float) $priceString;
    }

    /**
     * @param DomCrawler $articleCrawler
     * @return string
     */
    protected function extractPriceCurrency(DomCrawler $articleCrawler): string
    {
        $priceCurrencyHtml = $articleCrawler->filter('.p-price-content .p-symbol');
        $priceCurrencyString = $priceCurrencyHtml->attr('content');

        return $priceCurrencyString;
    }

    /**
     * @param DomCrawler $articleCrawler
     * @return float
     */
    protected function extractPriceDiscount(DomCrawler $articleCrawler): float
    {
        $priceDiscountHtml = $articleCrawler->filter('#j-sku-discount-price');
        $priceDiscountString = $priceDiscountHtml->text();

        return (float) $priceDiscountString;
    }

    /**
     * @param DomCrawler $articleCrawler
     * @return array
     */
    protected function extractProperties(DomCrawler $articleCrawler): array
    {
        $properties = array();
        $propertyElements = $articleCrawler->filter('.product-property-list .property-item');
        foreach ($propertyElements as $propertyElement) {
            $propertyCrawler = new DomCrawler($propertyElement);
            $propertyTitle = substr($propertyCrawler->filter('.propery-title')->text(), 0, -1);
            $propertyValue = $propertyCrawler->filter('.propery-des')->text();
            if (array_key_exists($propertyTitle, $properties)) {
                $properties[$propertyTitle] .= '-' . $propertyValue;
            } else {
                $properties[$propertyTitle] = $propertyValue;
            }
        }

        return $properties;
    }

    /**
     * @param DomCrawler $articleCrawler
     * @return float
     */
    protected function extractRating(DomCrawler $articleCrawler): float
    {
        $ratingHtml = $articleCrawler->filter('#j-customer-reviews-trigger .percent-num');
        $ratingString = $ratingHtml->text();
        $ratingStringParts = explode(' ', $ratingString);

        return (float) $ratingStringParts[0];
    }

    /**
     * @param DomCrawler $articleCrawler
     * @return int
     */
    protected function extractRatingAmount(DomCrawler $articleCrawler): int
    {
        $ratingAmountHtml = $articleCrawler->filter('#j-customer-reviews-trigger .rantings-num');
        $ratingAmountString = $ratingAmountHtml->text();
        $ratingAmountStringParts = explode(' ', $ratingAmountString);

        return (int) str_replace('(', '', $ratingAmountStringParts[0]);
    }

    /**
     * @param DomCrawler $articleCrawler
     * @return string
     */
    protected function extractSeller(DomCrawler $articleCrawler): string
    {
        $sellerHtml = $articleCrawler->filter('#j-store-info-wrap .store-lnk');
        $sellerString = $sellerHtml->text();

        return $sellerString;
    }

    /**
     * @param DomCrawler $articleCrawler
     * @return float
     */
    protected function extractSellerFeedback(DomCrawler $articleCrawler): float
    {
        $sellerFeedbackHtml = $articleCrawler->filter('.seller-score-feedback span a');
        $sellerFeedbackString = str_replace('%', '', $sellerFeedbackHtml->text());

        return (float) $sellerFeedbackString;
    }

    /**
     * @param DomCrawler $articleCrawler
     * @return string
     */
    protected function extractSellerLocation(DomCrawler $articleCrawler): string
    {
        $sellerLocationHtml = $articleCrawler->filter('#j-store-info-wrap .store-address');
        $sellerLocationString = trim($sellerLocationHtml->text());

        return $sellerLocationString;
    }

    /**
     * @param DomCrawler $articleCrawler
     * @return int
     */
    protected function extractSellerSince(DomCrawler $articleCrawler): int
    {
        $sellerSinceHtml = $articleCrawler->filter('.store-open-time span');
        $sellerSinceString = $sellerSinceHtml->text();
        $sellerSinceStringParts = explode(' ', $sellerSinceString);

        return (int) $sellerSinceStringParts[0];
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
