<?php
header('Content-Type: text/HTML; charset=utf-8');
session_start();
date_default_timezone_set('Europe/Budapest');

require_once('config.php');
require_once('url.php');
require_once('frontend/views/index.html');
