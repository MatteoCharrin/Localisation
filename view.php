<?php
function viewHome($arr){
    echo <<<END
<!DOCTYPE html> 
<html lang="en">
<head>
<script type="text/javascript" src="script.js"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Geo IP</title>
    <link rel="stylesheet" href="Asset/master.css">
    <link rel="shortcut icon" href="favicon.ico">
</head>
<body>
<div class="flexMid">
    <div class="flextable">
        <form action="" method="post" action="index.php">
            <input type="text" name="ip" placeholder="xxx.xxx.xxx.xxx"><br>

            <input type="submit" value="Submit">
        </form>
 
  <p>ip From :$arr[0]</p> 
  <p>ip To : $arr[1]</p> 
  <p>country Code : $arr[2]</p> 
  <p>country Name : $arr[3]</p> 
  <p>region Name : $arr[4]</p> 
  <p>city Name : $arr[5]</p> 
  <p>Latitude : $arr[6]</p>
  <p>Longitude :$arr[7]</p>




<a target='_blank' class='btn' href=https://www.google.com/maps/search/?api=1&query=".$arr[6]."%2C".$arr[7].">Localisation GMAP</a>

        
        <a target='_blank' class='btn' href="testtip.php">Test TIME IP</a>
        <form class ="btnform" action="" method="post" action ="index.php">
            <button name="local" value="local">Use Local Add</button>
        </form>

    </div>
    <script>
        function initMap() {
            const lati = parseFloat("$arr[6]");
            const lngi = parseFloat("$arr[7]");
            const selector = document.getElementById("map")
            const center = { lat: lati, lng: lngi }
            const options = {
                center: center,
                zoom : 8,
            }

            const map = new google.maps.Map(selector, options);

            const marker = new google.maps.Marker({
                position: center,
                map: map,
            });
        }
    </script>
<div id="map">  <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBne0Fvm1QfZm5iiqUMgvj78eowIhotqrE&callback=initMap" ></script>
</div>
</div>
</body>
</html>
END;
}
