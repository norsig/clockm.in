<html>
<head>
</head>
<body>
    <?php
    include('connection.php');
    if(!session_id()) session_start();

    function isLoggedIn() {
        $query = "SELECT * FROM `users` WHERE `id` = $_SESSION[id]";
        $row = mysqli_query($link, $query);
        $result = mysqli_fetch_array($row);
        
        echo $result["isLoggedIn"];
    }
    
    echo isLoggedIn();

    ?>
</body>
</html>