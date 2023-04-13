<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['sms']['authkey'] = '274211ApXPMDbh5cc424c6';
$config['sms']['sender'] = 'SOCKET';
$config['sms']['route'] = '4';
$config['sms']['url'] = 'https://api.msg91.com/api/v2/sendsms?country=91';
$config['sms']['country'] = '91';
/**
 * @var @OTP@ is variable which will be replaced with OTP;
 */
$config['sms']['register_otp'] = "Dear User! \n OTP for your ".WEBSITE_TITLE." account is @OTP@ !";
$config['sms']['default'] = "Welcome to ".WEBSITE_TITLE."!";