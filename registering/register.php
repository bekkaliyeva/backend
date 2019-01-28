<?php
$host = 'localhost';
$user='root';
$password = 'root';
$db = 'project';
$conn = mysqli_connect($host,$user,$password,$db);
$conn_error = mysqli_connect_error();
$query="SELECT * FROM `users`";
$results = mysqli_query($conn, $query);
$Name=filter_input(INPUT_POST,'Name');
$Password=filter_input(INPUT_POST,'Password');
$ConfPassw=filter_input(INPUT_POST,'ConfPassw');
$free=true;
if (isset($Name)){
    while ($row = mysqli_fetch_array($results)) {
        if ($row['login']==$Name){
            $free=false;
            break;
        }
    }
    if ($free && $Password==$ConfPassw){
        $query="INSERT INTO `users` (`login`, `password`, `admin`) VALUES ('".$Name."', '".$Password."', '0');";
        $results = mysqli_query($conn, $query);
        setcookie("admin", "", time() - 100);
        setcookie("user", $Name);
        header("Location: empty.html");
        die();
    }
}
if ($conn_error != null){
    echo "There is some connection error:<p>  $conn_error </p>";
}
?>

<html>
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <script src="index.js" defer></script>
    <link rel="stylesheet" href="css.css">
</head>
<body>
<div class = "header_section">
    <div class="headerlogo"  ><a href="#">Lamoda</a></div>
    <div class="headerButton"><a href="#">Characters</a></div>
    <div class="headerButton"><a href="#">Comics</a></div>
    <div class="headerButton"><a href="#">Games</a></div>
    <div class="headerButton"><a href="#">Movies</a></div>
    <div class="headerButton"><a href="login.php">log in</a></div>
</div>
<?php
if (isset($Name)){
    echo "<div id='errors'>";
    if(!$free){
        echo "<div class='error'>";
        echo "This username " .$Name . " is already reserved!!!";
        echo "</div>" ;
        echo "<br>";
    }
    if($Password!=$ConfPassw){
        echo "<div class='error'>";
        echo "Password and Confirm password does not equal to each other";
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
    <h1>Registering</h1>
    <form action = "register.php" method="post">
        <label><b>Username:</b></label>
        <input type="text" name="username" placeholder="Enter Username" required>
        <label><b>Password:</b></label>
        <input type="password" name="Password" placeholder="Enter Password" required>
        <label><b>Confirm Password:</b></label>
        <input type="password" name="ConfPassw" placeholder="Password one more time" required>
        <label><b>e-mail:</b></label>
        <input type="text" name="e-mail" placeholder="Enter e-mail" required>
        <label><b>Name:</b></label>
        <input type="text" name="Name" placeholder="Enter your full name" required>
        <select name="gender">
            <option value="f">Female </option>
            <option value="m">Male </option>
        </select>
        <button type="submit" id="signin">Enter</button>
    </form>
</div>


</body>
</html>
