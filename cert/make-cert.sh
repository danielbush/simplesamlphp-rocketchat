#!/bin/bash
DIR=$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )
test -n $1 || { echo "Need name of cert/key ie <name>.{pem,crt}."; exit 1; }
openssl req -x509 -batch -nodes -newkey rsa:2048 -keyout $DIR/$1.pem -out $DIR/$1.crt
