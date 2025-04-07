<?php
session_start();
include_once '../lessen/les.php';

$lesObj = new Les();
$leerlingId = $_SESSION['user_id']; // Zorg dat leerling is ingelogd
$lessen = $lesObj->getLessenVoorLeerling($leerlingId);
$melding = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $lesId = $_POST['les_id'];
    $opmerking = $_POST['opmerking'];

    if ($lesObj->voegLeerlingOpmerkingToe($lesId, $opmerking, $leerlingId)) {
        $melding = "Opmerking succesvol toegevoegd!";
    } else {
        $melding = "Je kunt geen opmerking toevoegen aan deze les.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Voeg leerling-opmerking toe</title>
</head>
<body>
    <h2>Voeg een opmerking toe aan jouw les</h2>

    <?php if ($melding): ?>
        <p><strong><?= $melding ?></strong></p>
    <?php endif; ?>

    <form method="POST">
        <label for="les_id">Kies les:</label>
        <select name="les_id" required>
            <?php foreach ($lessen as $les): ?>
                <option value="<?= $les['id'] ?>">
                    <?= $les['datum'] ?> om <?= $les['tijd'] ?> (<?= $les['ophaallocatie'] ?>)
                </option>
            <?php endforeach; ?>
        </select>

        <br><br>

        <label for="opmerking">Jouw opmerking:</label><br>
        <textarea name="opmerking" rows="4" cols="50" required></textarea>

        <br><br>
        <button type="submit">Verstuur</button>
    </form>
</body>
</html>
