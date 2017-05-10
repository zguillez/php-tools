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
      var_dump($this->date);
      var_dump($this->ip);
      var_dump($data);
    }
  }