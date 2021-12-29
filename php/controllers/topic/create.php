<?php

namespace controller\topic\create;

use lib\Auth;
use lib\Msg;

Auth::requireLogin();

function get()
{
    require_once SOURCE_BASE . "views/topic/create.php";
}
