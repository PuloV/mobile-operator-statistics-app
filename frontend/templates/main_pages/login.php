{{header}}
  <!-- plugins -->
  <link rel="stylesheet" type="text/css" href="asset/css/plugins/font-awesome.min.css"/>
  <link rel="stylesheet" type="text/css" href="asset/css/plugins/simple-line-icons.css"/>
  <link rel="stylesheet" type="text/css" href="asset/css/plugins/animate.min.css"/>
  <link rel="stylesheet" type="text/css" href="asset/css/plugins/icheck/skins/flat/aero.css"/>
  <link href="asset/css/style.css" rel="stylesheet">
  <!-- end: Css -->

  <link rel="shortcut icon" href="asset/img/logomi.png">

  <div class="container">

    <form class="form-signin" method='POST'>
      <div class="panel periodic-login">
          <div class="panel-body text-center">
              <h1 class="atomic-symbol"></h1>
              <p class="atomic-mass">Login</p>

              <i class="icons icon-arrow-down"></i>
              {{message}}
              <div class="form-group form-animate-text" style="margin-top:40px !important;">
                <input type="text" name="email" value="{{email}}" class="form-text" required>
                <span class="bar"></span>
                <label>Email</label>
              </div>
              <div class="form-group form-animate-text" style="margin-top:40px !important;">
                <input type="password" name="password" value="{{password}}" class="form-text" required>
                <span class="bar"></span>
                <label>Password</label>
              </div>
              <label class="pull-left">
              <input type="checkbox" class="icheck pull-left" name="remember" value='1' {{remember_checked}}/> Remember me
              </label>
              <input type="submit" class="btn col-md-12" value="SignIn"/>
          </div>
            <div class="text-center" style="padding:5px;">
                <a href="{{PATH_APP}}auth/register">Register</a>
            </div>
      </div>
    </form>

  </div>

  <!-- end: Content -->
  <!-- start: Javascript -->

  <script src="asset/js/plugins/moment.min.js"></script>
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