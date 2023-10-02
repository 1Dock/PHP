<?php
class Pagination
{
    private $count;
    private $perPage;
    private $currentPage;

    public function __construct($count, $perPage, $currentPage)
    {
        $this->count = $count;
        $this->perPage = $perPage;
        $this->currentPage = $currentPage;
    }

    public function render()
    {
?>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <?php
                $count = $this->count;
                $perPage = $this->perPage;
                $currentPage = $this->currentPage;

                $pagesCount = ceil($count / $perPage);
                $range = 10;

                $left = $currentPage - $range;
                $left =  $left <= 0 ? 1 : $left;

                $right = $currentPage + $range;
                $right =  $right > $pagesCount ? $pagesCount : $right;

                for ($i = $left; $i <= $right; $i++) {
                    ?>
                        <li class="page-item"><a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a></li>
                    <?php
                }
                ?>
            </ul>
        </nav>
<?php
    }
}