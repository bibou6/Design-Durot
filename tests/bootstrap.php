<?php

//Cleear cache
//passthru('php '. __DIR__. '/../bin/console ca:cl');
passthru('echo "Initiating Database for tests\n"');
//Creates Database
passthru('php '. __DIR__. '/../bin/console doc:database:create --quiet');

//Cleaning the database
passthru('php '. __DIR__. '/../bin/console doc:schema:drop -f --quiet');
// Create/update tables
passthru('php '. __DIR__. '/../bin/console doc:schema:update -f --quiet');

passthru('echo "Purging and adding data into database\n"');
passthru('php '. __DIR__. '/../bin/console doctrine:fixtures:load --no-interaction --quiet');

passthru('echo "Adding admin user into Database\n"');
passthru('php '. __DIR__. '/../bin/console fos:user:create admin admin@admin.com admin ');

passthru('echo "Starting to run tests...\n"');
require __DIR__.'/../vendor/autoload.php';