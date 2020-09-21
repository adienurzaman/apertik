<?php $module = $_GET['module']; ?>



<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->

    <section class="sidebar">

      <!-- Sidebar user panel -->

      <div class="user-panel">

        <div class="pull-left image">

          <img src="../assets/images/avatar5.png" class="img-circle" alt="User Image">

        </div>

        <div class="pull-left info">

          <p>Administrator

          </p>

          <a href="#"><i class="fa fa-circle text-success"></i>ADMIN</a>

        </div>

      </div>

 

      <ul class="sidebar-menu" data-widget="tree">



        <li class="header">Navigasi</li>

      <?php if($_SESSION['leveluser'] == 'Pemilik') { ?>

        <li class="<?php if($module == 'home'){echo 'active';} ?>">

          <a href="media.php?module=home">

            <i class="fa fa-dashboard"></i> <span>Dashboard</span>

            <span class="pull-right-container">

              <i class="fa fa-home"></i>

            </span>

          </a>

        </li>

        <li class="<?php if($module == 'user'){echo 'active';} ?>">

          <a href="media.php?module=user">

            <i class="fa fa-users"></i>

            <span>Setting Data User</span>

          </a>

        </li>

        <li class="<?php if($module == 'pendapatan'){echo 'active';} ?>">

          <a href="media.php?module=pendapatan">

            <i class="fa fa-desktop"></i>

            <span>View Data Pendapatan</span>

          </a>

        </li>

      <?php } else{ ?>

        <li class="<?php if($module == 'home'){echo 'active';} ?>">

          <a href="media.php?module=home">

            <i class="fa fa-dashboard"></i> <span>Dashboard</span>

            <span class="pull-right-container">

              <i class="fa fa-home"></i>

            </span>

          </a>

        </li>

        <li class="<?php if($module == 'proses'){echo 'active';} ?>">

          <a href="media.php?module=proses">

            <i class="fa fa-cog"></i>

            <span>Proses Perhitungan</span>

          </a>

        </li>

        <li class="<?php if($module == 'set_harga'){echo 'active';} ?>">

          <a href="media.php?module=set_harga">

            <i class="fa fa-cog"></i>

            <span>Setting Harga Tiket</span>

          </a>

        </li>

        <li class="<?php if($module == 'set_app'){echo 'active';} ?>">

          <a href="media.php?module=set_app">

            <i class="fa fa-cog"></i>

            <span>Setting Aplikasi</span>

          </a>

        </li>

        <li class="<?php if($module == 'user'){echo 'active';} ?>">

          <a href="media.php?module=user">

            <i class="fa fa-user"></i>

            <span>Data Profil Petugas</span>

          </a>

        </li>

      <?php } ?>

    

      </ul>



    </section>

    <!-- /.sidebar -->

  </aside>