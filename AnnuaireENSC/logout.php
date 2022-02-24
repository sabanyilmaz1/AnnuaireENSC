<?php
require_once "includes/functions.php";
session_start();
session_destroy();
redirect('index.php');