<?php
$host = 'localhost';
$user='root';
$password = 'root';
$db = 'back';
$conn = mysqli_connect($host,$user,$password,$db);
$conn_error = mysqli_connect_error();
$query="SELECT * FROM `users`";
$results = mysqli_query($conn, $query);

$username=filter_input(INPUT_POST,'username');
$Password=filter_input(INPUT_POST,'Password');
$ConfPassw=filter_input(INPUT_POST,'ConfPassw');
$email=filter_input(INPUT_POST,'email');
$Name=filter_input(INPUT_POST,'Name');

$free=true;
$WP=false;

if (isset($Name)){
    /* проверяет не занято ли имя пользователя*/
    while ($row = mysqli_fetch_array($results)) {
        if ($row['username']==$username){
            $free=false;
            break;
        }
    }
    if(strlen($Password)>8 && preg_match("#[0-9]+#",$Password) && preg_match("#[a-zA-z]+#",$Password) && $Password==$ConfPassw){
        $WP=true;
    }
    if ($free && $WP){
        /* отправляет данные на дб*/
        $query="INSERT INTO `users` (`username`, `password`, `email`, `FullName`) VALUES ('".$username."', '".$Password."', '".$email."', '".$Name."');";
        $results = mysqli_query($conn, $query);
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
    if(!preg_match("#[#$%^&*'/;:.,!@()+-]#",$username)||!preg_match("#[a-zA-z]+#",$Password)){
        /*выводит ошибку если пароль не содержит букв или цифр */
        echo "<div class='error'>";
        echo "Password should have at least 1 number and 1 letter";
        echo "</div>";
        echo "<br>";
    }
    if(!$free){
        /*выводит ошибку если  занято имя пользователя*/
        echo "<div class='error'>";
        echo "This username ".$username." is already reserved!!!";
        echo "</div>" ;
        echo "<br>";
    }
    if($Password!=$ConfPassw){
        /*выводит ошибку если  не сходятся пароли*/
        echo "<div class='error'>";
        echo "Password and Confirm password does not equal to each other";
        echo "</div>";
        echo "<br>";
    }

    if(strlen($Password)<8){
        /*выводит ошибку если пароль короткий*/
        echo "<div class='error'>";
        echo "Password should be not less than 8 characters";
        echo "</div>";
        echo "<br>";
    }
    if(!preg_match("#[0-9]+#",$Password)||!preg_match("#[a-zA-z]+#",$Password)){
        /*выводит ошибку если пароль не содержит букв или цифр */
        echo "<div class='error'>";
        echo "Password should have at least 1 number and 1 letter";
        echo "</div>";
        echo "<br>";
    }
    /*if(ctype_upper($Password) || ctype_lower($Password)){
        //выводит ошибку если пароль несодержит верхнеги или нижнего регистра
        echo "<div class='error'>";
        echo "Password should include uppercase and lowercase letters";
        echo "</div>";
        echo "<br>";
    }*/
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
        <input type="text" name="username" placeholder="Enter Username" required <?php //не больше 15
        if (isset($username)){
            echo "value='".$username."'";
        }
        ?>>
        <label><b>Password:</b></label>
        <input  type="password" name="Password" placeholder="At least 8 characters" required>
        <label><b>Confirm Password:</b></label>
        <input type="password" name="ConfPassw" placeholder="Check the password" required>
        <label><b>e-mail:</b></label>
        <input type="text" name="email" placeholder="Enter e-mail" required <?php
        if (isset($email)){
            echo "value='$email'";
        }
        ?>>
        <label><b>Name:</b></label>
        <input type="text" name="Name" placeholder="Surename Name" required <?php
        if (isset($Name)){
            echo "value='".$Name."'";
        }
        ?>>
        <button type="submit" id="signin">Enter</button>
    </form>
</div>


</body>
</html>
