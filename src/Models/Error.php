<?php

namespace Buckii\Larakit\Models;

use Exception;
use Illuminate\Http\Request;

class Error extends Model
{
    protected $table = "errors";

    protected $fillable = [
        'url',
        'method',
        'ips',
        'input',
        'server',
        'headers',
        'cookies',
        'request',
        'user',
        'exception',
    ];

    protected $casts = [
        'ips' => 'array',
        'input' => 'array',
        'server' => 'array',
        'headers' => 'array',
        'cookies' => 'array',
        'exception' => 'array',
        'user' => 'array',
    ];

    public function setException(Exception $e)
    {
        $ex = [
            'message' => $e->getMessage(),
            'code' => $e->getCode(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => $e->getTraceAsString(),
        ];

        $this->exception = $ex;
    }

    public function setRequest(Request $request)
    {
        $this->url = $request->fullUrl();
        $this->method = $request->method();
        $this->ips = $request->ips();
        $this->input = $request->all();
        $this->server = $request->server->all();
        $this->headers = $request->headers->all();
        $this->cookies = $request->cookies->all();
        $this->user = (empty($request->user())) ? [] : $request->user()->toArray();
    }

    public static function report(Exception $ex, Request $request): self
    {
        $err = new static;

        $err->setRequest($request);
        $err->setException($ex);

        $err->save();

        return $err;
    }
}
