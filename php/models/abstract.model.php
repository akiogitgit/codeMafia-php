<?php

namespace model;

// エラー表示あり
ini_set('display_errors', 1);

use Error;

abstract class AbstractModel
{
    protected static $SETTION_NAME = null;

    // UserModel で定義したクラスを受け取る
    public static function setSession($val)
    {
        if (empty(static::$SESSION_NAME)) {
            throw new Error('$SETTION_NAMEを設定してください');
        }
        $_SESSION[static::$SESSION_NAME] = $val;
    }

    public static function getSession()
    {
        return $_SESSION[static::$SESSION_NAME] ?? null;
    }

    public static function clearSession()
    {
        static::setSession(null);
    }

    public static function getSessionFlush()
    {
        try {
            return static::getSession();
        } finally {
            static::clearSession();
        }
    }
}
