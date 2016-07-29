<header class="bg-black lter header header-sm navbar navbar-fixed-top-xs">
  <div class="navbar-header aside bg-success dk">
    <a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen,open" data-target="#nav,html">
      <i class="icon-list"></i>
    </a>
    <a href="#" class="navbar-brand text-lt">
      <i class="icon-note icon"></i>
      <span class="hidden-nav-xs m-l-sm">my Tasks</span>
    </a>
    <a class="btn btn-link visible-xs" data-toggle="dropdown" data-target=".user">
      <i class="icon-settings"></i>
    </a>
  </div>
  <ul class="nav navbar-nav hidden-xs">
    <li>
      <a href="#nav,.navbar-header,.thumb-md" data-toggle="class:nav-xs,nav-xs,thumb-sm" class="text-muted">
        <i class="fa fa-indent text"></i>
        <i class="fa fa-dedent text-active"></i>
      </a>
    </li>
  </ul>
  <div class="navbar-right">
    <ul class="nav navbar-nav m-n hidden-xs nav-user user">
      <li class="hidden-xs">
        <a href="#" class="dropdown-toggle " data-toggle="dropdown">
          <i class="icon-bell"></i>
          <span class="badge badge-sm up bg-danger count">2</span>
        </a>
        <section class="dropdown-menu aside-xl animated fadeInUp">
          <section class="panel bg-white">
            <div class="panel-heading b-light bg-light">
              <strong>You have <span class="count">2</span> notifications</strong>
            </div>
            <div class="list-group list-group-alt">
              <a href="#" class="media list-group-item">
                <span class="pull-left thumb-sm">
                  <img src="/images/a0.png" alt="..." class="img-circle">
                </span>
                <span class="media-body block m-b-none">
                  Use awesome animate.css<br>
                  <small class="text-muted">10 minutes ago</small>
                </span>
              </a>
              <a href="#" class="media list-group-item">
                <span class="media-body block m-b-none">
                  1.0 initial released<br>
                  <small class="text-muted">1 hour ago</small>
                </span>
              </a>
            </div>
            <div class="panel-footer text-sm">
              <a href="#" class="pull-right"><i class="fa fa-cog"></i></a>
              <a href="#notes" data-toggle="class:show animated fadeInRight">See all the notifications</a>
            </div>
          </section>
        </section>
      </li>
      <li>
        <a href="#" class="text-muted dropdown-toggle" data-toggle="dropdown">
          <i class="icon icon-question text"></i>
        </a>
        <ul class="dropdown-menu animated fadeInRight aside text-left">
          <li>
            <a href="#">Settings</a>
          </li>
          <li>
            <a href="#">Settings</a>
          </li>
          <li class="divider"></li>
          <li>
            <a href="{{ url('logout') }}">Logout</a>
          </li>
        </ul>
      </li>
    </ul>
  </div>
</header>
