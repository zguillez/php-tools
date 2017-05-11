<?php
  namespace Z;
  class Tools
  {
    private $date;
    private $ip;
    private $conn;
    public function __construct()
    {
      $this->date = date("Y-m-d H:i:s");
      $this->ip   = ($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : 0;
    }
    public function test($data)
    {
      var_dump([$this->date, $this->ip, $data]);
    }
    /**
     * HTTP
     */
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
    /**
     * DATABASE
     */
    public function database($servername, $username, $password, $dbname)
    {
      $this->conn = new mysqli($servername, $username, $password, $dbname);
      if($this->conn->connect_error) {
        die("Connection failed: " . $this->conn->connect_error);
      }

      return $this->conn;
    }
    public function sql($sql)
    {
      return $this->conn->query($sql);
    }
    public function sql2csv($filename, $sql, $schema = null)
    {
      $result = $this->conn->query($sql);
      $data   = [];
      if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          $data[] = $row;
        }
      }
      $this->csv($filename, $data, $schema);
    }
    /**
     * FILES
     */
    public function csv($filename, $data = null, $schema = null)
    {
      header('Content-Type: text/csv; charset=utf-8');
      header('Content-Disposition: attachment; filename=' . $filename . '.csv');
      $output = fopen('php://output', 'w');
      if($schema) {
        fputcsv($output, $schema);
      }
      if($data) {
        foreach($data as $row) {
          fputcsv($output, $row);
        }
      }
    }
    public function excel($filename, $data = null, $schema = null)
    {
      header('Content-Type: application/vnd.ms-excel; charset=utf-8');
      header('Content-Disposition: attachment; filename=' . $filename . '.xlsx');
      for($i = 65; $i <= 90; $i ++) {
        $letras[] = chr($i);
      }
      $total = count($data);
      for($i = 0; $i < $total; $i ++) {
        if($i < count($letras)) {
          $cells[] = $letras[$i];
        } else {
          $pag     = floor($i / count($letras));
          $letra   = $i - $pag * count($letras);
          $cells[] = $letras[$pag - 1] . $letras[$letra];
        }
      }
      $doc = new \PHPExcel();
      $doc->setActiveSheetIndex(0);
      if($schema) {
        for($i = 0; $i < count($schema); $i ++) {
          $doc->getActiveSheet()->SetCellValue($cells[$i] . '1', $schema[$i]);
        }
        $index = 2;
      } else {
        $index = 1;
      }
      foreach($data as $row) {
        for($i = 0; $i < count($row); $i ++) {
          $doc->getActiveSheet()->SetCellValue($cells[$i] . $index, $row[$i]);
        }
        $index ++;
      }
      $objWriter = \PHPExcel_IOFactory::createWriter($doc, 'Excel2007');
      $objWriter->save('php://output');
    }
  }