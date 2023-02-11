<?php
        session_start();
            $dbconn= pg_connect("host=localhost port=5432 dbname=Bookmark user=postgres password=postgres")
                or die('Could not connect:'. pg_last_error());
                if (!(isset($_POST['signupButton']))){
                    header("Location:../homepage.php");
                }
                else{
                    $email = $_POST['inputEmail'];
                    $ql=" select * from users where email= $1";
                    $result=pg_query_params($dbconn, $ql, array($email));
                    if ($line= pg_fetch_array($result, null, PGSQL_ASSOC)){
                        echo "<h1> Attenzione, esiste già un account con la tua email <br>o l'username è già stato scelto</h1>
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
    </body>
</html>
            