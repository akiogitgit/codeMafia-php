<?php

namespace lib;

use model\TopicModel;
use model\UserModel;
use Throwable;

// エラー表示あり
ini_set('display_errors', 1);

class sql_operation
{
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

    // ■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■

    // 指定したIDに コメントと 賛否を INSERT
    public static function push_comment($topic_id, $agree, $body, $user_id, $updated_by)
    {
        try {
            // 構文チェック
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

    // del_flg = 1 にする
    public static function delete($topic_id)
    {
        try {
            // ユーザーと、トピックのユーザーを確かめる
            $user = UserModel::getSession();
            $user_id = $user->id;
            $topic = static::fetchByTopic($topic_id);
            $topic_user = $topic["user_id"];

            if ($user_id === $topic_user) {
                $db = dbconnect();
                $stmt = $db->prepare("UPDATE topics SEt del_flg = 1 WHERE id = :topic_id;");
                $stmt->bindValue(":topic_id", $topic_id);
                $success = $stmt->execute();
                if ($success) {
                    return true;
                }
            }
            return false;
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
            $stmt->bindValue(
                ":id",
                $topic
            );
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
}
