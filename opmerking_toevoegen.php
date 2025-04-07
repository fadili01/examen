<?php
include_once '../lessen/Les.php';

$lesObj = new Les();
$instructeurId = 5; // Dit moet dynamisch komen, bijv. uit sessie of URL

$lessen = $lesObj->getLessenVoorInstructeur($instructeurId);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $lesId = $_POST['les_id'];
    $opmerking = $_POST['opmerking'];

    if ($lesObj->voegOpmerkingToe($lesId, $opmerking)) {
        echo "Opmerking toegevoegd!";
    } else {
        echo "Fout bij toevoegen.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h2>Les Opmerkingen Toevoegen</h2>

<form method="POST">
    <label for="les_id">Kies een leerling:</label>
    <select name="les_id" required>
        <?php if (empty($lessen)): ?>
            <option disabled>Geen lessen gevonden voor deze instructeur.</option>
        <?php else: ?>
            <?php foreach ($lessen as $les): ?>
                <option value="<?php echo $les['id']; ?>">
                    <?php echo $les['leerling_naam']; ?> - <?php echo $les['datum']; ?> - <?php echo $les['tijd']; ?>
                </option>
            <?php endforeach; ?>
        <?php endif; ?>
    </select><br>

    <label for="opmerking">Opmerking:</label>
    <textarea name="opmerking" required></textarea><br>

    <button type="submit">Opmerking Toevoegen</button>
</form>
</body>
</html>