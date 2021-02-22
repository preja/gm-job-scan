<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;

final class ResponseHandlerTest extends TestCase
{

    public function jsonProvider() : array {
         return [['{"ads":[],"total":10,"pages":25}']];
    }
    
   /**
    * @dataProvider jsonProvider
    */
    public function testToArray($body): void
    {
        $rh = new Main\App\ResponseHandler($body);
        $body = $rh->get();
        $this->assertTrue(is_array($body));

    }

    /**
    * @dataProvider jsonProvider
    */
    public function testGetPage($body):void
    {
        $rh = new Main\App\ResponseHandler($body);
        $this->assertEquals($rh->getPages(), 25);

    }

    /**
    * @dataProvider jsonProvider
    */
    public function testGetAds($body)
    {
        $rh = new Main\App\ResponseHandler($body);
        $this->assertTrue(is_array($rh->getAds()));

    }
    
    
    /**
    * @dataProvider jsonProvider
    */
    public function testHasParams($body) {
        $rh = new Main\App\ResponseHandler($body);
        $this->assertTrue($rh->hasParam('total'));

    }

    /**
    * @dataProvider jsonProvider
    */
    public function testFailedHasParams($body) {
        $rh = new Main\App\ResponseHandler($body);
        $this->assertFalse($rh->hasParam('notExsist'));

    }



     
}