<?php

require('Registry.php');

use Flyer\Components\Foundation\Registry;

Registry::set('name', 'Bob');
Registry::update('name', 'Bill');

echo Registry::get('name');