<?php

    include "db_connection/db_config.php";

    $sql1 = "SELECT view_count FROM `view_count`
            WHERE view_count_id = 1";

    $result1 = $conn->query($sql1);

    if($row1 = $result1->fetch_assoc()) {
        $increase_view_by_one = (int) $row1['view_count'] + 1;

        $sql2 = "UPDATE `view_count`
                SET view_count = $increase_view_by_one
                WHERE view_count_id = 1";

        $result2 = $conn->query($sql2);
        if($result2) {
            $sql3 = "SELECT view_count FROM `view_count`
            WHERE view_count_id = 1";

            $result3 = $conn->query($sql3);
            if($row3 = $result3->fetch_assoc()) {
                echo "Visit Count: " . $row3['view_count'];
            }
        }
    }

?>