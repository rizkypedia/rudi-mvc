<?php
$this->layout('shared::rudi_template', array('title' => 'Uptime Service'));
echo "<h2>" . $message . "</h2>";

?>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">Link</th>
            <th scope="col">Linktext</th>
            <th scope="col">Description</th>
            <th scope="col">Status</th>
        </tr>
        </thead>
        <tbody>
 <?php
foreach ($links as $link) {
    echo "<tr>";
    echo "<td>" . $link['id'] . "</td>";
    echo "<td>" . $link['link'] . "</td>";
    echo "<td>" . $link['linkText'] . "</td>";
    echo "<td>" . $link['description'] . "</td>";
    echo "<td>" . ( $link['reachable'] === TRUE ? "Page Is Online" : "Page is Offline" ) . "</td>";
    echo "</tr>";
}
?>
        </tbody>
</table>
