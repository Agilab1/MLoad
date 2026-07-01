<?= $this->extend('layouts/base') ?>

<?= $this->section('content') ?>

<style>
    #gantt {
        width: 100%;
        min-height: 700px;
        background: #fff;
        border-radius: 10px;
        padding: 10px;
        overflow-y: auto;
        overflow-x: hidden;
    }

    #gantt svg {
        background: #fff !important;
    }

    .small-box {
        border-radius: 12px;
        color: #fff;
        box-shadow: 0 4px 12px rgba(0, 0, 0, .08);
    }

    .bg-machine {
        background: #0d6efd;
    }

    .bg-order {
        background: #6f42c1;
    }

    .bg-free {
        background: #20c997;
    }

    .bg-busy {
        background: #dc3545;
    }

    .bg-running {
        background: #198754;
    }

    .bg-completed {
        background: #fd7e14;
    }

    .card {
        border: 0;
        border-radius: 15px;
    }

    .table th {
        background: #1f2937;
        color: #fff;
    }

    .bar-running .bar {
        fill: #dc3545 !important;
        stroke: #dc3545 !important;
    }

    .bar-pending .bar {
        fill: #ffc107 !important;
        stroke: #ffc107 !important;
    }

    .bar-completed .bar {
        fill: #198754 !important;
        stroke: #198754 !important;
    }
</style>

<div class="container-fluid">

    <!-- Dashboard Cards -->
    <div class="row mb-4">

        <div class="col-md-2">
            <div class="small-box bg-machine p-4">
                <h2><?= $machines ?? 0 ?></h2>
                <p>Total Machines</p>
            </div>
        </div>

        <div class="col-md-2">
            <div class="small-box bg-order p-4">
                <h2><?= $orders ?? 0 ?></h2>
                <p>Total Orders</p>
            </div>
        </div>

        <div class="col-md-2">
            <div class="small-box bg-free p-4">
                <h2><?= $freeMachines ?? 0 ?></h2>
                <p>Free Machines</p>
            </div>
        </div>

        <div class="col-md-2">
            <div class="small-box bg-busy p-4">
                <h2><?= $busyMachines ?? 0 ?></h2>
                <p>Busy Machines</p>
            </div>
        </div>

        <div class="col-md-2">
            <div class="small-box bg-running p-4">
                <h2><?= $runningJobs ?? 0 ?></h2>
                <p>Running Jobs</p>
            </div>
        </div>

        <div class="col-md-2">
            <div class="small-box bg-completed p-4">
                <h2><?= $completedJobs ?? 0 ?></h2>
                <p>Completed Jobs</p>
            </div>
        </div>

    </div>

    <!-- Machine Live Status -->
    <div class="card shadow mb-4">

        <div class="card-header">
            <h4 class="mb-0">Machine Live Status</h4>
        </div>

        <div class="card-body">

            <table class="table table-bordered table-striped">

                <thead>
                    <tr>
                        <th>Machine</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Qty</th>
                        <th>Available At </th>
                        <th>Remaining Time</th>
                    </tr>
                </thead>

                <tbody>

                    <?php if (!empty($machineStatus)): ?>

                        <?php foreach ($machineStatus as $machine): ?>

                            <tr>

                                <td><?= esc($machine['machine_name']) ?></td>

                                <td><?= esc($machine['machine_type']) ?></td>

                                <td>

                                    <?php if ($machine['status'] == 'BUSY'): ?>

                                        <span class="badge bg-danger">
                                            BUSY
                                        </span>

                                    <?php else: ?>

                                        <span class="badge bg-success">
                                            FREE
                                        </span>

                                    <?php endif; ?>

                                </td>

                                <td><?= $machine['qty'] ?? '-' ?></td>

                                <td><?= $machine['available_time'] ?? 'Available Now' ?></td>

                                <td>
                                    <?php if ($machine['status'] == 'BUSY'): ?>

                                        <span class="remaining"
                                            data-seconds="<?= $machine['remaining_seconds'] ?>">
                                            <?= $machine['remaining_time'] ?>
                                        </span>

                                    <?php else: ?>

                                        -

                                    <?php endif; ?>
                                </td>

                            </tr>

                        <?php endforeach; ?>

                    <?php else: ?>

                        <tr>
                            <td colspan="6" class="text-center">
                                No Machine Found
                            </td>
                        </tr>

                    <?php endif; ?>

                </tbody>

            </table>

        </div>

    </div>
    <div class="card shadow mb-4">
        <div class="card-header">
            <h4>Add New Job</h4>
        </div>

        <div class="card-body">

            <form action="<?= base_url('machine-loading/store') ?>" method="post">

                <div class="row">

                    <div class="col-md-5">

                        <label>Machine</label>

                        <select name="machine_id" class="form-control" required>

                            <?php foreach ($machinesList as $machine): ?>

                                <option value="<?= $machine['id'] ?>">
                                    <?= esc($machine['machine_name']) ?>
                                </option>

                            <?php endforeach; ?>

                        </select>

                    </div>

                    <div class="col-md-5">

                        <label>Quantity</label>

                        <input
                            type="number"
                            name="qty"
                            class="form-control"
                            required>

                    </div>

                    <div class="col-md-2 d-flex align-items-end">

                        <button class="btn btn-primary w-100">
                            Start Job
                        </button>

                    </div>

                </div>

            </form>

        </div>
    </div>

    <!-- Gantt Chart -->
    <div class="card shadow">

        <div class="card-header">
            <h4 class="mb-0">
                Machine Loading Gantt Chart
            </h4>
        </div>

        <div class="card-body">

            <div class="mb-3">

                <span class="badge bg-danger">
                    Running
                </span>

                <span class="badge bg-warning text-dark">
                    Pending
                </span>

                <span class="badge bg-success">
                    Completed
                </span>

            </div>

            <div id="gantt"></div>

        </div>

    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        const tasks = <?= json_encode($tasks ?? []) ?>;

        if (typeof Gantt === 'undefined') {

            document.getElementById('gantt').innerHTML =
                '<div class="alert alert-danger">Frappe Gantt Not Loaded</div>';

            return;
        }

        if (!tasks.length) {

            document.getElementById('gantt').innerHTML =
                '<div class="alert alert-warning">No Machine Loading Data Found</div>';

            return;
        }

        try {

            new Gantt('#gantt', tasks, {

                view_mode: 'Hour',

                bar_height: 45,

                column_width: 60,

                popup_trigger: 'click',

                custom_popup_html: function(task) {

                    return `
                <div style="padding:15px;min-width:320px">

                    <h5>${task.machine ?? task.name}</h5>

                    <hr>

                    <b>Quantity :</b>
                    ${task.qty ?? '-'}
                    <br><br>

                    <b>Status :</b>
                    ${task.status ?? '-'}
                    <br><br>

                    <b>Start :</b><br>
                    ${task.start}
                    <br><br>

                    <b>End :</b><br>
                    ${task.end}
                    <br><br>

                    <b>Progress :</b>
                    ${task.progress}%

                </div>
                `;
                }
            });
            setInterval(function() {

                document.querySelectorAll(".remaining").forEach(function(el) {

                    let sec = parseInt(el.dataset.seconds);

                    if (sec > 0) {

                        sec--;

                        el.dataset.seconds = sec;

                        let h = Math.floor(sec / 3600);
                        let m = Math.floor((sec % 3600) / 60);
                        let s = sec % 60;

                        el.innerHTML =
                            String(h).padStart(2, '0') + ":" +
                            String(m).padStart(2, '0') + ":" +
                            String(s).padStart(2, '0');

                    } else {

                        el.innerHTML = "00:00:00";

                        location.reload();
                    }

                });

            }, 1000);

        } catch (error) {

            console.error(error);

            document.getElementById('gantt').innerHTML =
                '<div class="alert alert-danger">' +
                error.message +
                '</div>';
        }
        setInterval(function() {

            document.querySelectorAll(".remaining").forEach(function(e) {

                let sec = parseInt(e.dataset.sec);

                if (sec > 0) {

                    sec--;

                    e.dataset.sec = sec;

                    let h = Math.floor(sec / 3600);

                    let m = Math.floor((sec % 3600) / 60);

                    let s = sec % 60;

                    e.innerHTML =

                        String(h).padStart(2, '0') + ":"

                        +
                        String(m).padStart(2, '0') + ":"

                        +
                        String(s).padStart(2, '0');

                }

            });

        }, 1000);

    });
</script>

<?= $this->endSection() ?>