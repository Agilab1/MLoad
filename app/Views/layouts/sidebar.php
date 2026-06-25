<style>
  :root {
    --sidebar-bg: #111827;
    --sidebar-gradient: linear-gradient(180deg,
        #1f2937 0%,
        #111827 100%);

    --sidebar-active: #2563eb;
    --sidebar-hover: rgba(255, 255, 255, .05);
    --sidebar-text: #94a3b8;
    --sidebar-text-bright: #ffffff;
    --sidebar-border: rgba(255, 255, 255, .08);
  }

  .app-sidebar {
    position: fixed !important;
    top: 0;
    left: 0;
    bottom: 0;
    width: 260px;
    background: var(--sidebar-gradient) !important;
    border-right: 1px solid var(--sidebar-border);
    z-index: 1030;
    display: flex;
    flex-direction: column;
  }

  /* Logo */


  .sidebar-brand {
    width: 100%;
    padding: 15px 10px;
    border-bottom: 1px solid rgba(255, 255, 255, .05);
    display: flex;
    justify-content: center;
  }

  .brand-link {
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    text-decoration: none;
  }

  .sidebar-logo {
    width: 240px !important;
    height: auto !important;
    object-fit: contain;
    display: block;
    border-radius: 8px; 
  }

  /* Content */

  .sidebar-content {
    flex-grow: 1;
    padding: 15px;
    overflow-y: auto;
  }

  .sidebar-content::-webkit-scrollbar {
    width: 4px;
  }

  .sidebar-content::-webkit-scrollbar-thumb {
    background: rgba(255, 255, 255, .12);
    border-radius: 20px;
  }

  /* Menu */

  .nav-link {
    border-radius: 10px !important;
    margin-bottom: 6px;
    color: var(--sidebar-text) !important;
    padding: 12px 15px !important;
    font-size: 14px;
    font-weight: 500;
    transition: .25s;
  }

  .nav-link:hover {
    background: var(--sidebar-hover);
    color: #fff !important;
  }

  .nav-link.active {
    background: var(--sidebar-active) !important;
    color: #fff !important;
    box-shadow: 0 4px 15px rgba(37, 99, 235, .35);
  }

  .nav-link i {
    width: 20px;
  }

  /* Bottom Card */

  .user-profile-bottom {
    margin: 15px;
    padding: 14px;
    border-radius: 12px;
    background: rgba(255, 255, 255, .03);
    border: 1px solid var(--sidebar-border);
  }

  .user-profile-bottom p {
    margin: 0;
    color: #fff;
    font-weight: 600;
    font-size: 14px;
  }

  .user-profile-bottom small {
    color: #94a3b8;
    font-size: 12px;
  }
</style>

<aside class="app-sidebar shadow" data-bs-theme="dark">

  <!-- Logo -->

  <div class="sidebar-brand">
    <a href="<?= base_url('dashboard'); ?>" class="brand-link">
      <img
        src="/MLoad/public/assets/dist/assets/img/MLoad.png"
        alt="MLoad Logo"
        class="sidebar-logo">
    </a>
  </div>

  <!-- Menu -->

  <div class="sidebar-content">

    <?= $this->include('layouts/sidemenu'); ?>

  </div>

  <!-- Bottom Info -->

  <div class="user-profile-bottom">

    <p>MLoad ERP</p>

    <small>
      Machine Loading Monitoring System
    </small>

  </div>

</aside>