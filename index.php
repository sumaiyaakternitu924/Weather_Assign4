<?php
if (isset($_POST['submit'])) {
    $city = $_POST['city'];

    $url = "https://api.openweathermap.org/data/2.5/forecast?q=" . $city . "&appid=8c0e6d94ed9df8e1b362e529c8c3d2a5&units=metric";

    $content = file_get_contents($url);
    $climate = json_decode($content);
    $today = substr($climate->list[0]->dt_txt, 0, 10);
}
// $current_temp = $climate->main->temp;
// $t_max  = $climate->main->temp_max;
// $t_min  = $climate->main->temp_min;
// $city = $climate->name;
// echo "In ".$city." current temperature is ".$current_temp.".<br> The Maximum temperature is  : ".$t_max ." and Minimum temperatue is : ".$t_min.".";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Weather</title>
</head>

<body background="back4.png">
    <main>
        <div>
            <form class="search" action="index.php" method="POST">
                <input class="search-box" type="text" name="city" placeholder="search by city name......">
                <input class="btn" type="submit" name="submit" value="Search"><br>

            </form>
        </div>
        <?php
        if (isset($city)) {
            echo ' <h2>Weather for the ' . $city . ' city</h2>';
            $todays_temp = $climate->list[0]->main->temp;
            echo ' <span id="temp">' . $todays_temp . ' °C</span>';
        }
        ?>


        <?php


        if (isset($climate)) {
            echo '<h3>WEATHER FOR TODAY :' . $today . '</h3>';
            echo  '<div class="hours">';
            for ($i = 0; $i <= 4; $i++) {
                echo '<div class="hour">';
                $icon = $climate->list[$i]->weather[0]->icon;
                $des = $climate->list[$i]->weather[0]->description;
                $temp = $climate->list[$i]->main->temp;
                $tempmin = $climate->list[$i]->main->temp_min;
                $tempmax = $climate->list[$i]->main->temp_max;
                $feels = $climate->list[$i]->main->feels_like;
                $date = $climate->list[$i]->dt_txt;

                $time = substr($date, -8);
                echo '<img src="https://openweathermap.org/img/wn/' . $icon . '@2x.png" alt="">';
                echo ' <h4>' . $des . '</h4>';
                echo ' <h6>Temp: ' . $temp . '</h6>';
                echo ' <h5>Minimum Temp: ' . $tempmin . '</h5>';
                echo ' <h5>Maximum Temp: ' . $tempmax . '</h5>';
                echo ' <h5>Feels Like: ' . $feels . '</h5>';
                echo ' <h5>Time: ' . $time . '</h5>';
                echo '</div>';
            }
        }
        echo '</div>'
        ?>


        <?php
        if (isset($climate)) {
            echo '<h3>Weather for next 5 days </h3>';
            echo '<div class="days">';
            for ($i = 5; $i <= sizeof($climate->list); $i = $i + 8) {
                echo '<div class="day">';
                $icon = $climate->list[$i]->weather[0]->icon;
                $des = $climate->list[$i]->weather[0]->description;
                $temp = $climate->list[$i]->main->temp;
                $feels = $climate->list[$i]->main->feels_like;
                $date = $climate->list[$i]->dt_txt;

                $day = substr($date, 0, 10);
                echo '<img src="https://openweathermap.org/img/wn/' . $icon . '@2x.png" alt="">';
                echo ' <h4>' . $des . '</h4>';
                echo ' <h6>Temp: ' . $temp . '</h6>';
                echo ' <h5>Feels Like: ' . $feels . '</h5>';
                echo ' <h5>Date: ' . $day . '</h5>';
                echo '</div>';
            }
        }
        echo '</div>';
        ?>






    </main>
</body>

</html>