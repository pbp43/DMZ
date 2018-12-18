#!/bin/bash

cd /var/www/html

tar -cvf /var/www/VersionBackups/NewRelease1.0.tar *

cd /var/www/VersionBackups
sudo sshpass -p "123456" scp -r NewRelease1.0.tar sagar@192.168.0.107:/var/www/VersionBackups

exit











