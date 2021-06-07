<?php
// Made with SugarFuel v3.3.0

$manifest = array(
    "license" => "Apache-2.0",
    "bugs" => array(),
    "acceptable_sugar_versions" => array("exact_matches" => array("10.3.0", "11.0.0"), "regex_matches" => array()),
    "acceptable_sugar_flavors" => array("ENT"),
    "name" => "SugarBean Abstractions",
    "description" => "Abstraction SugarBean SugarObject Templates for usage when building out modules.",
    "version" => "1.0",
    "type" => "module",
    "is_uninstallable" => true,
    "published_date" => "Wed, 02 Jun 2021 03:39:32 GMT"
);

$installdefs = array(
    "copy" => array(
        array(
            "from" => "<basepath>/files/custom/include/SugarObjects/implements/file_upload",
            "to" => "custom/include/SugarObjects/implements/file_upload"
        ),
        array(
            "from" => "<basepath>/files/custom/include/SugarObjects/implements/category",
            "to" => "custom/include/SugarObjects/implements/category"
        ),
        array(
            "from" => "<basepath>/files/custom/include/SugarObjects/implements/module_number",
            "to" => "custom/include/SugarObjects/implements/module_number"
        ),
        array(
            "from" => "<basepath>/files/custom/include/SugarObjects/implements/description",
            "to" => "custom/include/SugarObjects/implements/description"
        ),
        array(
            "from" => "<basepath>/files/custom/include/SugarObjects/implements/follow_up_datetime",
            "to" => "custom/include/SugarObjects/implements/follow_up_datetime"
        ),
        array(
            "from" => "<basepath>/files/custom/include/SugarObjects/implements/parent_record",
            "to" => "custom/include/SugarObjects/implements/parent_record"
        ),
        array(
            "from" => "<basepath>/files/custom/include/SugarObjects/implements/modified",
            "to" => "custom/include/SugarObjects/implements/modified"
        ),
        array(
            "from" => "<basepath>/files/custom/include/SugarObjects/implements/status",
            "to" => "custom/include/SugarObjects/implements/status"
        ),
        array(
            "from" => "<basepath>/files/custom/include/SugarObjects/implements/ip_address",
            "to" => "custom/include/SugarObjects/implements/ip_address"
        ),
        array(
            "from" => "<basepath>/files/custom/include/SugarObjects/implements/created",
            "to" => "custom/include/SugarObjects/implements/created"
        ),
        array(
            "from" => "<basepath>/files/custom/include/SugarObjects/implements/type",
            "to" => "custom/include/SugarObjects/implements/type"
        ),
        array(
            "from" => "<basepath>/files/custom/include/SugarObjects/implements/auto_id",
            "to" => "custom/include/SugarObjects/implements/auto_id"
        ),
        array(
            "from" => "<basepath>/files/custom/include/SugarObjects/implements/name",
            "to" => "custom/include/SugarObjects/implements/name"
        ),
        array(
            "from" => "<basepath>/files/custom/include/SugarObjects/implements/deleted",
            "to" => "custom/include/SugarObjects/implements/deleted"
        ),
        array(
            "from" => "<basepath>/files/custom/include/SugarObjects/templates/bare_file",
            "to" => "custom/include/SugarObjects/templates/bare_file"
        ),
        array(
            "from" => "<basepath>/files/custom/include/SugarObjects/templates/quick",
            "to" => "custom/include/SugarObjects/templates/quick"
        ),
        array(
            "from" => "<basepath>/files/custom/include/SugarObjects/templates/bare",
            "to" => "custom/include/SugarObjects/templates/bare"
        ),
        array(
            "from" => "<basepath>/files/custom/include/SugarObjects/templates/auto_increment",
            "to" => "custom/include/SugarObjects/templates/auto_increment"
        ),
        array(
            "from" => "<basepath>/files/custom/src/SugarObjects/Traits",
            "to" => "custom/src/SugarObjects/Traits"
        )
    ),
    "id" => "a4da01a2-2ec2-4194-8f00-56cf9cf75c35"
);

