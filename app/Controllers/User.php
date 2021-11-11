<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use \OAuth2\Request;
use \App\Libraries\Oauth;

class User extends ResourceController
{

    protected $modelName = 'App\Models\UserModel';
    protected $format = 'json';

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        try {
            $oauth = new Oauth();
            $request = new Request();
            $token = $oauth->server->getAccessTokenData($request->createFromGlobals());
            $response = $this->model->find($token['user_id']);
            return $this->respond($response);
        } catch (\Throwable $th) {
            return $this->failServerError($th);
        }
    }

    public function create()
    {
        try {
            return $this->respondNoContent();
        } catch (\Throwable $th) {
            return $this->failServerError($th);
        }
        return $this->failServerError($th);
    }

    public function show($id = null)
    {
        try {
            return $this->respondNoContent();
        } catch (\Throwable $th) {
            return $this->failServerError($th);
        }
        return $this->failServerError($th);
    }

    public function update($id = null)
    {
        try {
            return $this->respondNoContent();
        } catch (\Throwable $th) {
            return $this->failServerError($th);
        }
        return $this->failServerError($th);
    }

    public function delete($id = null)
    {
        try {
            return $this->respondNoContent();
        } catch (\Throwable $th) {
            return $this->failServerError($th);
        }
        return $this->failServerError($th);
    }
}
