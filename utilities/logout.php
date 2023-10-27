<?php

    session_start();

    session_destroy();  // destroy all sessions

    header("Location: ../");
    exit;

?>