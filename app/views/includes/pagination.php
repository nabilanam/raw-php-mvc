<?php $page = $data['page']; ?>
<nav aria-label="Page navigation example" class="text-right pt-2">
    <ul class="pagination d-inline-block">
        <li class="d-inline-block"><a class="page-link" href="?page=1">First</a></li>
        <li class="page-item d-inline-block <?php if ($page <= 1) {
                                                echo 'disabled';
                                            } ?>">
            <a class="page-link" href="<?php if ($page <= 1) {
                                            echo '#';
                                        } else {
                                            echo "?page=" . ($page - 1);
                                        } ?>">Prev</a>
        </li>
        <li class="page-item d-inline-block <?php if ($page >= $data['pageCount']) {
                                                echo 'disabled';
                                            } ?>">
            <a class="page-link" href="<?php if ($page >= $data['pageCount']) {
                                            echo '#';
                                        } else {
                                            echo "?page=" . ($page + 1);
                                        } ?>">Next</a>
        </li>
        <li class="page-item d-inline-block"><a class="page-link" href="?page=<?php echo $data['pageCount']; ?>">Last</a></li>
    </ul>
</nav>