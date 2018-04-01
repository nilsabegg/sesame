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
    protected $priceDiscount;

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
