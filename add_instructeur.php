<?php
include_once '../database/database.php';
include_once '../instructeur/Instructeur.php';


$instructeur = new Instructeur();
$autos = $instructeur->getAutos();
$success = null;
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $naam = $_POST['naam'] ?? '';
    $email = $_POST['email'] ?? '';
    $wachtwoord = $_POST['wachtwoord'] ?? '';
    $auto_id = !empty($_POST['auto_id']) ? $_POST['auto_id'] : null;

    try {
        $result = $instructeur->createInstructeur($naam, $email, $wachtwoord, $auto_id);
        if ($result) {
            $success = "Instructeur succesvol aangemaakt!";
        } else {
            $error = "Aanmaken mislukt.";
        }
    } catch (Exception $e) {
        $error = "Fout bij aanmaken: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Nieuwe Instructeur</title>
</head>
<body>
<?php include_once '../header/header.php'; ?>
    <h1>Instructeur account  Aanmaken</h1>

    <?php if ($success): ?>
        <p style="color: green"><?= $success ?></p>
    <?php elseif ($error): ?>
        <p style="color: red"><?= $error ?></p>
    <?php endif; ?>

    <form method="POST">
        <input type="text" name="naam" placeholder="Naam" required><br><br>
        <input type="email" name="email" placeholder="E-mail" required><br><br>
        <input type="password" name="wachtwoord" placeholder="Wachtwoord" required><br><br>

        <label for="auto_id">Kies een auto :</label><br>
        <select name="auto_id">
            <option value=""> Selecteer </option>
            <?php foreach ($autos as $auto): ?>
                <option value="<?= $auto['id'] ?>">
                    <?= htmlspecialchars($auto['merk'] . ' ' . $auto['model']) ?>
                </option>
            <?php endforeach; ?>
        </select><br><br>

        <button type="submit" name="submit">Aanmaken</button>
    </form>
</body>
</html>