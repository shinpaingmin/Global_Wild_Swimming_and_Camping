<?php
    if(!empty($_SERVER["SERVER_NAME"]) && $_SERVER["REQUEST_URI"]) {
    $web_url = "http://" . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
    }
    $str = "<?xml version='1.0' ?>";
    $str .= "<rss version='2.0'>";
        $str .= "<channel>";
            $str .= "<title>Global Wild Swimming and Camping</title>";
            $str .= "<description>Dive into a world where the beauty of nature comes into contact with the excitement of outdoor explorations. Warmly welcome to our “ Global Wild Swimming and Camping ”, the beginning of a memorable moments ...</description>";
            $str .= "<language>en-US</language>";
            $str .= "<link>$web_url</link>";

            $conn = require "db_connection/db_config.php";
            $sql = "SELECT * FROM `location`";
            $result = $conn->query($sql);
            if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $str .= "<location>";
                        $str .= "<title>" . htmlspecialchars($row["location_name"]) . "</title>";
                        $str .= "<description>" . htmlspecialchars($row["description"]) . "</description>";
                        $str .= "<link>" . 'http://localhost/Global_Wild_Swimming_and_Camping/' . 'detail.php?id=' . $row["location_id"] . "</link>";
                    $str .= "</location>";
                }
            }
        $str .= "</channel>";
    $str .= "</rss>";

    file_put_contents("rss.xml", $str);
    header("Location: rss.xml");
?>