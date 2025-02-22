<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Login | SIJA-PSDKU Tanah Datar</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{url('asset-admin')}}/vendors/feather/feather.css">
  <link rel="stylesheet" href="{{url('asset-admin')}}/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="{{url('asset-admin')}}/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{url('asset-admin')}}/css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{url('assets')}}/img/logo_td.jpg" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Lupa Password?</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              Hubungi Admin, jika Anda lupa Password.
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
            </div>
          </div>
        </div>
      </div>
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo text-center">
                <img src="{{url('assets')}}/img/logo_td.jpg" alt="logo" style="width: 45%">
                <h3 class="mt-3">Silahkan Login</h3>
              </div>
              <form class="pt-3" method="POST" action="{{ route('login.process') }}">
                @csrf
                <div class="form-group">
                  <input type="text" autofocus required class="form-control form-control-lg @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" placeholder="Username">
                  @error('username')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>
                <div class="form-group">
                  <input type="password" required class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" placeholder="Password">
                </div>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <div class="mt-3">
                  <button type="submit" class="btn btn-block btn-warning btn-lg font-weight-medium auth-form-btn" >SIGN IN</button>
                </div>
                <div class="my-2 d-flex justify-content-between align-items-center">
                  <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input" name="remember" {{ old('remember') ? 'checked' : '' }}>
                      Keep me signed in
                    </label>
                  </div>
                  <a href="#" class="auth-link text-black" data-toggle="modal" data-target="#exampleModalCenter">Forgot password?</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="{{url('asset-admin')}}/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="{{url('asset-admin')}}/js/off-canvas.js"></script>
  <script src="{{url('asset-admin')}}/js/hoverable-collapse.js"></script>
  <script src="{{url('asset-admin')}}/js/template.js"></script>
  <script src="{{url('asset-admin')}}/js/settings.js"></script>
  <script src="{{url('asset-admin')}}/js/todolist.js"></script>
  <!-- endinject -->
</body>

</html>