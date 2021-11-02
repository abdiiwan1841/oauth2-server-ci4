<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;

class Register extends BaseController
{

    protected $format = 'json';
    use ResponseTrait;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        try {
            $rules = [
                'username' => 'required|is_unique[oauth_users.username]',
                'password' => 'required',
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required',
                'email_verified' => 'required'
            ];
            if (!$this->validate($rules)) {
                return $this->fail($this->validator->getErrors());
            }
            $data = [
                'username' => $this->request->getVar('username'),
                'password' => sha1($this->request->getVar('password')),
                'first_name' => $this->request->getVar('first_name'),
                'last_name' => $this->request->getVar('last_name'),
                'email' => $this->request->getVar('email'),
                'email_verified' => $this->request->getVar('email_verified'),
                'scope' => 'app'
            ];
            $model = new UserModel();
            $response = $model->insert($data);

            return $this->respondCreated($response);
        } catch (\Throwable $th) {
            return $this->failServerError($th);
        }
    }
}
