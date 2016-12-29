<?php

namespace Buckii\LarakitTests\Models;

use Buckii\LarakitTests\LarakitTestCase;
use Buckii\Larakit\Models\Error;
use Exception;
use Illuminate\Http\Request;

class ErrorTest extends LarakitTestCase
{
    public function setUp()
    {
        parent::setUp();

        $e = new Exception('Test Exception');

        $ex = [
            'message' => $e->getMessage(),
            'code' => $e->getCode(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => $e->getTraceAsString(),
        ];

        $this->model = new Error([
            'url' => 'https://test.com/test',
            'method' => 'GET',
            'ips' => ['127.0.0.1'],
            'input' => [],
            'server' => [],
            'headers' => [],
            'cookies' => [],
            'exception' => $ex,
            'user' => [],
        ]);
    }

    public function testSave()
    {
        $this->assertTrue($this->model->save());
    }

    public function testSetException()
    {
        $err = new Error;

        $err->setException(new Exception('A'));

        $this->assertEquals('A', $err->exception['message']);
    }

    public function testLongUrl()
    {
        $url = 'https://test.com/' . str_repeat('long-string/', 100);

        $this->model->url = $url;
        $this->model->save();

        $this->assertEquals($url, $this->model->url);
    }

    public function testSetRequest()
    {
        $request = new Request;
        $err = new Error;

        $err->setRequest($request);

        $this->assertEquals('http://:', $err->url);
        $this->assertEquals('GET', $err->method);
        $this->assertEquals([null], $err->ips);
        $this->assertEquals([], $err->input);
        $this->assertEquals(['REQUEST_URI' => ''], $err->server);
        $this->assertEquals([], $err->headers);
        $this->assertEquals([], $err->cookies);
        $this->assertEquals([], $err->user);
    }

    public function testReport()
    {
        $ex = new Exception('Test');
        $request = new Request;

        $err = Error::report($ex, $request);

        $this->assertInstanceOf(Error::class, $err);
    }
}
