<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

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
