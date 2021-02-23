<?php
namespace Main\App;

class ResponseHandler {
    

    const ADS_KEY = 'ads';
    const PAGES_KEY = 'pages';
    const TOTAL_KEY = 'total';
    
    private $body;

    public function __construct($body) {
        $this->body = $body;
        $this->toArray();
    }

    private function toArray() {
        if (is_array($this->body)) {
            return;
        }
        $this->body = json_decode($this->body, true);        
    }
    public function get(): array {
         return $this->body;
    }

    public function hasParam($key): bool {
        if (isset($this->body[$key])) {
            return true;
        }
        return false;

    }

    public function getParam($key) :mixed {
          if ($this->hasParam($key)) {
            return $this->body[$key];
          }
          return false;

    }

    public function getPages(): int {
         return (int)$this->getParam(ResponseHandler::PAGES_KEY);
         
    }

    public function getAds():array {
        return $this->getParam(ResponseHandler::ADS_KEY);
    }

    public function getTotal() {
        return $this->getParam(ResponseHandler::TOTAL_KEY);

    }

}