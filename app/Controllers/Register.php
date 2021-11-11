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
                'email' => 'required|is_unique[tbl_user.email]',
                'password' => 'required',
                'phone' => 'phone',
                'type' => 'required',

            ];
            if (!$this->validate($rules)) {
                return $this->fail($this->validator->getErrors());
            }
            $user = [
                'email' => $this->request->getVar('email'),
                'password' => sha1($this->request->getVar('password')),
                'phone' => $this->request->getVar('phone'),
                'type' => $this->request->getVar('type')
            ];
            $oauth_user = [
                'username' => $user['email'],
                'password' => $user['password'],
                'scope' => 'app'
            ];
            $model = new UserModel();
            $response = $model->insert($user);

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
}
