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

  <body>
    <h1>Scuba Diving Map</h1>
    <div id="map"></div>

    <div>
       <h2> Review </h2>

     <?php
        // ファイルを読み込む

        $revieçw = file_get_contents('data/data.txt');

        // 読み込んだものをブラウザに表示する
        // 'My review of this site is' 
         echo nl2br($revieçw);

        ?>

</div>

<script>
    // Google Maps APIキーを設定
    const apiKey = '';


      // スポットのコメントデータ
      let spotComments = [
        { location: { lat: 34.0522, lng: -118.2437 }, comment: 'Great spot for diving!', rating: 4 },
        { location: { lat: 51.5074, lng: -0.1278 }, comment: 'Awesome underwater views!', rating: 5 },
        // 追加のスポットコメントをここに追加できます
      ];

      // Google Maps JavaScript APIを読み込む
      function loadMapScript() {
        const script = document.createElement('script');
        script.src = `https://maps.googleapis.com/maps/api/js?key=${apiKey}&callback=initMap`;
        script.defer = true;
        document.head.appendChild(script);
      }

      // マップを初期化して表示する
      function initMap() {
        const map = new google.maps.Map(document.getElementById('map'), {
          center: { lat: 0, lng: 0 },
          zoom: 2,
        });

        // マップクリック時のイベントを追加
        map.addListener('click', (event) => {
          openCommentForm(event.latLng);
        });

        // スポットコメントを表示する
        spotComments.forEach((spot) => {
          const marker = new google.maps.Marker({
            position: spot.location,
            map: map,
          });

          const infoWindow = new google.maps.InfoWindow({
            content: createInfoWindowContent(spot),
          });

          marker.addListener('click', () => {
            infoWindow.open(map, marker);
          });
        });
      }

      // コメントフォームを開く
      function openCommentForm(latLng) {
        const commentForm = document.getElementById('commentForm');
        commentForm.style.display = 'block';

        // 緯度と経度を入力
        document.getElementById('latInput').value = latLng.lat();
        document.getElementById('lngInput').value = latLng.lng();

        // フォームを送信すると、新しいコメントが追加されます
        commentForm.addEventListener('submit', (event) => {
          event.preventDefault();

          // 入力値を取得
          const commentInput = document.getElementById('commentInput').value;
          const ratingInput = document.getElementById('ratingInput').value;

          // 新しいコメントを追加
          const newComment = {
            location: {
              lat: parseFloat(document.getElementById('latInput').value),
              lng: parseFloat(document.getElementById('lngInput').value),
            },
            comment: commentInput,
            rating: parseInt(ratingInput),
          };

          spotComments.push(newComment);

          // マップ上に新しいコメントを表示する
          const marker = new google.maps.Marker({
            position: newComment.location,
            map: map,
          });

          const infoWindow = new google.maps.InfoWindow({
            content: createInfoWindowContent(newComment),
          });

          marker.addListener('click', () => {
            infoWindow.open(map, marker);
          });

          // 入力フィールドをクリアする
          document.getElementById('latInput').value = '';
          document.getElementById('lngInput').value = '';
          document.getElementById('commentInput').value = '';
          document.getElementById('ratingInput').value = '1';

          // コメントフォームを非表示にする
          commentForm.style.display = 'none';
        });
      }

      // コメントの情報ウィンドウの内容を作成する
      function createInfoWindowContent(comment) {
        return `<div>
          <p>${comment.comment}</p>
          <p>Rating: ${comment.rating}</p>
        </div>`;
      }

      // ページの読み込みが完了したら地図を読み込む
      window.onload = loadMapScript;
    </script>

<footer><small>Chika Iwanaga</small></footer>
</body>
</html>

     







