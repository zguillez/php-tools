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
        foreach($data as $item => $value) {
          if(strpos($url, '?') === false) {
            $url .= '?' . $item . '=' . urlencode($value);
          } else {
            $url .= '&' . $item . '=' . urlencode($value);
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
  }