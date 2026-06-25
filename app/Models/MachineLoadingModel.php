<?php

namespace App\Models;

use CodeIgniter\Model;

class MachineLoadingModel extends Model
{
    protected $table = 'machine_loading';

    protected $primaryKey = 'id';

    protected $allowedFields = [

        'machine_id',
        'order_id',
        'qty',
        'start_datetime',
        'end_datetime',
        'status'

    ];
}