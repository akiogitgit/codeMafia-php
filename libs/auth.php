<?php
// リファクタリング　index.phpで読み込み、
// 使う所で use lib\Auth;  Auth::login()
namespace lib;

use model\TopicModel;
use model\UserModel;
use Throwable;

// エラー表示あり
ini_set('display_errors', 1);

class Auth
{
    public static function login($id, $pwd)
    {
        try {
            if (
                !(UserModel::validateId($id)
                    * UserModel::validatePassWord($pwd))
            ) {
                return false;
            }
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

                    // UserModelに登録 (クラス)
                    $User =  new UserModel;
                    $User->id = $user_info["id"];
                    $User->pwd = $user_info["pwd"];
                    $User->nickname = $user_info["nickname"];
                    // session にユーザーを保持
                    // $_SESSION["user"] = $user_info;
                    UserModel::setSession($User);
                } else {
                    Msg::push(Msg::ERROR, "パスワードが一致しないよ");
                }
            } else {
                Msg::push(Msg::ERROR, "ユーザーが見つかりません");
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
            // これだと、1つのエラーしか表示されない
            // if(!UserModel::validateId($User->id) ||
            // !UserModel::validatePassWord($User->pwd) ||
            // !UserModel::validateNickname($User->nickname))

            // id, pwd, nick の構文チェック user.model.php
            if (
                !(UserModel::validateId($User->id)
                    * UserModel::validatePassWord($User->pwd)
                    * UserModel::validateNickname($User->nickname))
            ) {
                return false;
            }
            $is_success = false;

            require_once "./dbconnect.php";
            $db = dbconnect();
            $user = $db->prepare("select * from users where id = :id;");
            $user->bindValue(":id", $User->id);
            $user->execute();
            $exit_user = $user->fetch();
            // var_dump($user_info);
            // echo "<br>pwd = " . $user_info["pwd"];

            if (!empty($exit_user)) {
                Msg::push(Msg::ERROR, "ユーザーが既に存在します。");
                return false;
            }
            $new_user = $db->prepare("insert into users(id,pwd,nickname) values(:id,:pwd,:nickname);");
            // pwd はハッシュ化
            $pwd_hash = password_hash($User->pwd, PASSWORD_DEFAULT);
            $new_user->bindValue(":id", $User->id);
            $new_user->bindValue(":pwd", $pwd_hash);
            $new_user->bindValue(":nickname", $User->nickname);
            $is_success = $new_user->execute();

            if ($is_success) {
                // UserModelで定義した クラスを渡す
                UserModel::setSession($User);
            }
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

    public static function LogOut()
    {
        try {
            UserModel::clearSession();
        } catch (Throwable $e) {
            Msg::push(Msg::DEBUG, $e->getMessage());
            return false;
        }
        return true;
    }


    // ログインしてないと、見れない設定
    public static function requireLogin()
    {
        if (!static::isLogin()) {
            Msg::push(Msg::ERROR, "ログインしてください");
            redirect("login");
        }
    }

    // 全ての投稿　非公開は取らない
    public static function fetchByAllPost()
    {
        try {
            $db = dbconnect();
            // $stmt = $db->prepare("select * from topics where del_flg !=1 and published !=0  order by id desc;");
            $stmt = $db->prepare("select t.*,u.nickname from topics t
                                INNER JOIN users u ON t.user_id = u.id
                                where t.del_flg !=1 and u.del_flg !=1 and t.published !=0  order by t.id desc;");
            $success = $stmt->execute();

            // 投稿してない場合は、false
            if (!$success) {
                Msg::push(Msg::INFO, "過去の投稿はありません");
                return false;
            }
            $result = $stmt->fetchAll();
            return $result;
        } catch (Throwable $e) {
            Msg::push(Msg::DEBUG, $e->getMessage());
            return false;
        }
    }

    // 自分の過去の投稿 非公開も取ってくる
    public static function fetchByUserId($user)
    {
        try {
            $db = dbconnect();
            $stmt = $db->prepare("select * from topics where user_id = :id and del_flg !=1 order by id desc;");
            $stmt->bindValue(":id", $user);
            $success = $stmt->execute();

            // 投稿してない場合は、false
            if (!$success) {
                Msg::push(Msg::INFO, "過去の投稿はありません");
                return false;
            }
            $result = $stmt->fetchAll();
            return $result;
        } catch (Throwable $e) {
            Msg::push(Msg::DEBUG, $e->getMessage());
            return false;
        }
    }

    // トピックIDから、情報取得 nicknameも
    public static function fetchByTopic($id)
    {
        try {
            $db = dbconnect();
            $stmt = $db->prepare("select t.*,u.nickname from topics t, users u
            where t.user_id=u.id and t.del_flg !=1 and t.id=:id;");
            $stmt->bindValue(":id", $id);
            $success = $stmt->execute();

            // 投稿がない
            if (!$success) {
                return false;
            }
            $result = $stmt->fetch();
            return $result;
        } catch (Throwable $e) {
            Msg::push(Msg::DEBUG, $e->getMessage());
            return false;
        }
    }

    // 投稿IDの、コメント取得　nicknameも
    public static function fetchByAllComments($id)
    {
        try {
            $db = dbconnect();
            $stmt = $db->prepare("select c.*,u.nickname from comments c,users u
            where c.user_id = u.id and c.del_flg !=1 and u.del_flg !=1 and c.topic_id = :id order by id desc;");
            $stmt->bindValue(":id", $id);
            $success = $stmt->execute();

            // 投稿してない場合は、false
            if (!$success) {
                Msg::push(Msg::INFO, "コメントはありません");
                return false;
            }
            $result = $stmt->fetchAll();
            return $result;
        } catch (Throwable $e) {
            Msg::push(Msg::DEBUG, $e->getMessage());
            return false;
        }
    }


    // 指定したIDの　title published を UPDATE
    public static function update($id, $title, $published)
    {
        try {
            if (!(TopicModel::validateTitle($title))) {
                return false;
            }
            $success = false;

            $db = dbconnect();
            $stmt = $db->prepare("UPDATE topics SET title = :title, published = :published WHERE id = :id");
            $stmt->bindValue(":id", $id);
            $stmt->bindValue(":title", $title);
            $stmt->bindValue(":published", $published);
            $success = $stmt->execute();

            // 投稿してない場合は、false
            if (!$success) {
                Msg::push(Msg::ERROR, "その投稿はありません");
                return false;
            }
            return true;
        } catch (Throwable $e) {
            Msg::push(Msg::DEBUG, $e->getMessage());
            return false;
        }
    }

    // 指定したIDに コメントと 賛否を INSERT
    public static function push_comment($topic_id, $agree, $body, $user_id, $updated_by)
    {
        try {
            if (!TopicModel::validateComment($body)) {
                return false;
            }
            if (is_null($agree)) {
                Msg::push(Msg::ERROR, "賛成か反対を選択ししてください");
                return false;
            }

            $db = dbconnect();
            $stmt = $db->prepare("INSERT INTO comments(topic_id, agree, body, user_id, updated_by) VALUES (:topic_id,:agree,:body,:user_id,:updated_by)");
            $stmt->bindValue(":topic_id", $topic_id);
            $stmt->bindValue(":agree", $agree);
            $stmt->bindValue(":body", $body);
            $stmt->bindValue(":user_id", $user_id);
            $stmt->bindValue(":updated_by", $updated_by);
            $success = $stmt->execute();

            // 投稿してない場合は、false
            if (!$success) {
                Msg::push(Msg::ERROR, "コメントの追加に失敗しました。");
                return false;
            }
            return true;
        } catch (Throwable $e) {
            Msg::push(Msg::DEBUG, $e->getMessage());
            return false;
        }
    }

    // トピック押したら View を増やす　　　　topic_id
    public static function incrementViewCount($topic)
    {
        if (!$topic) {
            return false;
        }
        try {
            $db = dbconnect();
            $stmt = $db->prepare("UPDATE topics SET views = views + 1 WHERE id = :id");
            $stmt->bindValue(":id", $topic);
            $success = $stmt->execute();

            // 投稿してない場合は、false
            if (!$success) {
                Msg::push(Msg::ERROR, "Viewsの追加に失敗しました。");
                return false;
            }
            return true;
        } catch (Throwable $e) {
            Msg::push(Msg::DEBUG, $e->getMessage());
            return false;
        }
    }

    // 指定したIDに コメントと 賛否を INSERT
    public static function create_topic($title, $published)
    {
        try {
            if (!(TopicModel::validateTitle($title))) {
                return false;
            }
            $success = false;

            $User = UserModel::getSession();
            $user_id = $User->id;
            $updated_by = $User->nickname;

            $db = dbconnect();
            $stmt = $db->prepare("INSERT INTO topics(title,published, user_id, updated_by) VALUES (:title,:published,:user_id,:updated_by);");
            $stmt->bindValue(":title", $title);
            $stmt->bindValue(":published", $published);
            $stmt->bindValue(":user_id", $user_id);
            $stmt->bindValue(":updated_by", $updated_by);
            $success = $stmt->execute();

            // 投稿してない場合は、false
            if (!$success) {
                Msg::push(Msg::ERROR, "トピックの追加に失敗しました。");
                return false;
            }
            return true;
        } catch (Throwable $e) {
            Msg::push(Msg::DEBUG, $e->getMessage());
            return false;
        }
    }
}
