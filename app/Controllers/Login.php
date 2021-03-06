<?php

namespace App\Controllers;

use \App\Libraries\Oauth;
use \OAuth2\Request;
use CodeIgniter\API\ResponseTrait;

class Login extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        try {
            $oauth = new Oauth();
            $request = new Request();
            $respond = $oauth->server->handleTokenRequest($request->createFromGlobals());
            $code = $respond->getStatusCode();
            $body = $respond->getResponseBody();
            return $this->respond(json_decode($body), $code);
        } catch (\Throwable $th) {
            return $this->failServerError($th);
        }
    }
}
