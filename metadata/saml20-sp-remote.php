<?php

$metadata['http://gemini:3000/_saml/metadata/catalyst-idp'] = array(
    'AssertionConsumerService' => 'http://gemini:3000/_saml/validate/catalyst-idp',
    // Not sure if logout url is provided:
    'SingleLogoutService'      => 'http://gemini:3000/_saml/logout/catalyst-idp',
    'assertion.encryption' => FALSE,
    'certificate' => 'gemini.crt',
    'redirect.sign' => FALSE,
    'redirect.validate' => TRUE,
);
