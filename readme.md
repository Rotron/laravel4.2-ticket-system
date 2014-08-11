## Laravel - Tickets System

[![Build Status](https://travis-ci.org/laravel/framework.svg)](https://travis-ci.org/laravel/framework)
[![Total Downloads](https://poser.pugx.org/laravel/framework/downloads.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/framework/v/stable.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Unstable Version](https://poser.pugx.org/laravel/framework/v/unstable.svg)](https://packagist.org/packages/laravel/framework)
[![License](https://poser.pugx.org/laravel/framework/license.svg)](https://packagist.org/packages/laravel/framework)

Laravel - Tickets System is clean and minimal tickets management system with essential functionalities that helps you to manage your clients issues.

It’s designed to be easy to use and understand for all types of users.

	Italian language
    Clean Interfaces for Admin and Users
    Users Registration
    Filterting tickets according to their status [open-closed]
    Admin is able to close or open a ticket
    Simple and clean ticket comments between both admin and client
    Sortable Tickets; easily sort tickets according to time, status, or sender
    Settings
    Validated Inputs, Secure
    Automatic mail sender when the ticket it's open, closed or replied


### Installation

	Copy all files in your www folder

		chmod -Rf 755 storage
	
	Edit:
		
		app/config/app.php

		change this values:

			'debug' => true, 					//remove true for production mode

			'name' => 'Ticket System',   		//change with your name

			'logo' => 'public/imgs/logo.jpg',	//change with your logo

			'option1' => 'Assistenza Hardware', //options for tickets dropdown
			'option2' => 'Assistenza Software',

	Edit:

		app/config/database.php

		change this values:

		'mysql' => array(
			'driver'    => 'mysql',
			'host'      => 'localhost',  		//your database host
			'database'  => 'ticket',			//database name
			'username'  => 'root',				//username
			'password'  => '',					//password
			'charset'   => 'utf8',
			'collation' => 'utf8_unicode_ci',
			'prefix'    => '',
		),

	Edit:

		app/config/mail.php

		I used gmail smtp service, you can use what you want
		
		change this values:

		'driver' => 'smtp',
		'host' => 'smtp.gmail.com',
		'port' => 587,
		'from' => array('address' => 'youremail@gmail.com', 'name' => 'Assistenza'),
		'encryption' => 'tls',
		'username' => '',
		'password' => '',


	#DATABASE CONFIGURATION

		Find the SQL file in 
		
		database/ticket.sql


	#LOGIN ACCOUNT

	Admin:

		admin@admin.com
		123456

	User:

	create yourself with registration form



### License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
