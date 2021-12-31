<?php


namespace lib;

// エラー表示あり
ini_set('display_errors', 1);

use model\AbstractModel;
use Throwable;

//abstract.model の関数を使って、sessionを操作する。

class Msg extends AbstractModel
{
    protected static $SESSION_NAME = "_msg";

    // session 上に保持する種類
    public const ERROR = "error";
    public const INFO = "info";
    public const DEBUG = "debug";

    // session setする
    public static function push($type, $msg)
    {
        // 配列でないなら、初期化
        if (!is_array(static::getSession())) {
            static::init();
        }

        $msgs = static::getSession();
        $msgs[$type][] = $msg;
        static::setSession($msgs);
    }

    // session を表示
    public static function flush()
    {
        try {
            // この関数で、取得した瞬間、sessionが削除されて残らない
            $msgs_with_type = static::getSessionFlush() ?? [];
            foreach ($msgs_with_type as $type => $msgs) {
                if ($type === static::DEBUG && !DEBUG) {
                    // DEBUGがtrueの時、下が実行
                    continue; //次のループをスキップ
                }

                $color = $type === static::INFO ? "bg-cyan-100 shadow-md shadow-cyan-300/50" : "bg-red-100 shadow-md shadow-red-300/50";
                foreach ($msgs as $msg) {
                    echo "<div class='p-4 my-4 $color'>{$type}:{$msg}</div>";
                }
            }
        } catch (Throwable $e) {
            Msg::push(Msg::DEBUG, $e->getMessage());
            Msg::push(Msg::ERROR, "Msg::Flushでエラー");
        }
    }

    // session 情報の初期化
    private static function init()
    {
        static::setSession([
            static::ERROR => [],
            static::INFO => [],
            static::DEBUG => []
        ]);
    }
}
