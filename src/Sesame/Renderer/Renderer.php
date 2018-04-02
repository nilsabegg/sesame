<?php
namespace Sesame\Renderer;

use Sesame\Model\Article;

/**
 * Class Renderer
 * @package Sesame\Renderer
 */
abstract class Renderer
{

    /**
     * @param Article $article
     * @return string
     */
    abstract public function renderArticle(Article $article): string;
}
