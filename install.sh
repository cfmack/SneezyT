#!/bin/bash

ZIPFILE="sneezy."$RANDOM".tar.gz"
mv ~/builds/sneezy.tar.gz ~/builds/$ZIPFILE
tar -zxvf ~/builds/$ZIPFILE -C ~/webapps/sneezyt/

