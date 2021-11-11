<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use \App\Libraries\Oauth;
use \OAuth2\Request;
use App\Models\UserModel;



class AdminFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $oauth = new Oauth();
        $request = new Request();
        $token = $oauth->server->getAccessTokenData($request->createFromGlobals());
        $model = new UserModel();
        $user = $model->find($token['user_id']);
        if ($user['type'] != 'admin') {
            $response = service('response');
            $response->setStatusCode(401);
            return $response;
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}
