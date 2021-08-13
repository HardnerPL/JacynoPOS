#!/bin/bash

composer install

cp application/config/config.php.dist application/config/config.php
cp application/config/database.php.dist application/config/database.php

docker-php-entrypoint apache2-foreground
