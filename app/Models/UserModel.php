<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'oauth_users';
    protected $primaryKey = 'username';
    protected $allowedFields = [
        'username', 'password', 'first_name',
        'last_name', 'email', 'email_verified', 'scope'
    ];
}
