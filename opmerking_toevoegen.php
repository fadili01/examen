<?php
include_once '../lessen/Les.php';

$lesObj = new Les();
$leerlingId = 1; // Dit zou uit de sessie komen, bijvoorbeeld: $_SESSION['leerling_id'];

$lessen = $lesObj->getLessenVoorLeerling($leerlingId);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $lesId = $_POST['les_id'];
    $opmerking = $_POST['opmerking'];

    if ($lesObj->voegOpmerkingToe($lesId, $opmerking, $leerlingId)) {
        echo "Opmerking toegevoegd!";
    } else {
        echo "Fout bij toevoegen. Zorg ervoor dat je de opmerking voor een gekoppelde les toevoegt.";
    }
}
?>

<h2>Opmerking Toevoegen</h2>

<form method="POST">
    <label for="les_id">Kies een les:</label>
    <select name="les_id" required>
        <?php foreach ($lessen as $les): ?>
            <option value="<?php echo $les['id']; ?>"><?php echo $les['datum']; ?> - <?php echo $les['tijd']; ?></option>
        <?php endforeach; ?>
    </select><br>

    <label for="opmerking">Opmerking:</label>
    <textarea name="opmerking" required></textarea><br>

    <button type="submit">Opmerking Toevoegen</button>
</form>