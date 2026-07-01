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
        $qty       = $this->request->getPost('qty');

        $lastJob = $loadingModel
            ->where('machine_id', $machineId)
            ->orderBy('end_datetime', 'DESC')
            ->first();

        if ($lastJob) {

            if (strtotime($lastJob['end_datetime']) > time()) {

                $start  = $lastJob['end_datetime'];
                $status = 'Pending';
            } else {

                $start  = date('Y-m-d H:i:s');
                $status = 'Running';

                $machineModel->update($machineId, [
                    'status' => 'BUSY'
                ]);
            }
        } else {

            $start  = date('Y-m-d H:i:s');
            $status = 'Running';

            $machineModel->update($machineId, [
                'status' => 'BUSY'
            ]);
        }


        $end = date(
            'Y-m-d H:i:s',
            strtotime($start . ' +8 hours')
        );

        $loadingModel->insert([

            'machine_id'     => $machineId,
            'qty'            => $qty,
            'start_datetime' => $start,
            'end_datetime'   => $end,
            'status'         => $status

        ]);

        return redirect()->to('/');
    }
}
