<?php

// namespace IV\Component;

// use HTML;

require_once(__DIR__ . DS . 'custom-components' . DS .'js.php');
require_once(__DIR__ . DS . 'custom-components' . DS .'css.php');

kirby()->set('component', 'js', 'CustomJS');
kirby()->set('component', 'css', 'CustomCSS');