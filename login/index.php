<? $named = "Login"; include('../header.php'); include("../login.php"); ?>

<div class="block app-block-intro">
    <div class="container cont-top text-center">
        <h1 class="block-title">Log In</h1>
            <h4>Log In To Your Time Clock!</h4>

            <?php
                if ($error) {	
                    echo '<div class="alert alert-danger">'.addslashes($error).'</div>';	
                }
                if ($message) {	
                    echo '<div class="alert alert-success">'.addslashes($message).'</div>';
                }
            ?>
      
        <form class="log-form" method="post">
            <div class="form-group">
                <input type="email" name="loginEmail" id="loginEmail" placeholder="E-Mail Address" 
                value="<? echo addslashes($_POST["loginEmail"]); ?>" class="form-control" autofocus>
            </div>
            <div class="form-group">
                <input type="password" name="loginPassword" placeholder="Password" value="<? echo addslashes($_POST["loginPassword"]); ?>" class="form-control">
            </div>
            <input type="submit" name="submit" value="Log In" class="btn btn-signUp btn-sm">
        </form>
    </div>
</div>


<? include('../footer.php'); ?>