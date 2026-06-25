<?php

namespace App\Controllers;

use App\Models\MachineModel;
use App\Models\MachineLoadingModel;

class DashboardController extends BaseController
{
    /**
     * Auto Update Job & Machine Status
     */
    private function updateMachineStatus()
    {
        $loadingModel = new MachineLoadingModel();
        $machineModel = new MachineModel();

        /*
    |--------------------------------------------------
    | First Reset All Machines
    |--------------------------------------------------
    */

        $db = \Config\Database::connect();

        $db->query("
        UPDATE machines
        SET status='FREE'
    ");

        /*
    |--------------------------------------------------
    | Update Job Status
    |--------------------------------------------------
    */

        $jobs = $loadingModel->findAll();

        foreach ($jobs as $job) {

            $now   = time();
            $start = strtotime($job['start_datetime']);
            $end   = strtotime($job['end_datetime']);

            if ($now < $start) {

                $loadingModel->update(
                    $job['id'],
                    ['status' => 'Pending']
                );
            } elseif ($now >= $start && $now <= $end) {

                $loadingModel->update(
                    $job['id'],
                    ['status' => 'Running']
                );

                $machineModel->update(
                    $job['machine_id'],
                    ['status' => 'BUSY']
                );
            } else {

                $loadingModel->update(
                    $job['id'],
                    ['status' => 'Completed']
                );
            }
        }
    }

    public function index()
    {
        $this->updateMachineStatus();

        $machineModel = new MachineModel();
        $loadingModel = new MachineLoadingModel();

        /*
        |--------------------------------------------------------------------------
        | Dashboard Cards
        |--------------------------------------------------------------------------
        */

        $data['machines'] = $machineModel->countAll();

        $data['runningJobs'] = $loadingModel
            ->where('status', 'Running')
            ->countAllResults();

        $data['completedJobs'] = $loadingModel
            ->where('status', 'Completed')
            ->countAllResults();

        $data['pendingJobs'] = $loadingModel
            ->where('status', 'Pending')
            ->countAllResults();

        $data['freeMachines'] = $machineModel
            ->where('status', 'FREE')
            ->countAllResults();

        $data['busyMachines'] = $machineModel
            ->where('status', 'BUSY')
            ->countAllResults();

        $data['orders'] = 0;

        /*
        |--------------------------------------------------------------------------
        | Live Running Machines
        |--------------------------------------------------------------------------
        */

        $data['liveMachines'] = $loadingModel
            ->select('
                machine_loading.*,
                machines.machine_name
            ')
            ->join(
                'machines',
                'machines.id = machine_loading.machine_id'
            )
            ->where('machine_loading.status', 'Running')
            ->findAll();

        /*
        |--------------------------------------------------------------------------
        | Machine Status Table
        |--------------------------------------------------------------------------
        */

        $machines = $machineModel->findAll();

        foreach ($machines as &$machine) {

            $runningJob = $loadingModel
                ->where('machine_id', $machine['id'])
                ->where('status', 'Running')
                ->first();

            if ($runningJob) {

                $machine['status'] = 'BUSY';

                $machine['qty'] = $runningJob['qty'];

                $machine['available_time']
                    = date(
                        'd-m-Y h:i A',
                        strtotime(
                            $runningJob['end_datetime']
                        )
                    );

                $remainingSeconds =
                    strtotime($runningJob['end_datetime'])
                    - time();

                if ($remainingSeconds < 0) {
                    $remainingSeconds = 0;
                }

                $machine['remaining_time']
                    = gmdate(
                        'H:i:s',
                        $remainingSeconds
                    );
            } else {

                $machine['status'] = 'FREE';
                $machine['qty'] = '-';
                $machine['available_time'] = 'Available Now';
                $machine['remaining_time'] = '-';
            }
        }

        $data['machineStatus'] = $machines;

        /*
        |--------------------------------------------------------------------------
        | Jobs For Gantt
        |--------------------------------------------------------------------------
        */

        $jobs = $loadingModel
            ->select('
                machine_loading.*,
                machines.machine_name
            ')
            ->join(
                'machines',
                'machines.id = machine_loading.machine_id'
            )
            ->findAll();

        $tasks = [];

        foreach ($jobs as $job) {

            if ($job['status'] == 'Completed') {

                $progress = 100;
            } elseif ($job['status'] == 'Running') {

                $start = strtotime(
                    $job['start_datetime']
                );

                $end = strtotime(
                    $job['end_datetime']
                );

                $now = time();

                $total =
                    max(1, $end - $start);

                $elapsed =
                    max(0, $now - $start);

                $progress =
                    min(
                        100,
                        round(
                            ($elapsed / $total) * 100
                        )
                    );
            } else {

                $progress = 0;
            }

            $tasks[] = [

                'id' => 'JOB-' . $job['id'],

                'name' =>
                $job['machine_name']
                    . ' (Qty '
                    . $job['qty']
                    . ')',

                'machine' =>
                $job['machine_name'],

                'qty' =>
                $job['qty'],

                'status' =>
                $job['status'],

                'start' =>
                date(
                    'Y-m-d H:i',
                    strtotime(
                        $job['start_datetime']
                    )
                ),

                'end' =>
                date(
                    'Y-m-d H:i',
                    strtotime(
                        $job['end_datetime']
                    )
                ),

                'progress' =>
                $progress,

                'custom_class' =>
                $job['status'] === 'Running'
                    ? 'bar-running'
                    : (
                        $job['status'] === 'Pending'
                        ? 'bar-pending'
                        : 'bar-completed'
                    )
            ];
        }

        $data['tasks'] = $tasks;

        return view(
            'dashboard/index',
            $data
        );
    }
}
