<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'tbl_user';
    protected $primaryKey = 'email';
    protected $allowedFields = [
        'email', 'phone', 'type'
    ];
}
