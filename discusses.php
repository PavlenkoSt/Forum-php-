<?php
    include 'elems/connect.php';
    if(!empty($_SESSION['auth'])){

        ob_start();
        include 'elems/discusses-list.php';
        $content = ob_get_clean();

        ob_start();
        include 'elems/discuss-form.php';
        $content .= ob_get_clean();

        function addDisc($link){
            if(!empty($_POST['topic']) && !empty($_POST['category'])){
                $discuss = $_POST['topic'];
                $category_id = $_POST['category'];
                $author_id = $_SESSION['id'];
                $date = date('Y-m-d');

                $setQuery = "INSERT INTO discusses (discuss, category_id, author_id, date, admin_true) 
                    VALUES ('$discuss', '$category_id', '$author_id', '$date', '0')";
                mysqli_query($link, $setQuery) or die(mysqli_error($link));

                if(!empty($_POST['message'])){
                    $message = $_POST['message'];
                    $setMessQuery = "INSERT INTO messages SET message='$message'";
                    mysqli_query($link, $setMessQuery) or die(mysqli_error($link));

                    $idDisc = getId($link, 'discusses');
                    $idMess = getId($link, 'messages');

                    $setQuery = "INSERT INTO mess_of_diss (diss_id, mess_id, author_id, date) 
                        VALUES ('$idDisc', '$idMess', '$author_id', '$date')";
                    mysqli_query($link, $setQuery) or die(mysqli_error($link));

                    $_SESSION['mess'] = [
                        'text' => "Обсуждение успешно отправлено! Оно появится на сайте после того как пройдет проверку администратором!",
                        'status' => 'ok'
                    ];
                }
            }
        }
        function getId($link, $name){
            $getIdDisc = "SELECT MAX(id) AS id FROM $name";
            $result = mysqli_query($link, $getIdDisc) or die(mysqli_error($link));
            return mysqli_fetch_assoc($result)['id'];
        }

        addDisc($link);
    }else{
        $content = '<p>Авторизуйтесь</p><a href="login.php">Войти</a>';
    }
    $title = 'Обсуждения';
    include 'elems/layout.php';
?>