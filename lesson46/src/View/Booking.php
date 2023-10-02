<?php
class Booking extends Layout
{
    protected function content($result = '')
    {
?>
    <table class="table table-bordered table-hover">
        <thead>
        <tr>
            <th>Surname</th>
            <th>Passportno</th>
            <th>Trajectory</th>
            <th>Price</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($result['data'] as $row) {
        ?>
            <tr>
                <td>
                    <a href="/profile.php?pid=<?= $row['passenger_id'] ?>">
                        <?= $row['firstname'] . ' ' . $row['lastname'] ?>
                    </a>
                </td>
                <td><?= $row['passportno'] ?></td>
                <td><?= $row['country_from'] . ' (' . $row['city_from'] . ') - (' . $row['country_to'] . ') ' . $row['city_to'] ?></td>
                <td><?= $row['price'] ?></td>
            </tr>
        <?php
        }
        ?>
        </tbody>
    </table>
<?php
    $result['pagination']->render();
    }
}