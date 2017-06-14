{{header}}
  <link rel="stylesheet" type="text/css" href="asset/css/plugins/font-awesome.min.css"/>
  <link rel="stylesheet" type="text/css" href="asset/css/plugins/simple-line-icons.css"/>
  <link rel="stylesheet" type="text/css" href="asset/css/plugins/animate.min.css"/>
  <link rel="stylesheet" type="text/css" href="asset/css/plugins/icheck/skins/flat/aero.css"/>
  <link href="asset/css/style.css" rel="stylesheet">
  <!-- end: Css -->

  <link rel="shortcut icon" href="asset/img/logomi.png">
  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->


  <div class="container">

    <form class="form-signin" method='POST'>
      <div class="panel periodic-login">
          <div class="panel-body text-center">
              <h1 class="atomic-symbol"></h1>
              <p class="atomic-mass">Register</p>

              <i class="icons icon-arrow-down"></i>
              {{message}}
              <div class="form-group form-animate-text" style="margin-top:40px !important;">
                <input type="text" value='{{username}}' name="username" class="form-text" required>
                <span class="bar"></span>
                <label>Username</label>
              </div>
              <div class="form-group form-animate-text" style="margin-top:40px !important;">
                <input type="text" value='{{email}}' name="email" class="form-text" required>
                <span class="bar"></span>
                <label>Email</label>
              </div>
              <div class="form-group form-animate-text" style="margin-top:40px !important;">
                <input type="password" value='{{password}}' name="password" class="form-text" required>
                <span class="bar"></span>
                <label>Password</label>
              </div>
              <div class="form-group form-animate-text" style="margin-top:40px !important;">
                <input type="password" value='{{password_repeated}}' name="password_repeated" class="form-text" required>
                <span class="bar"></span>
                <label>Repeat Password</label>
              </div>
              <label class="pull-left">
              <input type="checkbox" {{agree_checked}} class="icheck pull-left" name="agree" value='1'/> &nbsp Agree the terms and policy
              </label>
              <input type="submit" class="btn col-md-12" value="SignUp"/>
          </div>
            <div class="text-center" style="padding:5px;">
                <a href="{{PATH_APP}}auth/login">Already have an account?</a>
            </div>
      </div>
    </form>

  </div>

  <!-- end: Content -->
  <!-- start: Javascript -->

  <script src="asset/js/plugins/icheck.min.js"></script>

  <!-- custom -->
  <script src="asset/js/main.js"></script>
  <script type="text/javascript">
   $(document).ready(function(){
     $('input').iCheck({
      checkboxClass: 'icheckbox_flat-aero',
      radioClass: 'iradio_flat-aero'
    });
   });
 </script>

{{footer}}