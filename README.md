# php-tools

[![Join the chat at https://gitter.im/zguillez/php-tools](https://badges.gitter.im/zguillez/php-tools.svg)](https://gitter.im/zguillez/php-tools?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)
[![License](http://img.shields.io/:license-mit-blue.svg)](http://doge.mit-license.org)

PHP module for common tools

# Getting Started

### Add package to composer.json

`composer require zguillez/php-tools`

	//packaje.json
	{
        "require": {
            "zguillez/php-tools": "^0.1.0"
        }
    }

# Usage:

	require 'vendor/autoload.php';
	use Z\Tools;

	$tools = new Tools();
	$tools->test('This is a test!');

# Examples

## HTTP/GET

```
$data  = ['nombre' => 'test', 'apellidos' => 'test', 'email' => 'test@test.com'];
$result = $tools->get('https://dummy.webservice.com/json', $data, true);
$tools->test($result);
```

## HTTP/POST

```
$data  = ['nombre' => 'test', 'apellidos' => 'test', 'email' => 'test@test.com'];
$result = $tools->post('https://dummy.webservice.com/json', $data, true);
$tools->test($result);
```

## DATABASE

```
$db = $tools->database('***.***.***.***', 'user', '********', 'database');
$db->sql('INSERT INTO dummy_table SET value=1']);
leadid = $db->sql2lead('INSERT INTO dummy_table SET value=1']);
$tools->test($result);
```

## EXCEL

```
$data = [[1, "a"], [2, "b"], [3, "c"], [4, "d"]];
$tools->excel('test', $data, ['id', 'value']);
```

## DATABASE 2 EXCEL

```
$data = $tools->sql2array('SELECT * FROM dummy_table');
$tools->excel('test', $data, ['id', 'value', 'created_at'], true);
```

```
$tools->sql2csv('test', 'SELECT * FROM dummy_table', ['id', 'value', 'created_at']);
```

```
$tools->sql2excel('test2', 'SELECT * FROM dummy_table', ['id', 'value', 'created_at']);
```

# Contributing and issues

Contributors are welcome, please fork and send pull requests! If you have any ideas on how to make this project better then please submit an issue or send me an [email](mailto:mail@zguillez.io).

# License

©2020 Zguillez.io

Original code licensed under [MIT](https://en.wikipedia.org/wiki/MIT_License) Open Source projects used within this project retain their original licenses.

# Changelog

### v1.0.0 (Mar 10, 2020)

* z-database package
* z-http package

### v0.1.0 (May 31, 2017)

* GET/POST curl
* Database connect
* CSV/EXCEL file export

### v0.0.1 (May 10, 2017)

* Initial implementation

[![Analytics](https://ga-beacon.appspot.com/UA-1125217-30/zguillez/php-tools?pixel)](https://github.com/igrigorik/ga-beacon)
