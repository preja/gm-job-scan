<?php 
namespace Main\App; 

use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\RequestException;


class HttpClient {
    public function  send($url, $page = 1, $per_page=10) {
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET',$url, ['query' => ['page' => $page, 'per_page' => $per_page]]);
        return  $response->getBody();
    }
}