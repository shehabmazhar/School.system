  <header class="main-header">

 
    <a href="./" class="logo">
      
      <span class="logo-mini"><b>S</b>MS</span>
      
      <span class="logo-lg"><b>Student</b> Management System</span>
    </a>

 
    <nav class="navbar navbar-static-top" role="navigation">
   
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
   
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
        
          <li class="dropdown user user-menu">
           
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
             
              <img src="dist/img/avatar5.png" class="user-image" alt="User Image">
             
              <span class="hidden-xs"><?php echo $_SESSION['user']; ?></span>
            </a>
            <ul class="dropdown-menu">
              
              <li class="user-header">
                <img src="dist/img/avatar5.png" class="img-circle" alt="User Image">

                <p>
                  
                  <small><?php echo $_SESSION['role']; ?></small>
                </p>
              </li>
            
              <li class="user-footer">
                
                <div class="pull-right">
                  <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        
         
        </ul>
      </div>
    </nav>
  </header>