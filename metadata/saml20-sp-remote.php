<?php

$metadata['http://sp/_saml/metadata/test-idp'] = array(
    'AssertionConsumerService' => 'http://rocketchat/_saml/validate/test-idp',
    'SingleLogoutService'      => 'http://rocketchat/_saml/logout/test-idp',
    'certificate' => 'rocketchat.crt',
    'assertion.encryption' => FALSE,
    'redirect.sign' => TRUE,
    'redirect.validate' => TRUE,
);
