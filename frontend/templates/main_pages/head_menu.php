      <!-- start: Header -->
        <nav class="navbar navbar-default header navbar-fixed-top">
          <div class="col-md-12 nav-wrapper">
            <div class="navbar-header" style="width:100%;">
              <div class="opener-left-menu is-open">
                <span class="top"></span>
                <span class="middle"></span>
                <span class="bottom"></span>
              </div>
                <a href="index.html" class="navbar-brand"> 
                 <b>Mobile Operator Usage Statistics</b>
                </a>

              <ul class="nav navbar-nav navbar-right user-nav">
                <li class="user-name"><span>
                    <?php if (fAuthorization::checkLoggedIn()) { 
                      echo Server::getPerson()->getUserName();
                     } else { ?>
                      Not logged in
                    <?php } ?>
                </span></li>
                  <li class="dropdown avatar-dropdown">
                   <img src="{{PATH_APP}}frontend/asset/img/avatar.jpg" class="img-circle avatar" alt="user name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"/>
                   <ul class="dropdown-menu user-dropdown">
                    <?php if (fAuthorization::checkLoggedIn()) { ?>
                      <?php if(Server::getPerson()->isAdmin()) { ?>
                         <li><a href="{{PATH_APP}}auth/display_users"><span class="fa fa-users"></span> Users </a></li>
                      <?php } ?>
                     <li><a href="{{PATH_APP}}statistic/display_statistics_data"><span class="icons  icon-pie-chart"></span> Statistics Data </a></li>
                     <li><a href="{{PATH_APP}}auth/logout"><span class="fa fa-power-off "></span> Logout</a></li>
                     
                    <?php } else { ?>
                        <li><a href="{{PATH_APP}}auth/login"><span class="fa fa-user"></span> Login</a></li>
                        <li><a href="{{PATH_APP}}auth/register"><span class="fa fa-lock"></span> Register</a></li>
                    <?php } ?>
                  </ul>
                </li>
              </ul>
            </div>
          </div>
        </nav>
      <!-- end: Header -->