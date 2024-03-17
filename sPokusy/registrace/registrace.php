<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Registrace</title>
    <script src="js/autentikacniOkenko.js"></script>
</head>
<body>

<form action="" method="post">

    <div>
        <div>
            <label for="">Jmeno</label>
            <input type="text" name="jmeno" id="" required>
        </div>

        <div>
            <label for="">Prijmeni</label>
            <input type="text" name="prijmeni" id="" >
        </div>

        <div>
            <label for="">Email</label>
            <input type="email" name="email" id=""> <!--nepovinne-->
        </div>

        <div>
            <label for="">Heslo</label>
            <input type="password" name="password1" id="">
        </div>

        <div>
            <label for="">Potvrzeni Hesla</label>
            <input type="password" name="password2" id="">
        </div>

        <?php
        require("regiFormCheck.php");
        ?>


    </div>
    <input type="submit" value="Odeslat">

</form>

<div id="autentikacniOkenkoDiv" style="display: none">
    <form action="" method="post">
        <p>Zadejte autentikacni znaky poslane na email</p>
        <input type="text" name="authCode" id="" maxlength="6" required>
        <input type="submit" value="Odeslat">
        <p id="chybaAutentikaceP" style="display: none">Chyba autentikace zadejte znovu</p>

        <?php
            require("authFormCheck.php")
        ?>

    </form>
</div>



</body>
</html>