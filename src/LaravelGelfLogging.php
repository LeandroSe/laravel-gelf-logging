<?php

namespace LeandroSe\LaravelGelfLogging;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Log Manager using Gelf.
 * @author LeandroSe <ltsujiguchi@gmail.com>
 * @package LeandroSe\LaravelGelfLogging
 */
class LaravelGelfLogging
{

    /**
     * @param Request $request
     * @param Response $response
     */
    public function request($request, $response)
    {
        $gelf = config(sprintf('logging.channels.%s.gelf', config('logging.default', 'stack')));
        if ($gelf) {
            $params = [];
            if (Auth::user()) {
                $params['auth'] = ['id' => Auth::user()->id, 'username' => Auth::user()->username];
            }
            if ($request->request->count()) {
                $params['request'] = $request->request->all();
            }
            if ($request->query->count()) {
                $params['query'] = $request->query->all();
            }
            $params = array_merge($params, $this->getServer($request), $this->getResponse($request, $response));
            Log::channel('gelf_requests')->info(sprintf(
                '%s %s',
                $request->getMethod(),
                $request->getRequestUri()
            ), $params);
        }
    }

    /**
     * @param Request $request
     * @return array
     */
    private function getServer($request): array
    {
        return [
            'hostname' => $request->server->get('HOSTNAME'),
            'http_user_agent' => $request->server->get('HTTP_USER_AGENT'),
            'http_host' => $request->server->get('HTTP_HOST'),
            'redirect_status' => $request->server->get('REDIRECT_STATUS'),
            'server_name' => $request->server->get('SERVER_NAME'),
            'server_port' => $request->server->get('SERVER_PORT'),
            'server_addr' => $request->server->get('SERVER_ADDR'),
            'remote_port' => $request->server->get('REMOTE_PORT'),
            'remote_addr' => $request->server->get('REMOTE_ADDR'),
            'request_scheme' => $request->server->get('REQUEST_SCHEME'),
            'server_protocol' => $request->server->get('SERVER_PROTOCOL'),
            'request_method' => $request->server->get('REQUEST_METHOD'),
            'request_uri' => $request->server->get('REQUEST_URI'),
            'query_string' => $request->server->get('QUERY_STRING'),
        ];
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return array
     */
    private function getResponse($request, $response): array
    {
        return [
            'response_code' => $response->getStatusCode(),
            'response_time' => (int)(bcsub(microtime(true), $request->server->get('REQUEST_TIME_FLOAT'), 4) * 1000),
            'response_content_type' => $response->headers->get('Content-Type'),
            'response_content_lenght' => strlen($response->getContent()),
        ];
    }
}
