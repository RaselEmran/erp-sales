    <!-- Logo -->
    <a href="{{route('admin.dashboard')}}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>E</b>RP</span>
      <!-- logo for regular state and mobile devices -->
          <?php 
$fot =DB::table('systems')->first();
     ?>
      @if ($fot)
       <span class="logo-lg"><b>{{ ucwords($fot->title)}}</b></span>
      @endif
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

             <?php 
              $id=Session::get('admin_id');
$prof =DB::table('admins')->where('id',$id)->first();
               ?>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
               @if(empty($prof->image))
                <img src="{{asset('backend/dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
                @else
                <img src="{{asset($prof->image)}}" class="img-circle" alt="User Image" width="35px">
               
                @endif
              <span class="hidden-xs"> <?php echo Session::get('admin_name') ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
        
              <li class="user-header">
                @if(empty($prof->image))
                <img src="{{asset('backend/dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
                @else
                <img src="{{asset($prof->image)}}" class="img-circle" alt="User Image" width="80px">
               
                @endif

                <p>
                  <?php echo Session::get('admin_name') ?>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
            <?php $id=Session::get('admin_id') ?>
              <li class="user-footer">
                <div class="pull-left">
                  <a href="{{route('admin.user.profile',$id)}}" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="{{route('logout')}}" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>