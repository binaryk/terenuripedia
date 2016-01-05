<?php

return [

	'driver' => env('MAIL_DRIVER', 'smtp'),

	'host' => env('MAIL_HOST', 'smtp.gmail.com'),

	'port' => env('MAIL_PORT', 587),

	'from' => ['address' => 'lupacescueduard@gmail.com', 'name' => 'lupacescueduard@gmail.com'],

	'encryption' => env('MAIL_ENCRYPTION', 'tls'),

	'username' => env('MAIL_USERNAME','lupacescueduard@gmail.com'),

	'password' => env('MAIL_PASSWORD'),

	'sendmail' => '/usr/sbin/sendmail -bs',

	'pretend' => false,
	/*
	 * office@terenuripedia.ro
	 * parola cateliudan100@
	 * ssl/tsl => 465
	 * no-ssl  => 26
	 * mail.terenuripedia.ro 
	*/
];