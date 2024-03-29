<?php

namespace app\controllers;

use app\core\InitController;
use app\lib\UserOperations;
use app\models\UsersModel;

class UserController extends InitController
{
    public function behaviors()
    {
        return [
            'access' => [
                'rules' => [
                    [
                        'actions' => ['login', 'registration'],
                        'roles' => [UserOperations::RoleGuest],
                        'matchCallback' => function () {
                            $this->redirect('/user/profile');

                        }
                    ],
                    [
                        'actions' => ['profile', 'logout'],
                        'roles' => [UserOperations::RoleUser, UserOperations::RoleAdmin],
                        'matchCallback' => function () {
                            $this->redirect('/user/login');
                        }
                    ],
                    [
                        'actions' => ['users'],
                        'roles' => [UserOperations::RoleAdmin],
                        'matchCallback' => function () {
                            $this->redirect('/user/profile');
                        }
                    ],
                ]
            ]
        ];
    }
    public function actionProfile()
    {
        $this->view->title = 'Мой профиль';
        $error_message = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['btn_change_password_form'])){
            $current_password = !empty($_POST['current_password']) ? $_POST['current_password'] : null;
            $new_password = !empty($_POST['new_password']) ? $_POST['new_password'] : null;
            $confirm_new_password = !empty($_POST['confirm_new_password']) ? $_POST['confirm_new_password'] : null;

            $userModel = new UsersModel();
            $result_auth = $userModel->changePasswordByCurrentPassword(
                $current_password, $new_password, $confirm_new_password
            );
            if ($result_auth['result']) {
                $this->redirect('/user/profile');
            } else {
                $error_message = $result_auth['error_message'];
            }
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['btn_change_avatar_form'])){
//            $avatar = !empty($_FILES['avatar']['tmp_name']) ? $_FILES['avatar']['tmp_name'] : null;
            $new_avatar = !empty($_FILES['avatar']['tmp_name']) ? $_FILES['avatar']['tmp_name'] : null;

            $userModel = new UsersModel();
            $result_auth = $userModel->changeAvatar(
                $new_avatar
            );
            if ($result_auth['result']) {
                $this->redirect('/user/profile');
            } else {
                $error_message = $result_auth['error_message'];
            }
        }

//        $userModel = new UsersModel();
//        $item = $userModel->getItemId();
//        $products = $userModel->getListItem($item);
//
//        $this->render('profile', [
//            'sidebar' =>UserOperations::getMenuLinks(),
//            'item' => $products,
//            'error_message' => $error_message
//        ]);

    }

    public function actionRegistration()
    {
        $this->view->title = 'Регистрация';
        $error_message = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['btn_registration_form'])) {
            $username = !empty($_POST['username']) ? $_POST['username'] : null;
            $login = !empty($_POST['login']) ? $_POST['login'] : null;
            $password = !empty($_POST['password']) ? $_POST['password'] : null;
            $confirm_password = !empty($_POST['confirm_password']) ? $_POST['confirm_password'] : null;
            $avatar = !empty($_FILES['avatar']['tmp_name']) ? $_FILES['avatar']['tmp_name'] : null;

//            $avatar = file_get_contents($avatar);
//            $avatar = base64_encode($avatar);

            if (empty($username)) {
                $error_message .= "Введите ваше имя ! <br>";
            }
            if (empty($login)) {
                $error_message .= "Введите ваш логин ! <br>";
            }
            if (empty($password)) {
                $error_message .= "Введите пароль ! <br>";
            }
            if (empty($confirm_password)) {
                $error_message .= "Введите повторный пароль ! <br>";
            }
            if ($password != $confirm_password) {
                $error_message .= "Пароли не совпадают ! <br>";
            }
            if (empty($avatar)) {
                $error_message .= "Аватар отсутствует ! <br>";
            }
            if (empty($error_message)) {
                $userModel = new UsersModel();
                $user_id = $userModel->addNewUser($username, $login, $password, $avatar);
                if (!empty($user_id)) {
                    $this->redirect('/user/profile');
                }
            }
        }
        $this->render('registration', [
            'error_message' => $error_message
        ]);
    }

    public function actionLogin()
    {
        $this->view->title = 'Авторизация';
        $error_message = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['btn_login_form'])) {
            $login = !empty($_POST['login']) ? $_POST['login'] : null;
            $password = !empty($_POST['password']) ? $_POST['password'] : null;

            $userModel = new  UsersModel();
            $result_auth = $userModel->authBylogin($login, $password);
            if ($result_auth['result']) {
                $this->redirect('/user/profile');
            } else {
                $error_message = $result_auth['error_message'];
            }
        }
        $this->render('login', [
            'error_message' => $error_message
        ]);
    }
    public function actionLogout()
    {
        if (isset($_SESSION['user']['id'])) {
            unset($_SESSION['user']);
        }
        $params = require 'app/config/params.php';
        $this->redirect('/' . $params['defaultController'] . '/' . $params['defaultAction']);
    }

    public function actionUsers()
    {
        $this->view->title = 'Пользователи';

        $user_model = new UsersModel();
        $users = $user_model->getListUsers();

        $this->render('users', [
            'sidebar' => UserOperations::getMenuLinks(),
            'users' => $users,
            'role' => UserOperations::getRoleUser(),
        ]);
    }

}