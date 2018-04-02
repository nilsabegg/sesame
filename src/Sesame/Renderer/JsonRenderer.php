<?php
namespace Sesame\Renderer;

use Sesame\Model\Article;

/**
 * Class JsonRenderer
 * @package Sesame\Renderer
 */
class JsonRenderer extends Renderer
{

    /**
     * @param Article $article
     * @return string
     */
    public function renderArticle(Article $article): string
    {
        return 'tbd';
    }
}
