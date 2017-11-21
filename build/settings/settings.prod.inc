<?php

/**
 * @file
 * Include prod-only settings here.
 */

$settings['config_readonly'] = TRUE;
$settings['trusted_host_patterns'] = [
  '^datasets\.lib\.unb\.ca$',
  '^127\.0\.0\.1$',
];
