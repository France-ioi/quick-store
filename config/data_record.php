<?php

// Make sure this values does not exceed database fields possible length

return [
    'key_max_length' => 255,
    'value_max_length' => 1024,
    'expiration_interval' => 'P1W' // format specified at https://www.php.net/manual/en/dateinterval.construct.php
];