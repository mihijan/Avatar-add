<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавление картинки</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/mail.css">
</head>
<body>

    <?php 

    require('libs/functions.php');
    require('libs/classSimpleImage.php');


    $isSend = false;
    $errors = [];
    
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $file = $_FILES['file'];
        if($file['name'] === '') {
            $errors[] = 'Файл не выбран';
        }

        else if(checkJpg($file['name'])) {
            $errors[] = 'Неверный формат файла';
        }
        else {
            copy($file['tmp_name'], 'img/avatars-on-server/' . $file['name']);
            list($width, $height, $type, $attr) = getimagesize('img/avatars-on-server/' . $file['name']);
            if($width > 500) {
                $image = new SimpleImage();
                $image->load('img/avatars-on-server/' . $file['name']);
                $image->resizeToWidth(500);
                $image->save('img/avatars-on-server/' . $file['name']);
            }
            $isSend= true;
        }
    }
        
    ?>


    <?php if($isSend):?>

        <div class="frame-box">
            <img class="avatar" src="img/avatars-on-server/<?= $file['name'] ?>" alt="">
            <div class="frame-foto">
                <div class="frame-foto-before"></div>
                <div class="frame-foto-after"></div>
            </div>
        </div>
        <button class="btn">Сохранить</button>
  
    <?php else:?>
        <h1 class="text-center">Добавление картинки</h1>
        <form class="image-form" method="post" enctype="multipart/form-data">
            <div class="input-wraper">
                <input type="file" name="file">
            </div>
            <br>
            <br>
            <div class="input-wraper">
                <button>Отправить</button>

                <?php foreach($errors as $error):?>
                    <p><?=$error?></p>
                <?php endforeach; ?>
            </div>
        </form>
    <?php endif?>
 

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="js/main.js"></script>
</body>
</html>