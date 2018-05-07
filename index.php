<?php
/**
 * Created by PhpStorm.
 * User: wyatt
 * Date: 5/7/2018
 * Time: 10:04 AM
 */
include 'common.php';
//Send Submit
if (isset($_POST['submit'])) {
    if ($config->pin == $_POST['pin']) {
        $prepared = mysqli_prepare($conn, "INSERT INTO `countdowns` (`name`, `description`,`date`,`time`,`done`) VALUES (?,?,?,?,?)");
        $prepared->bind_param("sssss", $name, $description, $date, $time, $done);
        $name = $_POST['name'];
        $description = $_POST['description'];
        $date = str_replace("-", "/", $_POST['date']);
        $time = $_POST['time'];
        $done = $_POST['over-message'];
        $prepared->execute();
        header("Location: " . ROOT . "/countdown/" . mysqli_insert_id($conn));
    } else {
        header("Location: " . ROOT);

    }

} else {
    if (isset($_GET['countdown'])) {
        $prepared = mysqli_prepare($conn, "SELECT * FROM `countdowns` WHERE id=? LIMIT 1");
        $prepared->bind_param('i', $id);
        $id = $_GET['countdown'];
        $prepared->execute();
        $result = $prepared->get_result();
        if ($result != null) {
            if (mysqli_num_rows($result) >= 1) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $datetime = $row['date'] . " " . $row['time'];
                    $url = ROOT . "/countdown/" . $_GET['countdown'];
                    $page = file_get_contents(ROOT . "/countdown.html");
                    $page = str_replace("{title}", $row['name'], $page);
                    $page = str_replace("{description}", $row['description'], $page);
                    $page = str_replace("{date-time}", $datetime, $page);
                    $page = str_replace("{done-message}", $row['done'], $page);
                    $page = str_replace("{url}", $url, $page);
                    $page = str_replace("{root}", ROOT, $page);
                    echo $page;
                }
            } else {
                include '404.php';
            }
        } else {
            include '404.php';
        }
    } else {
        $error = "";

        if (isset($_GET['error'])) {
            if ($_GET['error'] == "pin") {
                $error = '<div class="alert alert-warning" role="alert">
              <strong>Incorrect Pin</strong> 
            </div>';
            }

        }
        $page = file_get_contents(ROOT . "/create-countdown.html");
        $page = str_replace("{error}", $error, $page);

        if ($config->pin == '0') {
            $removeScript = "<script>
var element = document.getElementById('no-pin');
element.style.display='none';
</script>";
            $page = str_replace("{hide}", $removeScript, $page);

        } else {
            $page = str_replace("{hide}", "", $page);

        }
        echo $page;
    }
}