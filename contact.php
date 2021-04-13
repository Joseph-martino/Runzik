<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="ressources/css/contact.css" type="text/css" />
    <title>Contact</title>
</head>
<body>

<div class="main-container">
    <section class="title-wrapper">
        <h1>On se tient au <span>courant</span></h1>
    </section>

    <section class="form-wrapper">
        <div class="form-container">
            <h2>Une <span>question</span> ? Besoin d' <span>aide</span> ? C'est par <span>ici</span></h2>
            <form  class="form" action="#" method="POST">
                <label for="name">Nom</label>
                <input id ="name" type="text" name="familyName">

                <label for="firstname">Prénom</label>
                <input id ="firstname" type="text" name="firstName">

                <label for="email">Email</label>
                <input id ="email" type="email" name="email">

                <label for="message">Message</label>
                <textarea name="message" id="message" cols="30" rows="10"></textarea>

                <input type="submit" value="Envoyer">
            </form>
        </div>

    </section>

</div>
    
    
</body>
</html>