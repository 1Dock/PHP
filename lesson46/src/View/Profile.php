<?php
class Profile extends Layout
{
    protected function content($result = '')
    {
?>
        <table class="table table-bordered table-hover">
            <tbody>
                <tr>
                    <td>Surname</td>
                    <td><?= $result['passenger']['firstname'] ?> <?= $result['passenger']['lastname'] ?></td>
                </tr>
                <tr>
                    <td>Count Booking</td>
                    <td><?= $result['passenger']['count'] ?></td>
                </tr>
            </tbody>
        </table>
<?php
        $this->stat($result['countries-from']);
        $this->stat($result['countries-to']);
    }

    protected function stat($data = '')
    {
?>
        <table class="table table-bordered table-hover">
            <tbody>
            <?php
                $amount = 0;
                foreach ($data as $row) {
            ?>
                    <tr>
                        <td><?= $row['country'] ?></td>
                        <td><?= $row['count'] ?></td>
                    </tr>
            <?php
                    $amount += $row['count'];
                }
            ?>
                <tr>
                    <td>Result</td>
                    <td><?= $amount ?></td>
                </tr>
            </tbody>
        </table>
<?php
    }
}