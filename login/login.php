<?php
        session_start();
        if (!(isset($_POST['loginButton']))){        
                header("Location: ../homepage.php");
        }
        else{
            $dbconn= pg_connect("host=localhost port=5432 dbname=Bookmark user=postgres password=postgres")
                or die('Could not connect: '. pg_last_error());
            $email=$_POST['inputEmail'];
            $q1="select * from users where email=$1";
            $result=pg_query_params($dbconn, $q1, array($email));
            if (!($line=pg_fetch_array($result, null, PGSQL_ASSOC))){
                echo "<h1>Attenzione, non sei un utente registrato</h1>
                    <a href=../signup/signup.html>Clicca qui per registrarti</a>";
            }
            else{
                $password=md5($_POST['inputPassword']);
                $q2="select * from users where email=$1 and password=$2";
                $result=pg_query_params($dbconn, $q2, array($email, $password));
                if (!($line=pg_fetch_array($result, null, PGSQL_ASSOC))){
                    echo "<h1>Password errata.</h1>
                    <a href=../login/login.html>Clicca qui per riprovare.</a>";
                }
                else{
                    $nome = $line['name'];
                    $_SESSION["username"]=$nome;
                    header("Location: ../homepage.php");
                }
            }
        }
?>