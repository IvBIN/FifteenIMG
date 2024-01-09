<!--Главная страница (!Delete this text!)-->
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>FifteenIMG</title>
        <link rel="stylesheet" href="/app/web/css/styles.css">
    </head>
    <body>
        <div class="page">
            <div class="container">
                <div class="header">
                    <img class="logo" src="/app/views/images/avatar01.png" alt="logo">
                    <div class="menu">
                        <span class="img_load">Загрузка картинки</span>

                        <div class="input_box">
                            <label for="picture">Загрузить картинку</label>
                            <input type="file"
                                   name="picture"
                                   id="field_picture"
                                   class="form-control"
                                   maxlength="24"
                                   placeholder="Загрузите картинку"
                            >
                        </div>

                        <button type="submit" class="scores">Ваши рекорды</button>
                    </div>
                    <img class="profile" src="/app/views/images/Profile.png" alt="profile">
                </div>
                <div class="gamefield">
                    <div class="leftpart">
                        <div class="infoblock">
                            <span class="username" id="username">Name</span>
                            <div class="scoreinfo">
                                <span class="score" id="score">0</span>
                                <span class="timer" id="timer">00:00</span>
                            </div>
                            <img src="/app/views/images/Profile.png" alt="result">
                            <span class="gametitle" id="gametitle">Fifteen IMG</span>
                        </div>
                        <button class="shufButton" id="shuffle">Перемешать</button>
                    </div>
                    <div class="game" id="game1"></div>

                </div>
            </div>
        </div>

        <script src="/app/web/script/script.js"></script>

    </body>
</html>