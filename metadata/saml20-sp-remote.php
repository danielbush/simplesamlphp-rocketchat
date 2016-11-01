<?php

$metadata['http://rocketchat.local/_saml/metadata/test-idp'] = array(
    'AssertionConsumerService' => 'http://rocketchat.local/_saml/validate/test-idp',
    'SingleLogoutService'      => 'http://rocketchat.local/_saml/logout/test-idp',
    'certificate' => 'rocketchat.crt',
    'assertion.encryption' => FALSE,
    'redirect.sign' => TRUE,
    'redirect.validate' => TRUE,
);
