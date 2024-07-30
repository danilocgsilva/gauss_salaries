#!/bin/bash

service apache2 start
composer install -d /var/www

while : ; do sleep 1000; done
