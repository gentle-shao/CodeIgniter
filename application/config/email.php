<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config = [
    'protocol' => getenv('MAIL_MAILER'), // 'mail', 'sendmail', or 'smtp'
    'smtp_host' => getenv('MAIL_HOST'), 
    'smtp_port' => getenv('MAIL_PORT'),
    'smtp_user' => getenv('MAIL_USERNAME'),
    'smtp_pass' => getenv('MAIL_PASSWORD'),
    'smtp_crypto' => getenv('MAIL_ENCRYPTION'), //can be 'ssl' or 'tls' for example
    'mailtype' => getenv('MAIL_TYPE'), //plaintext 'text' mails or 'html'
    'smtp_timeout' => '4', //in seconds
    'charset' => 'iso-8859-1',
    'wordwrap' => TRUE
];