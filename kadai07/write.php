<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="js/jquery-2.1.3.min.js"></script>
    <style>
        #map {
          height: 400px;
          width: 100%;
        }
    </style>

    <link rel="stylesheet" href="css/sample.css">
    <title>Planet Earth & Divers</title>

</head>

    <?php


            // ファイルに書き込み

            // $name = $_POST['name'];
            // $birthPlace = $_POST['birthPlace'];

            $ratingInput = $_POST['ratingInput'];
            $commentInput = $_POST['commentInput'];
        



            // データを整形する
            $review = $ratingInput . "<br>". $commentInput. "\n";
            // データをほぞんする
            file_put_contents('data/data.txt', $review);
            
            // file_put_contents('data/data.txt', $review, FILE_APPEND);

            //文字作成


    ?>

    <h1>Your review is submitted!</h1>

            <ul>
                <li><a href="read.php">Go to review</a></li>
                <li><a href="input.php">Back</a></li>
            </ul>
