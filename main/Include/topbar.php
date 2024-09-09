<div class="main-panel ps">

<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
<div class="container-fluid">
<div class="navbar-wrapper">
<div class="navbar-minimize">
<button id="minimizeSidebar" class="btn btn-just-icon btn-white btn-fab btn-round">
<i class="material-icons text_align-center visible-on-sidebar-regular">more_vert</i>
<i class="material-icons design_bullet-list-67 visible-on-sidebar-mini">view_list</i>
</button>
</div>
<a class="navbar-brand" id="top_nm" href="dashboard">
       
<?php  echo $_SESSION['org_name'];  ?>
</a>
</div>
<button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
<span class="sr-only">Toggle navigation</span>
<span class="navbar-toggler-icon icon-bar"></span>
<span class="navbar-toggler-icon icon-bar"></span>
<span class="navbar-toggler-icon icon-bar"></span>
</button>
<div class="collapse navbar-collapse justify-content-end">
<ul class="navbar-nav">
<li class="nav-item dropdown">
<a class="nav-link" href="javascript:;" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	
<i class="material-icons">person</i>
<p class="d-lg-none d-md-block">
Account
</p>
<?php echo $_SESSION['user_Name'];  ?></a>
<div class="dropdown-menu dropdown-menu-right ps" aria-labelledby="navbarDropdownProfile">

<a class="dropdown-item" href="user_prof"><i class="material-icons">manage_accounts</i>Profile</a>
<div class="dropdown-divider"></div>


<a class="dropdown-item" href="../logout"><i class="material-icons">logout</i>Log out</a>
<div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
</li>
</ul>
</div>
</div>
</nav>