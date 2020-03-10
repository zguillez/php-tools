<?php
require 'vendor/autoload.php';
/** */
$tools = new Z\Tools();
/** */
//$data = ['a' => '1', 'b' => '2', 'c' => '3'];
//$result = $tools->get('http://tracker.masterd.es/json', $data, true);
//$result = $tools->post('http://tracker.masterd.es/json', $data, true);
//$tools->test($result);
/** */
//$data = [[1, "a"], [2, "b"], [3, "c"], [4, "d"]];
//$tools->excel('test', $data, ['id', 'value']);
/** */
//$db = $tools->database('***.***.***.***', 'user', '******', 'database');
//$data = $db->sql2array('SELECT * FROM users');
//$db->test($data);
//$tools->excel('test', $data, ['id', 'transaction_id'], true);
//$tools->sql2csv('test', 'SELECT * FROM hasoffers', ['id', 'transaction_id']);
//$tools->sql2excel('test2', 'SELECT * FROM hasoffers', ['id', 'transaction_id']);
/** */
$mail = $tools->mail('m.mydomain.com', 'key-****************************');
$result = $mail->send("no_reply@mydomain.com", "dummy@gmail.com", "[test] z-mailgun", "this is a test...");
var_dump($result);