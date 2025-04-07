<?php
include_once '../lessen/Les.php';

$lesObj = new Les();
$instructeurId = 5; // Dit moet dynamisch komen, bijv. uit sessie of URL

$lessen = $lesObj->getLessenVoorInstructeur($instructeurId);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $lesId = $_POST['les_id'];
    $opmerking = $_POST['opmerking'];

    if ($lesObj->voegInstructeurOpmerkingToe($lesId, $opmerking, $instructeurId)) {

        echo "Opmerking toegevoegd!";
    } else {
        echo "Fout bij toevoegen.";
    }
}
?>

<h2>Les Opmerkingen Toevoegen</h2>

<form method="POST">
    <label for="les_id">Kies een leerling:</label>
    <select name="les_id" required>
        <?php foreach ($lessen as $les): ?>
            <option value="<?php echo $les['id']; ?>"><?php echo $les['leerling_naam']; ?> - <?php echo $les['datum']; ?> - <?php echo $les['tijd']; ?></option>
        <?php endforeach; ?>
    </select><br>

    <label for="opmerking">Opmerking:</label>
    <textarea name="opmerking" required></textarea><br>

    <button type="submit">Opmerking Toevoegen</button>
</form>
