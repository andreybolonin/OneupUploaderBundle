<?php

namespace Oneup\UploaderBundle\Tests\Uploader\Response;

use Oneup\UploaderBundle\Uploader\Response\EmptyResponse;
use PHPUnit\Framework\TestCase;

class TestEmptyResponse extends TestCase
{
    public function testEmpty()
    {
        $response = new EmptyResponse();
        $assembled = $response->assemble();

        $this->assertTrue(is_array($assembled));
        $this->assertCount(0, $assembled);
    }

    public function testWithItems()
    {
        $response = new EmptyResponse();

        // fill in some data
        $response['cat'] = 'grumpy';
        $response['dog'] = 'has no idea';

        $assembled = $response->assemble();

        $this->assertTrue(is_array($assembled));
        $this->assertCount(2, $assembled);
    }
}
