<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;

final class HttpClientTest extends TestCase
{
    
    public function provideConfig(): array {
         return [ 
            [
                Main\App\App::getUrl(), 1, 10
            ]

            ];
    }
    
    /**
    * @dataProvider provideConfig
    */
    public function testSend($url, $page, $per_page): void
    {
        $client = new Main\App\HttpClient();
        $resp = (string)$client->send($url, $page, $per_page);
        $body = json_decode($resp, true);
        $this->assertTrue(isset($body['total']));
    }

}