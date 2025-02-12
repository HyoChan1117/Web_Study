<?php
if (function_exists('mysqli_connect')) {
    echo "MySQLi 확장 로드됨!";
} else {
    echo "MySQLi 확장 로드되지 않음!";
}
?>
