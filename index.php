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
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        if(isset($_POST['email']) && isset($_POST['text'])){
            $addmail=$_POST['email'];
            $mess=htmlspecialchars($_POST['text']);
            $listmail= explode(",", $addmail);
            if($_POST['style'][0]=="gras"){
                $mess = "<b>".$mess."</b>";
            }
            $okmail=true;
            foreach($listmail as $onemail){
                $okmail = $okmail && filter_var($onemail, FILTER_VALIDATE_EMAIL);
            }
            if ($okmail){
                try{
                    mail($addmail, 'Mon Sujet', $mess, $headers);
                } catch(Exception $e) {
                    echo 'Exception reçue : ',  $e->getMessage(), "\n";
                } finally {
            ?>
                <style>#valmess {display: block;}</style>
            <?php
                }
            }else{ ?>
                <style>#errmess {display: block;}</style>
            <?php 
            }
        }
    ?>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/js/materialize.min.js"></script>
</body>

</html>
