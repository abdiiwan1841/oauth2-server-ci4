<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use \OAuth2\Request;
use \App\Libraries\Oauth;

class Users extends ResourceController
{

    protected $modelName = 'App\Models\UserModel';
    protected $format = 'json';

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        // TODO!
    }

    public function create()
    {
        // TODO!
    }

    public function show($id = null)
    {
        // TODO!
    }

    public function update($id = null)
    {
        // TODO!
    }

    public function delete($id = null)
    {
        // TODO!
    }

    public function me()
    {
        try {
            $oauth = new Oauth();
            $request = new Request();
            $token = $oauth->server->getAccessTokenData($request->createFromGlobals());
            $id = $this->model->find($token['user_id']);
            return $this->respond($this->model->where('id', $id)->first());
        } catch (\Throwable $th) {
            return $this->failServerError($th);
        }
    }
}
