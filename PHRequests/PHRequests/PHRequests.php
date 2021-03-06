<?php

namespace PHRequests;

use PHRequests\Models\Methods;
use PHRequests\Models\Request;

class PHRequests {

  /**
   * Makes a PHRequests
   * 
   * @param String $method : Some allowed HTTP Method (GET, PUT, POST, etc).
   * @param String $url : The Url to make the request
   * @param Array $options : Options for the PHRequests
   * 
   * @return PHRequests\Model\Response
   */
  static public function request($method, $url, $options = array()) {
    $r = new Request($method, $url, $options);
    return $r->send();
  }
  
  static public function get($url, $options = array()) {
    return self::request(Methods::GET, $url, $options);
  }
  
  static public function post($url, $options = array()) {
    return self::request(Methods::POST, $url, $options);
  }
  
  static public function put($url, $options = array()) {
    return self::request(Methods::PUT, $url, $options);
  }
  
  static public function delete($url, $options = array()) {
    return self::request(Methods::DELETE, $url, $options);
  }
  
  static public function head($url, $options = array()) {
    return self::request(Methods::HEAD, $url, $options);
  }
  
  static public function options($url, $options = array()) {
    return self::request(Methods::OPTIONS, $url, $options);
  }

}
