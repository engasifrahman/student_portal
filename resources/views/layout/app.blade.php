<?php
  if (session()->has('system_admin'))
  {
    $name = session()->get('system_admin.name');
    $user_id = session()->get('system_admin.user_id');
    $pic_dir = session()->get('system_admin.pic_dir');
    $type = session()->get('system_admin.type');
  }
  elseif (session()->has('finance_admin'))
  {
    $name = session()->get('finance_admin.name');
    $user_id = session()->get('finance_admin.user_id');
    $pic_dir = session()->get('finance_admin.pic_dir');
    $type = session()->get('finance_admin.type');
  }
  elseif (session()->has('faculty_member'))
  {
    $name = session()->get('faculty_member.name');
    $user_id = session()->get('faculty_member.user_id');
    $pic_dir = session()->get('faculty_member.pic_dir');
    $type = session()->get('faculty_member.type');
  }
  elseif (session()->has('student'))
  {
    $name = session()->get('student.name');
    $user_id = session()->get('student.user_id');
    $pic_dir = session()->get('student.pic_dir');
    $type = session()->get('student.type');
  }
  else
  {
    return redirect('/login');
  }
?>
<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from www.urbanui.com/salt/jquery/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 13 Dec 2017 12:31:57 GMT -->
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title')</title>

  <!-- icon css -->
  <link rel="stylesheet" href="{{ asset('assets') }}/node_modules/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="{{ asset('assets') }}/node_modules/icomoon/css/icomoon.css" />
  <link rel="stylesheet" href="{{ asset('assets') }}/node_modules/font-awesome/css/font-awesome.min.css" />
  <!-- /icon css -->

  <!-- inject:css -->
  <link rel="stylesheet" href="{{ asset('assets') }}/node_modules/perfect-scrollbar/dist/css/perfect-scrollbar.min.css">
  <!-- endinject -->

  <!-- plugin css for this page -->
  <link rel="stylesheet" href="{{ asset('assets') }}/node_modules/rickshaw/rickshaw.min.css" />
  <link rel="stylesheet" href="{{ asset('assets') }}/bower_components/chartist/dist/chartist.min.css" />
  <link rel="stylesheet" href="{{ asset('assets') }}/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css" />
  <link rel="stylesheet" href="{{ asset('assets') }}/node_modules/jquery-toast-plugin/dist/jquery.toast.min.css">
  <link rel="stylesheet" href="{{ asset('assets') }}/node_modules/dropify/dist/css/dropify.min.css">
  <link rel="stylesheet" href="{{ asset('assets') }}/node_modules/selectize/css/selectize.bootstrap4.css">
  <!-- End plugin css for this page -->

  <!-- inject:css -->
  <link rel="stylesheet" href="{{ asset('assets') }}/css/style.css">
  <!-- endinject -->

  <link rel="shortcut icon" href="{{ asset('assets') }}/images/favicon.html" />

  <!------- Custom CSS ------->
  <link rel="stylesheet" href="{{ asset('assets') }}/custom/css/custom.css">
  <!------- /Custom CSS ------->

  <script src="{{ asset('assets') }}/node_modules/jquery/dist/jquery.min.js"></script>
  <script src="{{ asset('assets') }}/node_modules/jqueryui/jqueryui.js" type="text/javascript"></script>
  <script src="{{ asset('assets') }}/node_modules/datatables.net/js/jquery.dataTables.js"></script>
  <script src="{{ asset('assets') }}/node_modules/datatables.net-bs4/js/dataTables.bootstrap4.js"></script>
  <script src="{{ asset('assets') }}/node_modules/bootstrapValidator/dist/js/bootstrapValidator.js"></script>
  <script src="{{ asset('assets') }}/node_modules/jquery-toast-plugin/dist/jquery.toast.min.js"></script>
  <script src="{{ asset('assets') }}/node_modules/selectize/js/standalone/selectize.min.js"></script>
  <script src="{{ asset('assets') }}/node_modules/jquery-maskmoney/dist/jquery.maskMoney.min.js"></script>
</head>

<body class="sidebar-dark">

  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar navbar-light col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper">
        <a class="navbar-brand brand-logo" href="{{ url('/dashboard') }}"><img src="{{ asset('assets') }}/images/1.png" alt="Logo"></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center">
        <button class="navbar-toggler navbar-toggler align-self-center mr-2" type="button" data-toggle="minimize">
          <span class="navbar-toggler-icon"></span>
        </button>
        <ul class="navbar-nav ml-lg-auto">
          <li class="nav-item dropdown">
            <a class="nav-link count-indicator" id="MailDropdown" href="#" data-toggle="dropdown">
              <i class="fa fa-user-circle-o" style="font-size: 16px; color:#7B7973"></i>
              {{ $name }}
              <i class="fa fa-caret-down" style="font-size: 14px; color:#7B7973"></i>
            </a>
            <div class="dropdown-menu navbar-dropdown mail-notification" aria-labelledby="MailDropdown">
              <a class="dropdown-item" href="<?php echo '/profile/'.$user_id; ?>">
                <div class="sender" style="color:#7B7973">
                  <i class="fa fa-user" aria-hidden="true"></i>
                  <sapn class="Sende-name">Profile</sapn>
                </div>
              </a>
              <a class="dropdown-item" href="<?php echo '/settings/'.$user_id; ?>">
                <div class="sender" style="color:#7B7973">
                  <i class="fa fa-cog" aria-hidden="true"></i>
                  <span class="Sende-name">Settings</span>
                </div>
              </a>
              <a class="dropdown-item" href="{{ route('logout') }}">
                <div class="sender" style="color:#7B7973">
                  <i class="fa fa-sign-out" aria-hidden="true"></i>
                  <span class="Sende-name">Logout</span>
                </div>
              </a>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="navbar-toggler-icon"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <div class="row row-offcanvas row-offcanvas-right">
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <div class="user-info">
            <div class="profile">
              <img src="{{ asset($pic_dir) }}" class="bg-secondary" width="47" height="47" alt="">
            </div>
            <div class="details">
              <p class="user-name">{{ $name }}</p>
              <p class="designation">{{ $type }}</p>
            </div>
          </div>
          <ul class="nav">
            <!--main pages start-->
            <li class="nav-item">
              <a class="nav-link" href="<?php echo '/profile/'.$user_id; ?>">
                <i class="mdi mdi-gauge menu-icon"></i>
                <span class="menu-title">Profile</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ url('/dashboard') }}">
                <i class="mdi mdi-gauge menu-icon"></i>
                <span class="menu-title">Dashboard</span>
              </a>
            </li>

            <?php
            if ($type == 'System Admin')
            {
              ?>
              {{-- <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#create-dropdown" aria-expanded="false" aria-controls="create-dropdown">
                  <i class="fa fa-info-circle menu-icon" aria-hidden="true"></i>
                  <span class="menu-title">Create Data</span>
                  <i class="mdi mdi-chevron-down menu-arrow"></i>
                </a>
                <div class="collapse" id="create-dropdown">
                  <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                      <a class="nav-link" href="{{ route('course.index') }}">Cousre</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="{{ route('section.index') }}">Section</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="{{ route('semester.index') }}">Semester</a>
                    </li>
                  </ul>
                </div>
              </li> --}}
              <li class="nav-item">
                <a class="nav-link" href="{{ route('course.index') }}">
                  <i class="mdi mdi-gauge menu-icon"></i>
                  <span class="menu-title">Cousre</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('section.index') }}">
                  <i class="mdi mdi-gauge menu-icon"></i>
                  <span class="menu-title">Section</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('semester.index') }}">
                  <i class="mdi mdi-gauge menu-icon"></i>
                  <span class="menu-title">Semester</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('faculty.index') }}">
                  <i class="mdi mdi-gauge menu-icon"></i>
                  <span class="menu-title">Faculty</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('department.index') }}">
                  <i class="mdi mdi-gauge menu-icon"></i>
                  <span class="menu-title">Department</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('deptcourse.index') }}">
                  <i class="mdi mdi-gauge menu-icon"></i>
                  <span class="menu-title">Department's Course</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('userreg.index') }}">
                  <i class="mdi mdi-puzzle menu-icon"></i>
                  <span class="menu-title">User Registration</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('coursereg.index') }}">
                  <i class="mdi mdi-puzzle menu-icon"></i>
                  <span class="menu-title">Course Registration</span>
                </a>
              </li>
              <?php
            }
            ?>

            <?php
            if ($type == 'Finance Admin')
            {
              ?>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('tutionfee.index') }}">
                  <i class="mdi mdi-puzzle menu-icon"></i>
                  <span class="menu-title">Student Tution Fee</span>
                </a>
              </li>
              <?php
            }
            ?>

            <?php
            if ($type == 'Faculty Member')
            {
              ?>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('fmregcourse.index') }}">
                  <i class="mdi mdi-puzzle menu-icon"></i>
                  <span class="menu-title">Registered Course</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('studresult.index') }}">
                  <i class="mdi mdi-puzzle menu-icon"></i>
                  <span class="menu-title">Student Result</span>
                </a>
              </li>
              <?php
            }
            ?>

            <?php
            if ($type == 'Student')
            {
              ?>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('paymentledger') }}">
                  <i class="mdi mdi-puzzle menu-icon"></i>
                  <span class="menu-title">Payment Ladger</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('studregcourse.index') }}">
                  <i class="mdi mdi-puzzle menu-icon"></i>
                  <span class="menu-title">Registered Course</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('liveresult.index') }}">
                  <i class="mdi mdi-puzzle menu-icon"></i>
                  <span class="menu-title">Live Result</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('result.index') }}">
                  <i class="mdi mdi-puzzle menu-icon"></i>
                  <span class="menu-title">Result</span>
                </a>
              </li>
              <?php
            }
            ?>

            <li class="nav-item">
              <a class="nav-link" href="<?php echo '/settings/'.$user_id; ?>">
                <i class="mdi mdi-puzzle menu-icon"></i>
                <span class="menu-title">Settings</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('logout') }}">
                <i class="mdi mdi-puzzle menu-icon"></i>
                <span class="menu-title">Logout</span>
              </a>
            </li>
            <!--main pages end-->
          </ul>
        </nav>
        <!-- partial -->
        @yield('main_content')
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="container-fluid clearfix">
            <span class="float-right">
              <a href="#">Student Portal</a> &copy; 2017
            </span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- row-offcanvas ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="{{ asset('assets') }}/node_modules/popper.js/dist/umd/popper.min.js"></script>
  <script src="{{ asset('assets') }}/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="{{ asset('assets') }}/node_modules/perfect-scrollbar/dist/js/perfect-scrollbar.jquery.min.js"></script>
  <!-- endinject -->

  <!-- Plugin js for this page-->
  <script src="{{ asset('assets') }}/node_modules/flot/jquery.flot.js"></script>
  <script src="{{ asset('assets') }}/node_modules/flot/jquery.flot.resize.js"></script>
  <script src="{{ asset('assets') }}/node_modules/flot/jquery.flot.categories.js"></script>
  <script src="{{ asset('assets') }}/node_modules/flot/jquery.flot.pie.js"></script>
  <script src="{{ asset('assets') }}/node_modules/rickshaw/vendor/d3.v3.js"></script>
  <script src="{{ asset('assets') }}/node_modules/rickshaw/rickshaw.min.js"></script>
  <script src="{{ asset('assets') }}/bower_components/chartist/dist/chartist.min.js"></script>
  <script src="{{ asset('assets') }}/node_modules/chartist-plugin-legend/chartist-plugin-legend.js"></script>
  <script src="{{ asset('assets') }}/node_modules/chart.js/dist/Chart.min.js"></script>
  <script src="{{ asset('assets') }}/node_modules/jquery-sparkline/jquery.sparkline.min.js"></script>
  <script src="{{ asset('assets') }}/node_modules/dropify/dist/js/dropify.min.js"></script>
  <!-- End plugin js for this page-->

  <!-- inject:js -->
  <script src="{{ asset('assets') }}/js/off-canvas.js"></script>
  <script src="{{ asset('assets') }}/js/hoverable-collapse.js"></script>
  <script src="{{ asset('assets') }}/js/misc.js"></script>
  <script src="{{ asset('assets') }}/js/settings.js"></script>
  <!-- endinject -->

  <!-- Custom js for this page-->
  <script src="{{ asset('assets') }}/js/dashboard_1.js"></script>
  <!-- End custom js for this page-->

</body>


<!-- Mirrored from www.urbanui.com/salt/jquery/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 13 Dec 2017 12:32:50 GMT -->
</html>
