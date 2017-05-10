<?php
  require 'vendor/autoload.php';
  use Z\Tools;

  $tools = new Tools();
  $data  = ['nombre' => 'nombre', 'apellidos' => 'apellidos', 'provincia' => '28', 'cp' => '28914',
            'domicilio' => 'domicilio', 'telefono' => '612312312', 'email' => 'prueba@prueba.com',
            'nivelestudios' => '1', 'edad' => '34', 'idcurso' => '105', 'pais' => '90', 'idcampana' => '1135'];
  //$result = $tools->get('http://tracker.masterd.es/json', $data, true);
  $result = $tools->post('http://tracker.masterd.es/json', $data, true);
  var_dump($result);