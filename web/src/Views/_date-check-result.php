<link rel="stylesheet" href="../../public/assets/styles.css">

<!-- output -->
<main>
    <div id="data-result">
        <button onclick="window.location.href='../../public/data-check.php';" id="turn-to-back">turn-to-back</button>
<?php if ($result->num_rows > 0) : ?>
        <table border="1">
            <tr>
                <th>Timestamp</th>
                <th>Temperature</th>
                <th>Pressure</th>
                <th>Humidity</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()) : ?>
                <tr>
                    <td><?= $row["timestamp"]?></td>
                    <td><?= $row["temperature"]?>C</td>
                    <td><?= $row["pressure"]?>mBar</td>
                    <td>%<?= $row["humidity"]?></td>
                </tr>
            <?php endwhile; ?>
        </table>
<?php else : ?>
        <h1>no data</h1>
<?php endif; ?>
    </div>
</main>

<script src="../../public/assets/script.js"></script>
