<?php

namespace Sesame\Test;

use PHPUnit\Framework\TestCase;
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
    public function testCrawlArticle()
    {
        $sesame = new Sesame();

        $this->assertTrue($sesame->crawlArticle());
    }
}
