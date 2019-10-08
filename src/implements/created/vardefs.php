<?php

$vardefs = array();

include 'custom/include/SugarObjects/implements/created_by/vardefs.php';

$m = $vardefs;

include 'custom/include/SugarObjects/implements/created_date/vardefs.php';

$vardefs = array_merge_recursive($m,$vardefs);