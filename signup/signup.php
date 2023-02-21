<?php
    session_start();
    $dbconn= pg_connect("host=localhost port=5432 dbname=Bookmark user=postgres password=postgres")
    or die('Could not connect:'. pg_last_error());
    if (!(isset($_POST['signupButton']))){
        header("Location:../homepage.php");
    }
    else{
        $email = $_POST['inputEmail'];
        $name = $_POST['inputName'];
        $ql1="select * from users where email= $1";
        $ql2="select * from users where name= $1";
        $result1=pg_query_params($dbconn, $ql1, array($email));
        $result2=pg_query_params($dbconn, $ql2, array($name));

        if ($line= pg_fetch_array($result1, null, PGSQL_ASSOC)){
            echo "<h1> Attenzione, esiste già un account con la tua email</h1><br>
            <a href=../login/login.html>Clicca qui per accedere.</a><br><br>
            <a href=signup.html>o qui per registrarti</a>";
        }
        else if($line= pg_fetch_array($result2, null, PGSQL_ASSOC)){
            echo "<h1> Attenzione, esiste già un account con l'username che hai scelto</h1><br>
            <a href=../login/login.html>Clicca qui per accedere.</a><br><br>
            <a href=signup.html>o qui per registrarti</a>";
        }
        else {
            $name=$_POST['inputName'];
            $password=md5($_POST['inputPassword']);
            $q2="insert into users values ($1, $2, $3)";
            $data= pg_query_params($dbconn, $q2, array($name, $email, $password));
            if ($data){
                header("Location:../login/login.html");
            }
        }
    }
?>
            