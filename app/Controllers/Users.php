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
        try {
            return $this->respond($this->model->findAll());
        } catch (\Throwable $th) {
            return $this->failServerError($th);
        }
    }

    public function create()
    {
        try {
            helper(['form']);
            $rules = [
                'email' => 'required|valid_email|is_unique[tbl_user.email]',
                'password' => 'required',
                'phone' => 'permit_empty'

            ];
            if (!$this->validate($rules)) {
                return $this->fail($this->validator->getErrors());
            }
            $user = [
                'email' => $this->request->getVar('email'),
                'password' => sha1($this->request->getVar('password')),
                'phone' => $this->request->getVar('phone')
            ];
            $oauth_user = [
                'username' => $user['email'],
                'password' => $user['password'],
                'scope' => 'app'
            ];
            $response = $this->model->insert($user);
            $builder = $this->db->table('oauth_users');
            $query = $builder->insert($oauth_user);

            if (!$response) {
                return $this->failServerError($response);
            }
            if (!$query) {
                return $this->failServerError($query);
            }
            return $this->respondCreated($response);
        } catch (\Throwable $th) {
            return $this->failServerError($th);
        }
    }

    public function show($id = null)
    {
        try {
            return $this->respond($this->model->find($id));
        } catch (\Throwable $th) {
            return $this->failServerError($th);
        }
    }

    public function update($id = null)
    {
        try {
            helper(['form']);
            $rules = [
                'email' => 'required|valid_email|is_unique[tbl_user.email,tbl_user.id, ' . $id . ']',
                'phone' => 'permit_empty',
                'password' => 'required',
            ];
            if (!$this->validate($rules)) {
                return $this->fail($this->validator->getErrors());
            }
            $user = $this->model->find($id);
            $update = [
                'email' => $this->request->getVar('email'),
                'phone' => $this->request->getVar('phone'),
                'password' => sha1($this->request->getVar('password')),
            ];
            $oauth_user = [
                'username' => $user['email'],
                'password' => $user['password']
            ];
            $response = $this->model->update($id, $update);
            $builder = $this->db->table('oauth_users');
            $builder->where('username', $user['email']);
            $query = $builder->update($oauth_user);
            if (!$response) {
                return $this->failServerError($response);
            }
            if (!$query) {
                return $this->failServerError($query);
            }
            return $this->respond($response);
        } catch (\Throwable $th) {
            return $this->failServerError($th);
        }
    }

    public function delete($id = null)
    {
        try {
            return $this->respondDeleted($this->model->delete($id));
        } catch (\Throwable $th) {
            return $this->failServerError($th);
        }
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
