<?php

namespace LeandroSe\LaravelGelfLogging\Tests;

use Illuminate\Http\Request;
use LaravelGelfLogging;
use Monolog\Handler\TestHandler;
use Monolog\Logger;
use Tests\TestCase;

class GelfTest extends TestCase
{

    /**
     * @group gelf
     * @group LaravelGelfLogging
     */
    public function testMockingRunRequest()
    {
        LaravelGelfLogging::shouldReceive('request')
            ->andReturns(1, 2, 3, 4);

        $request = Request::create('/api');
        $response = response('s');

        $call1 = LaravelGelfLogging::request($request, $response);
        $this->assertEquals(1, $call1);

        $call2 = LaravelGelfLogging::request($request, $response);
        $this->assertEquals(2, $call2);

        $call3 = LaravelGelfLogging::request($request, $response);
        $this->assertEquals(3, $call3);

        $call4 = LaravelGelfLogging::request($request, $response);
        $this->assertEquals(4, $call4);
    }

    /**
     * @group gelf
     * @group LaravelGelfLogging
     */
    public function testLogging()
    {
        $testHandler = new TestHandler();
        config([
            'logging.default' => 'gelf',
            'logging.channels' => [
                'gelf' => [
                    'driver' => 'custom',
                    'gelf' => true,
                    'via' => function () use ($testHandler) {
                        $monolog = new Logger('test');
                        $monolog->pushHandler($testHandler);
                        return $monolog;
                    },
                ],
                'gelf_requests' => [
                    'driver' => 'custom',
                    'gelf' => true,
                    'via' => function () use ($testHandler) {
                        $monolog = new Logger('test');
                        $monolog->pushHandler($testHandler);
                        return $monolog;
                    },
                ],
            ],
        ]);
        $this->assertFalse($testHandler->hasRecords(Logger::INFO));

        $request = Request::create('/api');
        $response = response('s');

        LaravelGelfLogging::request($request, $response);

        $this->assertTrue($testHandler->hasRecords(Logger::INFO));
        $this->assertTrue($testHandler->hasInfoThatContains('GET /api'));
    }
}
