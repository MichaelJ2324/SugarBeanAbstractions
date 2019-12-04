<?php

$vardefs = array();

include 'custom/include/SugarObjects/implements/modified_by/vardefs.php';

$m = $vardefs;

include 'custom/include/SugarObjects/implements/modified_date/vardefs.php';

$vardefs = array_merge_recursive($m,$vardefs);