<?php
namespace Main\App;

class ResponseHandler {
    

    const ADS_KEY = 'ads';
    const PAGES_KEY = 'pages';

    
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
    public function get() {
         return $this->body;
    }

    public function hasParam($key) {
        if (isset($this->body[$key])) {
            return true;
        }
        return false;

    }

    public function getParam($key) {
          if ($this->hasParam($key)) {
            return $this->body[$key];
          }
          return false;

    }

    public function getPages() {
         return $this->getParam(ResponseHandler::PAGES_KEY);
         
    }

    public function getAds() {
        return $this->getParam(ResponseHandler::ADS_KEY);
    }

}