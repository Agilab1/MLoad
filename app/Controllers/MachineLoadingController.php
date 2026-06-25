<?php

namespace App\Controllers;

use App\Models\MachineModel;
use App\Models\MachineLoadingModel;

class MachineLoadingController extends BaseController
{
    public function create()
    {
        $machineModel = new MachineModel();

        $data['machines'] = $machineModel->findAll();

        return view('machine_loading/create', $data);
    }

    public function store()
    {
        $machineModel = new MachineModel();
        $loadingModel = new MachineLoadingModel();

        $machineId = $this->request->getPost('machine_id');
        $qty = $this->request->getPost('qty');

        $start = date('Y-m-d H:i:s');

        // Demo logic
        $minutes = $qty * 20;

        $end = date(
            'Y-m-d H:i:s',
            strtotime("+{$minutes} minutes")
        );

        $loadingModel->insert([
            'machine_id' => $machineId,
            'order_id' => null,
            'qty' => $qty,
            'start_datetime' => $start,
            'end_datetime' => $end,
            'status' => 'Running'
        ]);

        $machineModel->update(
            $machineId,
            [
                'status' => 'BUSY'
            ]
        );

        return redirect()->to('/');
    }
}
