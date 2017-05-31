# php-tools

[![Dependency Status](https://gemnasium.com/zguillez/php-tools.svg)](https://gemnasium.com/zguillez/php-tools)
![](https://reposs.herokuapp.com/?path=zguillez/php-tools)
[![License](http://img.shields.io/:license-mit-blue.svg)](http://doge.mit-license.org)
[![Join the chat at https://gitter.im/zguillez/php-tools](https://badges.gitter.im/zguillez/php-tools.svg)](https://gitter.im/zguillez/php-tools?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)

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

# Example:

	require 'vendor/autoload.php';
	use Z\Tools;
	
	$tools = new Tools();
	$tools->test('This is a test!');


# Contributing and issues

Contributors are welcome, please fork and send pull requests! If you have any ideas on how to make this project better then please submit an issue or send me an [email](mailto:mail@zguillez.io).

# License

©2016 Zguillez.io

Original code licensed under [MIT](https://en.wikipedia.org/wiki/MIT_License) Open Source projects used within this project retain their original licenses.

# Changelog

### v0.1.0 (May 31, 2017) 

* GET/POST curl
* Database connect
* CSV/EXCEL file export

### v0.0.1 (May 10, 2017) 

* Initial implementation

[![Analytics](https://ga-beacon.appspot.com/UA-1125217-30/zguillez/php-tools?pixel)](https://github.com/igrigorik/ga-beacon)