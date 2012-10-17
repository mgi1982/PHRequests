<?php

include_once 'bootstrap.php';

class BasicHeadTest extends PHPUnit_Framework_TestCase {

  public function testBasicHead() {
    $response = \PHRequests\PHRequests::head(BASE_GET_URL . 'get');
    $this->assertEquals($response->http_code, 200);
  }

}
