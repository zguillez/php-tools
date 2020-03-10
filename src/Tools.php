<?php

namespace Z;
//----------------------------------------------------------
class Tools
{
  private $date;
  private $ip;
  private $database;
  private $http;
  private $mailgun;

  //----------------------------------------------------------
  public function __construct()
  {
    $this->date = date("Y-m-d H:i:s");
    $this->ip = ($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : 0;
    $this->http = new Http();
  }

  //----------------------------------------------------------
  public function test($data)
  {
    var_dump([$this->date, $this->ip, $data]);
  }

  /**---------------------------------------------------------
   * HTTP
   */
  public function get($url, $data = null, $isJson = false)
  {
    return $this->http->get($url, $data, $isJson);
  }

  public function post($url, $data = null, $isJson = false)
  {
    return $this->http->post($url, $data, $isJson);
  }

  /**---------------------------------------------------------
   * DATABASE
   */
  public function database($servername, $username, $password, $dbname)
  {
    $this->database = new Database($servername, $username, $password, $dbname);

    return $this->database;
  }

  /**---------------------------------------------------------
   * MAILGUN
   */
  public function mailgun($domain, $apikey)
  {
    $this->mailgun = new Mailgun($domain, $apikey);

    return $this->mailgun;
  }

  //----------------------------------------------------------
  public function sql2csv($filename, $sql, $schema = null)
  {
    $result = $this->database->query($sql);
    $data = [];
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $data[] = $row;
      }
    }
    $this->csv($filename, $data, $schema);
  }

  //----------------------------------------------------------
  public function sql2excel($filename, $sql, $schema = null)
  {
    $result = $this->database->query($sql);
    $data = [];
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $data[] = $row;
      }
    }
    $this->excel($filename, $data, $schema, true);
  }

  /**---------------------------------------------------------
   * FILES
   */
  public function csv($filename, $data = null, $schema = null)
  {
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=' . $filename . '.csv');
    $output = fopen('php://output', 'w');
    if ($schema) {
      fputcsv($output, $schema);
    }
    if ($data) {
      foreach ($data as $row) {
        fputcsv($output, $row);
      }
    }
  }

  //----------------------------------------------------------
  public function excel($filename, $data = null, $schema = null, $issql = false)
  {
    header('Content-Type: application/vnd.ms-excel; charset=utf-8');
    header('Content-Disposition: attachment; filename=' . $filename . '.xlsx');
    for ($i = 65; $i <= 90; $i++) {
      $letras[] = chr($i);
    }
    if ($schema) {
      $total = count($schema);
    } else {
      $total = 1000;
    }
    for ($i = 0; $i < $total; $i++) {
      if ($i < count($letras)) {
        $cells[] = $letras[$i];
      } else {
        $pag = floor($i / count($letras));
        $letra = $i - $pag * count($letras);
        $cells[] = $letras[$pag - 1] . $letras[$letra];
      }
    }
    $doc = new \PHPExcel();
    $doc->setActiveSheetIndex(0);
    if ($schema) {
      for ($i = 0; $i < count($schema); $i++) {
        $doc->getActiveSheet()->SetCellValue($cells[$i] . '1', $schema[$i]);
      }
      $index = 2;
    } else {
      $index = 1;
    }
    foreach ($data as $row) {
      for ($i = 0; $i < count($row); $i++) {
        if ($schema && $issql) {
          $doc->getActiveSheet()->SetCellValue($cells[$i] . $index, $row[$schema[$i]]);
        } else {
          $doc->getActiveSheet()->SetCellValue($cells[$i] . $index, $row[$i]);
        }
      }
      $index++;
    }
    $objWriter = \PHPExcel_IOFactory::createWriter($doc, 'Excel2007');
    $objWriter->save('php://output');
  }
}
