<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/css/materialize.min.css">
    <title> Title </title>
</head>

<body>
    <div class="row">
        <div id="errmess" class="red lighten-4 col m2 offset-m5 center-align">
            Vérifier l'adresse!
        </div>
        <div id="valmess" class="green lighten-4 col m2 offset-m5 center-align">
            Message envoyé!
        </div>
        <style>#errmess {display: none;}</style>
        <style>#valmess {display: none;}</style>
    </div>
    <div class="container">
        <h1 class="center-align">Formulaire d'envoi de mail! <br> (vive le spaaaaaaaaaaaaaaaam!)</h1>
        <div class="row">
            <div class="card-panel green lighten-4 col m6 offset-m3">
                <form action="index.php" method="POST">
                    <div class="input-field">
                        <label for="email">Adresse e-mail: </label>
                        <input type="email" name="email" multiple>
                    </div>
                    <br>
                    <div class="input-field">
                        <label for="text">Corps du mail: </label>
                        <textarea name="text" class="materialize-textarea" maxlength="500"></textarea>
                    </div>
                    <label><input type="checkbox" name="style[]" value="gras" /><span>Gras</span></label><br>
                    <input type="submit" value="Envoyer" class="waves-effect waves-light btn-large">
                </form>
            </div>
        </div>
    </div>

    <?php
        //fonction qui vérifie si une liste d'email est correctement formatée
        //(le type email dans le form oblige à avoir un @ mais ne vérifie pas si un mail est de la forme xxxxx@yyyy.zzz)
        function isValidMail($varListMail){
            $okmail=true;
            foreach($varListMail as $onemail){
                $okmail = $okmail && filter_var($onemail, FILTER_VALIDATE_EMAIL);
            }
            return $okmail;
        }
        function formatMessage($message){
            if (!$message) {
                throw new Exception('Message Vide.');
            }
            //escape html char + adding carret return
            $messFormated =nl2br(htmlspecialchars($message));
            //here is emoji display
            $messFormated = str_replace(":)", "&#x1f60a;", $messFormated); // :)
            $messFormated = str_replace("B)", "&#x1f60e;", $messFormated); // B)
            $messFormated = str_replace(":(", "&#x2639e;", $messFormated); // :(
            $messFormated = str_replace(":'(", "&#x1f622;", $messFormated); // :'(
            $messFormated = str_replace(":|", "&#x1f610;", $messFormated); // :|
            return $messFormated;
        }
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'From: groutch@groutch.gro' . "\r\n";
        if(isset($_POST['email']) && isset($_POST['text'])){
            try{
                $mess = formatMessage($_POST['text']);
            }catch(Exception $e){
                 echo 'Exception reçue : ',  $e->getMessage(), "\n";
            }
            $addmail=$_POST['email'];
            $listmail= explode(",", $addmail);
            if($_POST['style'][0]=="gras"){
                $mess = "<b>".$mess."</b>";
            }
            if (isValidMail($listmail)){
                mail($addmail, 'Mon Sujet', $mess, $headers);
            ?>
                <style>#valmess {display: block;}</style>
            <?php
            }else{
                ?>
                <style>#errmess {display: block;}</style>
            <?php 
            }
        }
    ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/js/materialize.min.js"></script>
</body>

</html>
