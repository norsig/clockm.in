<?php
function pageName($name) {
    if ($name == "Home") {
        return "Home";
    } elseif ($name == "About") {
        return "About";
    } elseif ($name == "Login") {
        return "Login";
    } elseif ($name == "Contact") {
        return "Contact";
    }
}

function isLoggedIn($var = 0, $link) {
    if ($var == 0) {
        $query = "UPDATE `users` WHERE `user_id` = $_SESSION[id] SET `isLoggedIn` = '0' LIMIT 1";
        mysqli_query($link, $query); 
        
    } elseif ($var == 1) {
        $query = "UPDATE `users` WHERE `user_id` = $_SESSION[id] SET `isLoggedIn` = '1' LIMIT 1";
        mysqli_query($link, $query);   
    }   
}

function getTimes($link) {
    if(!session_id()) session_start();
    $getTimes="SELECT * FROM `times` WHERE `user_id`='".$_SESSION['id']."' ORDER BY `id` DESC";
	$times = mysqli_query($link,$getTimes);
    return $times;
}

function pageLinks($name) {
    if ($name == "Home") {
        return '<nav class="navbar navbar-default navbar-static-top navbar-padded app-navbar">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed p-x-0" data-toggle="collapse" data-target="#navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/">
        <span>clockMiN</span>
      </a>
    </div>
    <div class="navbar-collapse collapse" id="navbar-collapse">
      <ul class="nav navbar-nav navbar-right text-uppercase">
        <li class="active">
          <a href="http://www.clockm.in/">Home</a>
        </li>
        <li>
          <a href="http://www.clockm.in/about/">About</a>
        </li>
        <li>
          <a href="http://www.clockm.in/contact/">Contact</a>
        </li>
        <li>
          <a href="http://www.clockm.in/login/">Login</a>
        </li>
      </ul>
    </div><!--/.nav-collapse -->
  </div>
</nav>';
    } elseif ($name == "About") {
        return '<nav class="navbar navbar-default navbar-static-top navbar-padded app-navbar">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed p-x-0" data-toggle="collapse" data-target="#navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/">
        <span>clockMiN</span>
      </a>
    </div>
    <div class="navbar-collapse collapse" id="navbar-collapse">
      <ul class="nav navbar-nav navbar-right text-uppercase">
        <li>
          <a href="http://www.clockm.in/">Home</a>
        </li>
        <li class="active">
          <a href="http://www.clockm.in/about/">About</a>
        </li>
        <li>
          <a href="http://www.clockm.in/contact/">Contact</a>
        </li>
        <li>
          <a href="http://www.clockm.in/login/">Login</a>
        </li>
      </ul>
    </div><!--/.nav-collapse -->
  </div>
</nav>'; 
    } elseif ($name == "Login") {
        return '<nav class="navbar navbar-default navbar-static-top navbar-padded app-navbar">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed p-x-0" data-toggle="collapse" data-target="#navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/">
        <span>clockMiN</span>
      </a>
    </div>
    <div class="navbar-collapse collapse" id="navbar-collapse">
      <ul class="nav navbar-nav navbar-right text-uppercase">
        <li>
          <a href="http://www.clockm.in/">Home</a>
        </li>
        <li>
          <a href="http://www.clockm.in/about/">About</a>
        </li>
        <li>
          <a href="http://www.clockm.in/contact/">Contact</a>
        </li>
        <li class="active">
          <a href="http://www.clockm.in/login/">Login</a>
        </li>
      </ul>
    </div><!--/.nav-collapse -->
  </div>
</nav>';
    } elseif ($name == 'Contact') {
        return '<nav class="navbar navbar-default navbar-static-top navbar-padded app-navbar">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed p-x-0" data-toggle="collapse" data-target="#navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/">
        <span>clockMiN</span>
      </a>
    </div>
    <div class="navbar-collapse collapse" id="navbar-collapse">
      <ul class="nav navbar-nav navbar-right text-uppercase">
        <li>
          <a href="http://www.clockm.in/">Home</a>
        </li>
        <li>
          <a href="http://www.clockm.in/about/">About</a>
        </li>
        <li class="active">
          <a href="http://www.clockm.in/contact/">Contact</a>
        </li>
        <li>
          <a href="http://www.clockm.in/login/">Login</a>
        </li>
      </ul>
    </div><!--/.nav-collapse -->
  </div>
</nav>'; 
    }   
}
?>