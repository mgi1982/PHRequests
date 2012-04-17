<?php

include_once 'bootstrap.php';

class BasicGetTest extends PHPUnit_Framework_TestCase {

  public function testBasicGet() {
    $response = \Requests\Requests::get(BASE_GET_URL . 'get');
    $this->assertEquals($response->http_code, 200);
    
    $response = \Requests\Requests::get(BASE_GET_URL . 'noneError');   
    $this->assertEquals($response->http_code, 404);
  }

  public function testParameterGet() {
    $options = array(
        'params' => array(
            'var1' => 1,
            'var2' => 'Hello',
        )
    );
    $response = \Requests\Requests::get(BASE_GET_URL . 'get', $options);
    $this->assertEquals($response->http_code, 200);
    $jres = json_decode($response);
    $this->assertEquals(isset($jres->args), TRUE);
    $this->assertEquals(isset($jres->args->var1), TRUE);
    $this->assertEquals(isset($jres->args->var2), TRUE);
    $this->assertEquals($jres->args->var1, 1);
    $this->assertEquals($jres->args->var2, 'Hello');
    $this->assertEquals((string) $response, $response->content);
  }

  /**
   * @expectedException Requests\Exceptions\RequestTimeoutException
   */
  public function testTimeoutGet() {
    $options = array(
        'timeout' => 5,
    );
    \Requests\Requests::get(BASE_GET_URL . 'delay/100000000', $options);    
  }
  
  /**
   * @expectedException Requests\Exceptions\RequestResolveHostException 
   */
  public function testUnresolvedHost() {    
    \Requests\Requests::get('foo');       
  }
  
  public function testRedirectGet() {
    $options = array (
        'allow_redirects' => FALSE,
    );
    $response = \Requests\Requests::get(BASE_GET_URL . 'redirect/4', $options);
    $this->assertEquals($response->http_code, 302);
    
    $options = array (
        'allow_redirects' => TRUE,
        'max_redirects' => 2
    );
    try {
      $response = \Requests\Requests::get(BASE_GET_URL . 'redirect/4', $options);
    } catch (\Requests\Exceptions\RequestException $e) {
      $this->assertInstanceOf('\Requests\Exceptions\RequestException', $e);
    }
    
    $options = array (
        'allow_redirects' => TRUE,
        'max_redirects' => 5
    );    
    $response = \Requests\Requests::get(BASE_GET_URL . 'redirect/4', $options);
    $this->assertEquals($response->http_code, 200);
       
    //Default behavior
    $response = \Requests\Requests::get(BASE_GET_URL . 'redirect/2');
    $this->assertEquals($response->http_code, 200);
  }

}
