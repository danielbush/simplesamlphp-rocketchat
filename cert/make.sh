#!/bin/bash
test -n $1 || { echo "Need name of cert/key ie <name>.{pem,crt}."; exit 1; }
openssl req -x509 -batch -nodes -newkey rsa:2048 -keyout ./$1.pem -out ./$1.crt
