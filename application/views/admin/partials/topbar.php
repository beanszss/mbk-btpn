</head>
<body class="skin-black-light sidebar-mini fixed ">
<div class="wrapper">
  <header class="main-header">
    <a href="<?php echo base_url('admin/dashboard') ?> " class="logo">
      <span class="logo-mini"><b>A</b></span>
      <span class="logo-lg"><b>Admin</b> | Cpanel</span>
    </a>
    <nav class="navbar navbar-static-top">
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo base_url()?>assets/backend/dist/img/avatar.png" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $this->session->userdata('full_name') ?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="user-header">
                <img src="<?php echo base_url()?>assets/backend/dist/img/avatar.png" class="img-circle" alt="User Image">

                <p>
                <?php echo $this->session->userdata('full_name') ?>
                  <small> Email : <?php echo $this->session->userdata('email') ?></small>
                </p>
              </li>
              <li class="user-footer">
                <div class="pull-right">
                  <a href="<?php echo base_url('auth/logout') ?>" class="btn btn-default btn-flat">Logout</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- <li>
            <a href="<?php echo base_url('admin/dashboard') ?>" target="_blank"><i class="fa fa-globe"></i> Ke Halaman Utama</a>
          </li> -->
        </ul>
      </div>
    </nav>
  </header>