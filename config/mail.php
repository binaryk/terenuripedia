<?php

return [

	'driver' => env('MAIL_DRIVER', 'smtp'),

	'host' => env('MAIL_HOST', 'localhost'),

	'port' => env('MAIL_PORT', 26),

	'from' => ['address' => 'office@terenuripedia.ro', 'name' => 'office@terenuripedia.ro'],

	'encryption' => env('MAIL_ENCRYPTION', ''),

	'username' => env('MAIL_USERNAME','	office@terenuripedia.ro'),

	'password' => env('MAIL_PASSWORD','cateliudan100@'),

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