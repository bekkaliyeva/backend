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
    <script src="index.js" defer></script>
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
<?php
$thereis=false;
if (isset($Name)) {
    echo "<div id='errors'>";
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
    echo "</div>";
}
mysqli_close($conn);
?>
<article class="flex-article">
    <div class="mySlides fade">
        <img src="https://a.lmcdn.ru/product/H/E/HE002EMDQCS8_7795888_1_v1.jpg">
    </div>

    <div class="mySlides fade">
        <img src="https://a.lmcdn.ru/product/D/O/DO005EWDMVF8_7806459_2_v1.jpg">
    </div>

    <div class="mySlides fade">
        <img src="https://a.lmcdn.ru/product/H/E/HE002EMDYAC9_7904798_2_v1.jpg">
    </div>

    <div class="mySlides fade">
        <img src="https://a.lmcdn.ru/product/B/E/BE031EWDUMI0_7938878_2_v1.jpg">
    </div>

</article>
<div class="container">
    <form action = "login.php" method="post">

        <h1>Sign in</h1>
        <label><b>Username:</b></label>
        <input id="name" type="text" name="Name" placeholder="Enter Username" required>
        <label><b>Password:</b></label>
        <input id="password" type="password" name="Password" placeholder="Enter Password" required>
        <label><input type="checkbox" name="remember"> Remember me</label>
        <button type="submit" id="signin">Login</button>

    </form></div>
</body>
</html>