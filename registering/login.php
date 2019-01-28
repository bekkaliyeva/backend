<?php
$host = 'localhost';
$user='root';
$password = 'root';
$db = 'project';
$conn = mysqli_connect($host,$user,$password,$db);
$conn_error = mysqli_connect_error();
if ($conn_error != null){
    echo "There is some connection error:<p>  $conn_error </p>";
}
$Name=filter_input(INPUT_POST,'Name');
$Password=filter_input(INPUT_POST,'Password');
$query="SELECT * FROM `users` ";
$results = mysqli_query($conn, $query);
if (isset($Name)) {
    while ($row = mysqli_fetch_array($results)) {
        if ($row['password'] == $Password && $row['login']==$Name) {
            if ($row['admin'] == 1) {
                setcookie("user", "", time() - 100);
                setcookie("admin", $Name);
            } else {
                setcookie("admin", "", time() - 100);
                setcookie("user", $Name);
            }
            header("Location: index.php");
            die();
        }
    }
}
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Sign in</title>
    <link rel="stylesheet" href="css.css">
</head>
<body >
<div class = "header_section">
    <div class = "headerlogo"><a href="#">Lamoda</a></div>
    <div class = "headerButton"><a href = "#">Characters</a></div>
    <div class = "headerButton"><a href = "#">Comics</a></div>
    <div class = "headerButton"><a href = "#">Games</a></div>
    <div class = "headerButton"><a href = "#">Movies</a></div>
    <div class = "headerButton"><a href = "register.php">Register</a></div>
</div>
<div id='errors'>
<?php
$thereis=false;
if (isset($Name)) {
    while ($row = mysqli_fetch_array($results)) {
        if($row['login']==$Name && $row['password']!=$Password){
            $thereis=true;
            echo "<div class='error'>";
            echo "Wrong username or password!!!";
            echo "</div>";
            echo "<br>";
            break;
        }
    }
    if(!$thereis) {
        echo "<div class='error'>";
        echo "Wrong username or password!!!";
        echo "</div>";
        echo "<br>";
    }
}
mysqli_close($conn);
?>
</div>
<div class="container">
    <form action = "login.php" method="post">

        <h1>Sign in</h1>
        <hr>
        <label><b>Username:</b></label>
        <input id="name" type="text" name="Name" placeholder="Enter Username" required>
        <label><b>Password:</b></label>
        <input id="password" type="password" name="Password" placeholder="Enter Password" required>
        <hr>
        <button type="submit" id="signin">Login</button>
        <label>

    </form></div>
</body>
</html>