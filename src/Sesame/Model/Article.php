<?php
namespace Sesame\Model;

/**
 * Class Article
 * @package Sesame\Model
 */
class Article
{

    /**
     * @var string
     */
    protected $description;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var int
     */
    protected $orders;

    /**
     * @var float
     */
    protected $price;

    /**
     * @var float
     */
    protected $priceCurrency;

    /**
     * @var float
     */
    protected $priceDiscount;

    /**
     * @var array
     */
    protected $properties = array();

    /**
     * @var float
     */
    protected $rating;

    /**
     * @var int
     */
    protected $ratingAmount;

    /**
     * @var string
     */
    protected $seller;

    /**
     * @var float
     */
    protected $sellerFeedback;

    /**
     * @var string
     */
    protected $sellerLocation;

    /**
     * @var int
     */
    protected $sellerSince;

    /**
     * @var int
     */
    protected $stock;

    /**
     * @var string
     */
    protected $url;

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Article
     */
    public function setDescription(string $description): Article
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Article
     */
    public function setName(string $name): Article
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return int
     */
    public function getOrders(): int
    {
        return $this->orders;
    }

    /**
     * @param int $orders
     * @return Article
     */
    public function setOrders(int $orders): Article
    {
        $this->orders = $orders;

        return $this;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     * @return Article
     */
    public function setPrice(float $price): Article
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return string
     */
    public function getPriceCurrency(): string
    {
        return $this->priceCurrency;
    }

    /**
     * @param string $priceCurrency
     * @return Article
     */
    public function setPriceCurrency(string $priceCurrency): Article
    {
        $this->priceCurrency = $priceCurrency;

        return $this;
    }

    /**
     * @return float
     */
    public function getPriceDiscount(): float
    {
        return $this->priceDiscount;
    }

    /**
     * @param float $priceDiscount
     * @return Article
     */
    public function setPriceDiscount(float $priceDiscount): Article
    {
        $this->priceDiscount = $priceDiscount;

        return $this;
    }

    /**
     * @return array
     */
    public function getProperties(): array
    {
        return $this->properties;
    }

    /**
     * @param array $properties
     * @return Article
     */
    public function setProperties(array $properties): Article
    {
        $this->properties = $properties;

        return $this;
    }

    /**
     * @return int
     */
    public function getRating(): int
    {
        return $this->rating;
    }

    /**
     * @param int $rating
     * @return Article
     */
    public function setRating(int $rating): Article
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * @return int
     */
    public function getRatingAmount(): int
    {
        return $this->ratingAmount;
    }

    /**
     * @param int $ratingAmount
     * @return Article
     */
    public function setRatingAmount(int $ratingAmount): Article
    {
        $this->ratingAmount = $ratingAmount;

        return $this;
    }

    /**
     * @return string
     */
    public function getSeller(): string
    {
        return $this->seller;
    }

    /**
     * @param string $seller
     * @return Article
     */
    public function setSeller(string $seller): Article
    {
        $this->seller = $seller;

        return $this;
    }

    /**
     * @return float
     */
    public function getSellerFeedback(): float
    {
        return $this->sellerFeedback;
    }

    /**
     * @param float $sellerFeedback
     * @return Article
     */
    public function setSellerFeedback(string $sellerFeedback): Article
    {
        $this->sellerFeedback = $sellerFeedback;

        return $this;
    }

    /**
     * @return string
     */
    public function getSellerLocation(): string
    {
        return $this->sellerLocation;
    }

    /**
     * @param string $sellerLocation
     * @return Article
     */
    public function setSellerLocation(string $sellerLocation): Article
    {
        $this->sellerLocation = $sellerLocation;

        return $this;
    }

    /**
     * @return int
     */
    public function getSellerSince(): int
    {
        return $this->sellerSince;
    }

    /**
     * @param int $sellerSince
     * @return Article
     */
    public function setSellerSince(int $sellerSince): Article
    {
        $this->sellerSince = $sellerSince;

        return $this;
    }

    /**
     * @return int
     */
    public function getStock(): int
    {
        return $this->stock;
    }

    /**
     * @param int $stock
     * @return Article
     */
    public function setStock(int $stock): Article
    {
        $this->stock = $stock;

        return $this;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return Article
     */
    public function setUrl(string $url): Article
    {
        $this->url = $url;

        return $this;
    }
}
