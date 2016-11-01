#!/bin/bash

cat $1 | sed -e '/CERTIFICATE/d' | tr -d '\n'
