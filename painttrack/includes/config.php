<?php

define('DBDRIVER', 'mysql');
define('DBHOST','localhost');
define('DBNAME','pms_db');
define('DBUSER','root');
define('DBPASSWORD','');

if( ! defined( 'SMTP_HOST' ) )
    define( 'SMTP_HOST', 'smtp.gmail.com' );

if( ! defined( 'SMTP_USERNAME' ) )
    define( 'SMTP_USERNAME', 'calendarfromemail@gmail.com' );

if( ! defined( 'SMTP_PASSWORD' ) )
    define( 'SMTP_PASSWORD', 'Abc123654' );

if( ! defined( 'SMTP_SECURE' ) )
    define( 'SMTP_SECURE', 'tls' );

if( ! defined( 'SMTP_PORT' ) )
    define( 'SMTP_PORT', 587 );

if( ! defined( 'SMTP_FROM' ) )
    define( 'SMTP_FROM', 'calendarfromemail@gmail.com' );

if( ! defined( 'SMTP_FROM_NAME' ) )
    define( 'SMTP_FROM_NAME', 'Admin' );