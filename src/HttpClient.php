<?php declare(strict_types=1);
namespace Main\App; 

use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\RequestException;


class HttpClient {
    public function  send($url, $page = 1, $per_page=10) {
        $client = new \GuzzleHttp\Client();
        try {
        $response = $client->request('GET',$url, ['query' => ['page' => $page, 'per_page' => $per_page]]);
        } catch(RequestException $e) {
              echo "Błąd opdowiedzi serwera: " . $e->getMessage();
              exit(0);
        } 
        return  (string)$response->getBody();
    }
}