<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<!-- BS CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<title>Formulaire de connexion en AJAX</title>
</head>
<body>
    <section class="text-center">
        <h1>Formulaire de connexion</h1>
        <form id="newForm" method="post" action="regexTest.php">
        <p>Nom <input type="text" name="lastName" /></p>
        <p>Prénom <input type="text" name="firstName" /></p>
        <p>Mail <input type="text" name="eMail" /></p>
        <p>Mot de passe <input type="password" name="passWord" /></p>
        <p><input type="submit" name="submit" value="Se connecter" /></p>
        </form>
    </section>
    <?php
    // Variables REGEX :
    // $regex_lastName = '/^[A-Z|a-z]+[a-z]{3,16}$/m ';

    
    // Minimum eight characters, at least one uppercase letter, one lowercase letter, one number and one special character:
    $regex_passWord_high = "#^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$#";
    
    // Minimum eight characters, at least one letter and one number:
    $regex_passWord_average = "#^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$#";
     

    // Fonction REGEX
    function regeX($post)
    {
        $regex_lastName = "#^[a-zA-Z-éèëëïàù]+$#";
        $regex_firstName ="#^[a-zA-Z-éèëëïàù]+$#";
        $regex_eMail = "#[0-9a-zA-Z\.\-]+@[0-9a-zA-Z\.\-]+.[a-zA-Z]{2,4}#";

        if( (isset($_POST['lastName'])) && (isset($_POST['firstName'])) && (isset($_POST['eMail'])) )
        {
        // Tableau des regex :
        $tab_regex = array(
        $_POST['lastName'] => $regex_lastName,
        $_POST['firstName'] => $regex_firstName,
        $_POST['eMail'] => $regex_eMail
        );
    
        // Tableau termes des "post" :
        $tab_regex_name = array(
            $_POST['lastName'] => "nom",
            $_POST['firstName'] => "prénom",
            $_POST['eMail'] => "mail"
        );
         
        var_dump($post);
        var_dump(!preg_match($tab_regex[$post], $post));

        if(!preg_match($tab_regex[$post], $post))
        {
        echo 'Veuillez saisir un '.$tab_regex_name[$post]. ' valide';

        echo '<br>';
        }
        }
    }

    if(isset($_POST['submit']))
    {

    regeX($_POST['lastName']);
    regeX($_POST['firstName']);
    regeX($_POST['eMail']);
    // var_dump($tab_regex_name);
    




    // PASSWORD
    if( (!isset($_POST['passWord'])) )
    {
        echo 'Veuillez saisir un mot de passe valide !';
    }

    // SECURITY PASSWORD 
    if(isset($_POST['passWord']))
    {
    $msg =
    (preg_match($regex_passWord_high, $_POST['passWord'])) ? 'Sécurité élevée !' :
     ((preg_match($regex_passWord_average, $_POST['passWord'])) ? 'Sécurité Moyenne !' : 'Sécurité Faible!');

    echo $msg;
    }
}
else
{
    echo "toto";
}
?>
    <!-- Scripts -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
</body>
</html>