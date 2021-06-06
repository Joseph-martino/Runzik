<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="ressources/css/test.css" type="text/css"/>
    <title>Document</title>
</head>
<body>
    <div class="main-container">
        <div id ="login-or-register">
            <!-- <div class="container">
                <div class="banner-title">
                    <h1>Nouvel utilisateur ?</h1>
                    <p>Rejoins une comunauté de passionnés</p>
                </div>
                <button>S'enregistrer</button>
            </div> -->

            <div class="second-container">

                <div class="form-container login-container">
                    <div class="login">
                        <div class="form-header-container">
                            <h2>Bon retour parmi <span class="orange-highlight">nous</span></h2>
                            <div class="separator-container">
                                <div class="orange-horizontal-line"></div>
                            </div>
                        </div>
                        <div class="form-wrapper">
                            <form action="#" method="POST">
                                <label for="connexion-mail">Adresse email</label>
                                <input type="email" name="connexion-email" id="connexion-mail">

                                <label for="connexion-pass">Mot de passe</label>
                                <input type="password" name ="connexion-password" id="connexion-pass">

                                <input type="hidden" name="action" value="login">

                                <button type="submit">Se connecter</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class=" form-container register-container">
                    <div class="register">
                        <div class="form-header-container">
                            <h2>Rejoignez le <span class="orange-highlight">mouvement</span></h2>
                            <div class="separator-container">
                                <div class="orange-horizontal-line"></div>
                            </div>
                        </div>
                        <div class="form-wrapper">
                            <form action="#" method="POST">
                                <label for="pseudo">Pseudo</label>
                                <input type="text" name="nickname" id="pseudo">

                                <label for="mail">Adresse email</label>
                                <input type="email" name="email" id="mail">

                                <label for="pass">Mot de passe</label>
                                <input type="password" name="password" id="pass">

                                <div class="GDPR-verification-container">
                                    <input class="checkbox" type="checkbox" id="grpr-verification" name="gdpr-verification" required>
                                    <label for="grpr-verification">j'ai lu et j'accepte les termes et conditions</label>
                                </div>

                                <input type="hidden" name="action" value="register">

                                <button type="submit">S'enregistrer</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="overlay-container">
                    <div class="overlay">
                        <div class="overlay-panel overlay-left">
                            <div>
                                <h1>Nouvel utilisateur ?</h1>
                                <p>Rejoins une comunauté de passionnés</p>
                                <button>S'enregistrer</button>
                            </div>
                        </div>

                        <div class="overlay-panel overlay-right">
                            <h1>Bon retour parmi nous</h1>
                            <p>Heureux de vous revoir, vous nous avez manqué</p>
                            <button>Se connecter</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    


    
</body>
</html>