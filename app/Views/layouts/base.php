<!doctype html>
<html lang="en">

<head>

  <meta charset="utf-8">
<base href="http://localhost/MLoad/">
  <title>MLoad - Machine Loading System</title>

  <meta name="title" content="MLoad | Machine Loading Dashboard">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
  <meta name="author" content="MLoad">

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Fonts -->
  <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
    crossorigin="anonymous">

  <!-- Select2 -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">

  <!-- Overlay Scrollbar -->
  <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css">

  <!-- Bootstrap Icons -->
  <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

  <!-- Font Awesome -->
  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">

  <!-- AdminLTE -->
  <link rel="stylesheet"
    href="<?= base_url('assets/dist/css/adminlte.css') ?>">

  <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/frappe-gantt/dist/frappe-gantt.css">

  <script src="https://cdn.jsdelivr.net/npm/frappe-gantt/dist/frappe-gantt.umd.js"></script>
  <!-- Apex Charts -->
  <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css">

  <!-- JS Vector Map -->
  <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/css/jsvectormap.min.css">

  <!-- DataTables -->
  <link rel="stylesheet"
    href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">

  <link rel="stylesheet"
    href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css">

  <!-- Full Calendar -->
  <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.css" rel="stylesheet">

  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>

  <style>
    html,
    body {
      overflow-x: hidden !important;
      background: #f4f7fb;
    }

    .app-wrapper {
      overflow-x: hidden;
    }

    .app-sidebar {
      width: 260px;
    }

    .app-header {
      position: fixed;
      top: 0;
      left: 260px;
      right: 0;
      height: 60px;
      z-index: 1030;
    }

    .app-main {
      margin-top: 60px;
      margin-left: 260px;
      padding: 20px;
      width: calc(100% - 260px);
      min-height: calc(100vh - 60px);
      background: #f4f7fb;
    }

    @media (max-width:768px) {

      .app-header {
        left: 0;
      }

      .app-main {
        margin-left: 0;
        width: 100%;
      }
    }

    .small-box {
      border: none;
      border-radius: 18px;
      overflow: hidden;
      color: #fff;
      transition: .3s;
      box-shadow: 0 5px 20px rgba(0, 0, 0, .08);
    }

    .small-box:hover {
      transform: translateY(-5px);
    }

    .small-box .inner {
      padding: 20px;
    }

    .small-box h2 {
      font-size: 32px;
      font-weight: 700;
      margin-bottom: 5px;
    }

    .small-box p {
      margin: 0;
      font-size: 15px;
    }

    .bg-machine {
      background: linear-gradient(135deg, #2563eb, #3b82f6);
    }

    .bg-order {
      background: linear-gradient(135deg, #059669, #10b981);
    }

    .bg-running {
      background: linear-gradient(135deg, #d97706, #f59e0b);
    }

    .bg-completed {
      background: linear-gradient(135deg, #7c3aed, #8b5cf6);
    }

    .dashboard-title {
      font-weight: 700;
      color: #111827;
    }

    .card {
      border: none;
      border-radius: 16px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, .05);
    }

    .card-header {
      background: #fff;
      border-bottom: 1px solid #edf2f7;
      font-weight: 600;
    }

    .table thead th {
      background: #1f2937;
      color: #fff;
      border: none;
    }

    .table tbody tr:hover {
      background: #f8fafc;
    }

    .badge {
      padding: 8px 10px;
      font-size: 12px;
      font-weight: 500;
    }

    .dataTables_wrapper .dt-buttons .btn {
      margin-right: 5px;
    }

    .dataTables_filter input,
    .dataTables_length select {
      border-radius: 8px !important;
    }
  </style>

</head>

<body class="layout-fixed sidebar-expand-lg sidebar-open">

  <div class="app-wrapper">

    <?= $this->include('layouts/header'); ?>

    <?= $this->include('layouts/sidebar'); ?>

    <main class="app-main">

      <?= $this->renderSection('dashboard'); ?>

      <?= $this->renderSection('content'); ?>

    </main>

    <?= $this->include('layouts/footer'); ?>

  </div>

  <?= $this->include('layouts/cdnscript'); ?>

  <?= $this->include('layouts/jscripts'); ?>

  <?= $this->renderSection('jscript'); ?>

  <?= $this->renderSection('custom'); ?>

  <!-- Frappe Gantt Local JS -->


</body>

</html>