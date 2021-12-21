<?php
// リファクタリング　index.phpで読み込み、
// 使う所で use lib\Auth;  Auth::login()
namespace lib;

use model\UserModel;
use Throwable;

// エラー表示あり
ini_set('display_errors', 1);

class Auth
{
    public static function login($id, $pwd)
    {
        try {
            $is_success = false;

            require_once "./dbconnect.php";
            $db = dbconnect();
            $user = $db->prepare("select * from users where id = :id;");
            $user->bindValue(":id", $id);
            $success_execute = $user->execute();
            $user_info = $user->fetch();
            // var_dump($user_info);
            // echo "<br>pwd = " . $user_info["pwd"];

            if ($success_execute && !empty($user_info["id"]) && $user_info["del_flg"] !== 1) {
                if (password_verify($pwd, $user_info["pwd"])) {
                    $is_success = true;
                    // session にユーザーを保持
                    // $_SESSION["user"] = $user_info;
                    UserModel::setSession($user_info);
                } else {
                    echo "<br>パスワードが一致しないよ<br>";
                }
            } else {
                echo "<br>ユーザーが見つかりません";
            }
        } catch (Throwable $e) {
            $is_success = false;
            Msg::push(Msg::DEBUG, $e->getMessage());
            Msg::push(Msg::ERROR, "ログインの処理でエラーが発生しました。");
        }
        return $is_success;
    }

    // 登録の処理　idが重複しないか　確認 idはprimaryじゃない！
    public static function register($User)
    {
        try {
            if (!UserModel::validateId($User->id)) {
                return false;
            }
            $is_success = false;

            require_once "./dbconnect.php";
            $db = dbconnect();
            $user = $db->prepare("select * from users where id = :id;");
            $user->bindValue(":id", $User->id);
            $success_execute = $user->execute();
            $exit_user = $user->fetch();
            // var_dump($user_info);
            // echo "<br>pwd = " . $user_info["pwd"];

            if (!empty($exit_user)) {
                echo "ユーザーが既に存在します。名前を変えなさい";
                return false;
            }
            $new_user = $db->prepare("insert into users(id,pwd,nickname) values(:id,:pwd,:nickname);");
            $pwd_hash = password_hash($User->pwd, PASSWORD_DEFAULT);
            $new_user->bindValue(":id", $User->id);
            $new_user->bindValue(":pwd", $pwd_hash);
            $new_user->bindValue(":nickname", $User->nickname);
            $is_success = $new_user->execute();

            if ($is_success) {
                UserModel::setSession($User);
            }

            echo "登録成功だよ";
        } catch (Throwable $e) {
            $is_success = false;
            Msg::push(Msg::DEBUG, $e->getMessage());
            Msg::push(Msg::ERROR, "登録の処理でエラーが発生しました。");
        }
        return $is_success;
    }

    public static function isLogin()
    {
        try {
            $user_session_now = UserModel::getSession();
        } catch (Throwable $e) {
            UserModel::clearSession();
            Msg::push(Msg::DEBUG, $e->getMessage());
            Msg::push(Msg::ERROR, "エラーが発生しました。");
            return false;
        }
        if (isset($user_session_now)) {
            return true;
        } else {
            return false;
        }
    }
}