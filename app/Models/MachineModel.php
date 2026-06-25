<?php

namespace App\Models;

use CodeIgniter\Model;

class MachineModel extends Model
{
    protected $table = 'machines';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'machine_code',
        'machine_name',
        'machine_type',
        'status'
    ];
}