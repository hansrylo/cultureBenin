<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Default Hash Driver
    |--------------------------------------------------------------------------
    |
    | This option controls the default hash driver that will be used to hash
    | passwords for your application. By default, the bcrypt algorithm is
    | used; however, you may also use the argon algorithm provided by the
    | PHP password_hash function.
    |
    */
    'driver' => 'bcrypt',

    /*
    |--------------------------------------------------------------------------
    | Bcrypt Options
    |--------------------------------------------------------------------------
    |
    | Here you may specify the amount of rounds that should be used when
    | hashing passwords using the Bcrypt algorithm. The more rounds you
    | specify, the more secure the hash will be, but the slower it will be.
    |
    */
    'bcrypt' => [
        'rounds' => 12,
    ],

    /*
    |--------------------------------------------------------------------------
    | Argon Options
    |--------------------------------------------------------------------------
    |
    | Here you may configure the Argon hashing algorithm, which provides a
    | memory-hard hashing algorithm. You may adjust the memory usage, number
    | of threads, and time cost.
    |
    */
    'argon' => [
        'memory' => 1024,
        'threads' => 2,
        'time' => 2,
    ],
];
