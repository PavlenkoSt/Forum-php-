<section class="row">
    <h2><?=$data[0]['discuss']?></h2>
    <?php
        foreach ($data as $item):

    ?>
        <hr class="mb-0">
        <div class="col-3 bg-info bg-gradient d-flex align-items-end p-2">
            <div class="fw-bold 
                <?php
                    if($item['status_id'] == 2){
                        echo 'text-warning';
                    }
                ?>
            "><?=$item['login']?></div>
        </div>
        <div class="col-9 bg-light bg-gradient p-0">
            <small class="p-2"><?=$item['date']?></small>
            <hr class="mt-0">
            <p class="p-2"><?=$item['message']?></p>
        </div>
        <?php
            if($_SESSION['status'] == 'admin'){
                ?>
                <form action="" method="POST" class="p-0">
                    <input type="hidden" name="delete" value="<?=$item['mesID']?>">
                    <input type="submit" class="btn btn-danger w-100 d-flex justify-content-center" style="border-radius:0;" value="Удалить">
                </form>
                <?php
            }
        ?>
        <hr>
    <?php
        endforeach;
    ?>
</section>