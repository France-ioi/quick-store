<?php

// Make sure this values does not exceed database fields possible length

return [
    'key_max_length' => 255,
    'value_max_length' => 1024,

    // interval format specified at https://www.php.net/manual/en/dateinterval.construct.php
    'key_expiration_interval' => 'P1W',
    'prefix_expiration_interval' => 'P2M',
];