<?php
    if(!empty($_SESSION['mess'])){
        if($_SESSION['mess']['status'] == 'ok'){
            $class = 'text-success';
        }elseif($_SESSION['mess']['status'] == 'err'){
            $class = 'text-danger';
        }
        echo "<p class=\"$class fw-bold mb-1\">{$_SESSION['mess']['text']}</p>";
        unset($_SESSION['mess']);
    }
?>