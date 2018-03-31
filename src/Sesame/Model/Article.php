<?php
namespace Sesame\Model;

/**
 * Class Article
 * @package Sesame\Model
 */
class Article
{
    protected $url;

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
