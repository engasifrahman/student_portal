<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from www.urbanui.com/salt/jquery/pages/samples/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 13 Dec 2017 12:33:56 GMT -->
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Salt Admin</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{ asset('/assets/node_modules/mdi/css/materialdesignicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('/assets/node_modules/perfect-scrollbar/dist/css/perfect-scrollbar.min.css') }}">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <link rel="stylesheet" href="{{ asset('/assets/node_modules/font-awesome/css/font-awesome.min.css') }}" />
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{ asset('/assets/css/style.css') }}">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{ asset('/assets/images/favicon.html') }}" />
</head>

<body class="sidebar-dark">
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper">
      <div class="row">
        <div class="content-wrapper full-page-wrapper d-flex align-items-center auth-pages">
          <div class="card col-lg-4 mx-auto">
            <div class="card-body px-5 py-5">
              <h3 class="card-title text-left mb-3">Login</h3>
              {!! Form::open(['url' => '/authentication', 'method'=>'post']) !!}
                <div class="form-group">
                  <label>Username or email *</label>
                  <input type="text" class="form-control p_input" name="email">
                </div>
                <div class="form-group">
                  <label>Password *</label>
                  <input type="password" class="form-control p_input" name="password">
                </div>
                @if(session()->has('exception'))
                 <small class="text-danger text-center"> {{ session()->get('exception') }}</small>
                @endif
                <div class="form-group d-flex align-items-center justify-content-between">
                  <div class="icheck-square">
                    <input tabindex="1" type="checkbox" id="remember">
                    <label for="remember">Remember me</label>
                  </div>
                  <a href="#" class="forgot-pass">Forgot password</a>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary btn-block enter-btn" style="cursor: pointer;">Login</button>
                </div>
                <div class="d-flex justify-content-center mb-4">
                  <a href="#" class="facebook-login btn btn-facebook mr-2">Facebook</a>
                  <a href="#" class="google-login btn btn-google">Google+</a>
                </div>
              {!! Form::close() !!}
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- row ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="{{ asset('/assets/node_modules/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('/assets/node_modules/popper.js/dist/umd/popper.min.js') }}"></script>
  <script src="{{ asset('/assets/node_modules/bootstrap/dist/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('/assets/node_modules/perfect-scrollbar/dist/js/perfect-scrollbar.jquery.min.js') }}"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="{{ asset('/assets/js/off-canvas.js') }}"></script>
  <script src="{{ asset('/assets/js/hoverable-collapse.js') }}"></script>
  <script src="{{ asset('/assets/js/misc.js') }}"></script>
  <script src="{{ asset('/assets/js/settings.js') }}"></script>
  <!-- endinject -->
</body>


<!-- Mirrored from www.urbanui.com/salt/jquery/pages/samples/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 13 Dec 2017 12:33:56 GMT -->
</html>
