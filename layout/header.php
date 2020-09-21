

 <header class="main-header">

    <!-- Logo -->

    <a href="media.php?module=home" class="logo">

      <!-- mini logo for sidebar mini 50x50 pixels -->

      <span class="logo-mini"><b>APK</span>

      <!-- logo for regular state and mobile devices -->

      <span class="logo-lg">APERTIK</span>

    </a>

    <!-- Header Navbar: style can be found in header.less -->

    <nav class="navbar navbar-static-top">

      <!-- Sidebar toggle button-->

      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">

        <span class="sr-only">Toggle navigation</span>

      </a>



      <div class="navbar-custom-menu">

        <ul class="nav navbar-nav">

          <!-- Tasks: style can be found in dropdown.less -->

          <li class="dropdown user user-menu">

            <a href="#" class="dropdown-toggle" data-toggle="dropdown">

              <img src="../assets/images/avatar5.png" class="user-image" alt="User Image">

              <span class="hidden-xs">

                <?php 

                  echo $_SESSION['nama'];

                ?> 

              </span>

            </a>

            <ul class="dropdown-menu">

              <!-- User image -->

              <li class="user-header">

                <img src="../assets/images/avatar5.png" class="img-circle" alt="User Image">



                <p>

                  <?php 

                    echo ucfirst($_SESSION['nama']);

                  ?> 

                </p>

              </li>

              <!-- Menu Footer-->

              <li class="user-footer">

                <?php

                if ($_SESSION['leveluser']=="Pemilik"){

                ?>

                <div class="col-xs-12">

                  <input type="button" class="btn btn-default btn-block btn-flat" value="Logout" onclick="window.location.href='logout.php'"/>

                </div>

                <?php

                } else{

                ?>

                <div class="pull-left">

                  <a href="media.php?module=user" class="btn btn-default btn-flat">Profile</a>

                </div>

                <div class="pull-right">

                  <a href="../auth/logout.php" class="btn btn-default btn-flat">Logout</a>

                </div>

                <?php

                }

                ?>

              </li>

            </ul>

          </li>

        </ul>

      </div>

    </nav>

  </header>