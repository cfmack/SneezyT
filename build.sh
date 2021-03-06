#!/bin/bash

ZIPFILE="sneezy.tar.gz"

cd /home/cmack
rm -Rf temp_copy
mkdir temp_copy
cp -Rf SneezyT/* temp_copy/
rm -Rf temp_copy/ddl
rm -Rf temp_copy/r
rm -Rf temp_copy/user_guide
rm -Rf SneezyT/application/logs/*.*
rm -Rf temp_copy/.git
rm -Rf temp_copy/.idea
rm -Rf temp_copy/.gitignore
rm -Rf temp_copy/build.sh
rm -Rf temp_copy/build.sh~
rm -Rf temp_copy/install.sh
rm -Rf temp_copy/install.sh~
mv temp_copy/index.php temp_copy/index.php.temp
mv temp_copy/application/config/database.php temp_copy/application/config/database.php.temp
mv temp_copy/application/config/config.php temp_copy/application/config/config.php.temp
cd temp_copy
tar -zcvf ../$ZIPFILE ./
cd ..
rm -Rf temp_copy
scp $ZIPFILE $1:~/builds
rm -f $ZIPFILE
ssh $1 "~/install.sh"
