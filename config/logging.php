<?php

return [

    'channels' => [
        'gelf' => [
            'driver' => 'custom',
            'via' => \Hedii\LaravelGelfLogger\GelfLoggerFactory::class,
            'gelf' => true,

            // This optional option determines the processors that should be
            // pushed to the handler. This option is useful to modify a field
            // in the log context (see NullStringProcessor), or to add extra
            // data. Each processor must be a callable or an object with an
            // __invoke method: see monolog documentation about processors.
            // Default is an empty array.
            'processors' => [
                \Hedii\LaravelGelfLogger\Processors\NullStringProcessor::class,
                \LeandroSe\LaravelGelfLogging\Processors\HashProcessor::class,
                // another processor...
            ],
            'level' => env('APP_LOG_LEVEL'),

            // This optional option determines the channel name sent with the
            // message in the 'facility' field. Default is equal to app.env
            // configuration value
            'name' => env('GELF_NAME'),

            // This optional option determines the system name sent with the
            // message in the 'source' field. When forgotten or set to null,
            // the current hostname is used.
            'system_name' => null,

            // This optional option determines if you want the UDP, TCP or HTTP
            // transport for the gelf log messages. Default is UDP
            'transport' => env('GELF_TRANSPORT', 'udp'),

            // This optional option determines the host that will receive the
            // gelf log messages. Default is 127.0.0.1
            'host' => env('GELF_URL'),

            // This optional option determines the port on which the gelf
            // receiver host is listening. Default is 12201
            'port' => env('GELF_PORT'),

            // This optional option determines the path used for the HTTP
            // transport. When forgotten or set to null, default path '/gelf'
            // is used.
            'path' => null,

            // This optional option determines the maximum length per message
            // field. When forgotten or set to null, the default value of
            // \Monolog\Formatter\GelfMessageFormatter::DEFAULT_MAX_LENGTH is
            // used (currently this value is 32766)
            'max_length' => null,

            // This optional option determines the prefix for 'context' fields
            // from the Monolog record. Default is null (no context prefix)
            'context_prefix' => null,

            // This optional option determines the prefix for 'extra' fields
            // from the Monolog record. Default is null (no extra prefix)
            'extra_prefix' => null,
        ],
        'gelf_requests' => [
            'driver' => 'custom',
            'via' => \Hedii\LaravelGelfLogger\GelfLoggerFactory::class,
            'gelf' => true,

            // This optional option determines the processors that should be
            // pushed to the handler. This option is useful to modify a field
            // in the log context (see NullStringProcessor), or to add extra
            // data. Each processor must be a callable or an object with an
            // __invoke method: see monolog documentation about processors.
            // Default is an empty array.
            'processors' => [
                \Hedii\LaravelGelfLogger\Processors\NullStringProcessor::class,
                \LeandroSe\LaravelGelfLogging\Processors\HashProcessor::class,
                // another processor...
            ],
            'level' => env('APP_LOG_LEVEL'),

            // This optional option determines the channel name sent with the
            // message in the 'facility' field. Default is equal to app.env
            // configuration value
            'name' => env('GELF_REQUESTS_NAME', env('GELF_NAME')),

            // This optional option determines the system name sent with the
            // message in the 'source' field. When forgotten or set to null,
            // the current hostname is used.
            'system_name' => null,

            // This optional option determines if you want the UDP, TCP or HTTP
            // transport for the gelf log messages. Default is UDP
            'transport' => env('GELF_REQUESTS_TRANSPORT', env('GELF_TRANSPORT', 'udp')),

            // This optional option determines the host that will receive the
            // gelf log messages. Default is 127.0.0.1
            'host' => env('GELF_REQUESTS_URL', env('GELF_URL')),

            // This optional option determines the port on which the gelf
            // receiver host is listening. Default is 12201
            'port' => env('GELF_REQUESTS_PORT', env('GELF_PORT')),

            // This optional option determines the path used for the HTTP
            // transport. When forgotten or set to null, default path '/gelf'
            // is used.
            'path' => null,

            // This optional option determines the maximum length per message
            // field. When forgotten or set to null, the default value of
            // \Monolog\Formatter\GelfMessageFormatter::DEFAULT_MAX_LENGTH is
            // used (currently this value is 32766)
            'max_length' => null,

            // This optional option determines the prefix for 'context' fields
            // from the Monolog record. Default is null (no context prefix)
            'context_prefix' => null,

            // This optional option determines the prefix for 'extra' fields
            // from the Monolog record. Default is null (no extra prefix)
            'extra_prefix' => null,
        ],
    ],
];
