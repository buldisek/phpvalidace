<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validace</title>
</head>
<body>
    <div class="formular">
        <form id="myForm" method="POST">
            <input type="text" id="jmeno" name="jmeno" placeholder="Jméno">
            <input type="text" id="prijmeni" name="prijmeni" placeholder="Příjmení">
            <input type="email" id="email" name="email" placeholder="E-mail">
            <input type="tel" id="telnumber" name="telnumber" placeholder="Telefonní číslo">
            <input type="text" id="adresa" name="adresa" placeholder="Adresa">
            <input type="text" id="mesto" name="mesto" placeholder="Město">
            <textarea id="zprava" name="zprava" placeholder="Zpráva"></textarea>
            <button id="tlacitko" type="submit">Validovat</button>
        </form>
    </div>
    <div id="alert-container"></div>
    <div>
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = [];
            $data = [];

            // Získání dat z formuláře
            $jmeno = trim($_POST['jmeno'] ?? '');
            $prijmeni = trim($_POST['prijmeni'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $telnumber = trim($_POST['telnumber'] ?? '');
            $adresa = trim($_POST['adresa'] ?? '');
            $mesto = trim($_POST['mesto'] ?? '');
            $zprava = trim($_POST['zprava'] ?? '');

            // Validace na backendu
            if (!$jmeno) $errors[] = "Jméno je povinné.";
            if (!$prijmeni) $errors[] = "Příjmení je povinné.";
            if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "E-mail není platný.";
            if (!$telnumber || !preg_match('/^\+?\d{9,15}$/', $telnumber)) $errors[] = "Telefonní číslo není platné.";
            if (!$adresa) $errors[] = "Adresa je povinná.";
            if (!$mesto) $errors[] = "Město je povinné.";
            if (!$zprava) $errors[] = "Zpráva je povinná.";
            if (strlen($zprava) > 255) $errors[] = "Zpráva nesmí obsahovat více než 255 znaků.";

            // Pokud jsou chyby, vypíšeme je
            if ($errors) {
                echo "<div style='color:red;'><ul>";
                foreach ($errors as $error) {
                    echo "<li>" . htmlspecialchars($error) . "</li>";
                }
                echo "</ul></div>";
            } else {
                // Výpis odeslaných dat
                $data = [
                    'Jméno' => $jmeno,
                    'Příjmení' => $prijmeni,
                    'E-mail' => $email,
                    'Telefonní číslo' => $telnumber,
                    'Adresa' => $adresa,
                    'Město' => $mesto,
                    'Zpráva' => $zprava,
                ];

                echo "<div style='color:green;'><h3>Data přijatá serverem:</h3><ul>";
                foreach ($data as $key => $value) {
                    echo "<li><strong>$key:</strong> " . htmlspecialchars($value) . "</li>";
                }
                echo "</ul></div>";
            }
        }
        ?>
    </div>
    <script src="js/script.js"></script>
</body>
</html>
