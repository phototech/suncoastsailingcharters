<?php

/**
 * @file
 * Drush aliases.
 */

$aliases['local'] = [
  'uri' => 'sailvenice.loc',
];

$aliases['dev'] = [
  'root' => '/home/phototech/sites/sailvenice_dev/web',
  'uri' => 'dev.sailvenice.com',
  'remote-host' => 'origin.sailvenice.com',
  'remote-user' => 'phototech',
  'path-aliases' => [
    '%drush-script' => '/home/phototech/sites/sailvenice_dev/vendor/bin/drush',
  ],
];
