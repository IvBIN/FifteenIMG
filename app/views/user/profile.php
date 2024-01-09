<?php
/** @var array $sidebar - Меню */
/** @var string $role - Список товаров */
///** @var array $products - Роль пользователя */
/** @var array $item - Товар */
?>
<div class="page">
    <div class="container">
        <div class="header">
            <img class="logo" src="/app/views/images/Logo_Proshop2.png" alt="logo">
            <form class="search" method="get">
                <input type="text" placeholder="Поиск по сайту">
                <input type="submit" value="Найти">
            </form>

        </div>
        <div class="cabinet_wrapped">
            <div class="cabinet_sidebar">
                <?php if (!empty($sidebar)) : ?>
                    <div class="menu_box">
                        <ul>
                            <?php foreach ($sidebar as $link) : ?>
                                <li>
                                    <a href="<?= $link['link'] ?>"><?= $link['title'] ?></a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
            <div class="cabinet_content">
                <div class="page-content-inner">
                    <h2>Мой профиль</h2>
                    <div class="profile_items">
                        <div class="profile-block">
                            <div class="alert alert-danger <?= !empty($error_message) ? null : 'hidden' ?>">
                                <?= !empty($error_message) ? $error_message : null ?>
                            </div>
                            <div class="profile-item">
                                <div class="profile-item_title">Смена пароля</div>
                                <div class="profile-item_box">
                                    <form method="post" name="change_password">
                                        <div class="input_box">
                                            <label for="field_current_password">Текущий пароль</label>
                                            <input type="password"
                                                   name="current_password"
                                                   id="field_current_password"
                                                   class="form-control"
                                                   placeholder="Введите текущий пароль"
                                            >
                                        </div>

                                        <div class="input_box">
                                            <label for="field_new_password">Новый пароль</label>
                                            <input type="password"
                                                   name="new_password"
                                                   id="field_new_password"
                                                   class="form-control"
                                                   placeholder="Введите новый пароль"
                                            >
                                        </div>

                                        <div class="input_box">
                                            <label for="field_confirm_new_password">Повторите новый пароль</label>
                                            <input type="password"
                                                   name="confirm_new_password"
                                                   id="field_confirm_new_password"
                                                   class="form-control"
                                                   placeholder="Повторите новый пароль"
                                            >
                                        </div>

                                        <div class="button_box">
                                            <button type="submit"
                                                    name="btn_change_password_form"
                                                    id="btnChangePasswordForm"
                                                    class="btn btn-primary"
                                                    value="1"
                                            >Сменить пароль
                                            </button>
                                        </div>
                                    </form>
                                    <form method="post" enctype="multipart/form-data">
                                        <div class="input_box">
                                            <label for="avatar">Сменить аватар</label>
                                            <input type="file"
                                                   name="avatar"
                                                   id="field_avatar"
                                                   class="form-control"
                                                   maxlength="24"
                                                   placeholder="Добавьте новый аватар"
                                            >
                                        </div>

                                        <div class="button_box">
                                            <button type="submit"
                                                    name="btn_change_avatar_form"
                                                    id="btnChangeAvatarForm"
                                                    class="btn btn-primary"
                                                    value="1"
                                            >Сменить аватар
                                            </button>
                                    </form>
                                </div>

                            </div>
                        </div>
                        <div class="avatar">
                            <img src="data:image/png; base64, <?= $_SESSION['user']['avatar'] ?>" alt="avatar">
                        </div>
<!--                        <div class="buy_products">-->
<!--                            <span class="buy_info">Вами приобретено:</span><br>-->
<!--                            --><?php //if (!empty($item)) {
//                                foreach ($item as $prod) {
//                                    echo $prod[0]['title'] . "<br>";
//                                    echo $prod[0]['price'] . "<br>";
//                                    echo $prod[0]['count'] . "<br>";
//                                }
//                            } ?>
<!--                        </div>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>