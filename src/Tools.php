<?php
  namespace Z;
  class Tools
  {
    private $date;
    private $ip;
    public function __construct()
    {
      $this->date = date("Y-m-d H:i:s");
      $this->ip   = ($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : 0;
    }
    public function test($data)
    {
      var_dump([$this->date, $this->ip, $data]);
    }
    public function get($url, $data = null, $isJson = false)
    {
      if($data) {
        foreach($data as $key => $value) {
          if(strpos($url, '?') === false) {
            $url .= '?' . $key . '=' . urlencode($value);
          } else {
            $url .= '&' . $key . '=' . urlencode($value);
          }
        }
      }
      $handler = curl_init();
      curl_setopt($handler, CURLOPT_URL, $url);
      curl_setopt($handler, CURLOPT_HEADER, false);
      curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
      $response = curl_exec($handler);
      curl_close($handler);
      if($isJson) {
        $response = json_decode($response, true);
      }

      return $response;
    }
    public function post($url, $data = null, $isJson = false)
    {
      if($data) {
        $data_str = '';
        foreach($data as $key => $value) {
          $data_str .= $key . '=' . urlencode($value) . '&';
        }
        rtrim($data_str, '&');
      }
      $handler = curl_init();
      curl_setopt($handler, CURLOPT_URL, $url);
      curl_setopt($handler, CURLOPT_HEADER, false);
      curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($handler, CURLOPT_POST, count($data));
      curl_setopt($handler, CURLOPT_POSTFIELDS, $data_str);
      $response = curl_exec($handler);
      curl_close($handler);
      if($isJson) {
        $response = json_decode($response, true);
      }

      return $response;
    }
  }