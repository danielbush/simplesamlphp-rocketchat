#!/bin/bash

DIR=$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )

$DIR/make-cert.sh simplesaml
$DIR/make-cert.sh simplesaml
# The simplesaml container assumes these:
cp $DIR/simplesaml.crt $DIR/saml.crt
cp $DIR/simplesaml.pem $DIR/saml.pem
