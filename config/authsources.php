<?php

$config = array(

    // This is a authentication source which handles admin authentication.
    'admin' => array(
        // The default is to use core:AdminPassword, but it can be replaced with
        // any authentication source.
        'core:AdminPassword',
    ),

    'example-userpass' => array(
        'exampleauth:UserPass',
        'student:studentpass' => array(
            'uid' => array('student'),
            'email' => array('student@example.com'),
            'eduPersonAffiliation' => array('member', 'student'),
        ),
        'employee:employeepass' => array(
            'uid' => array('employee'),
            'email' => array('employee@example.com'),
            'eduPersonAffiliation' => array('member', 'employee'),
        ),
    ),
);

