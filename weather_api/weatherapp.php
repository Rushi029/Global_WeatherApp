<?php
    if(array_key_exists('submit',$_GET))
    {
        if(!$_GET['city'])
        {
            $error = "Sorry! Please Enter Your City Name";
        }
        if ($_GET['city']) 
        {
            $apiData = file_get_contents("https://api.openweathermap.org/data/2.5/weather?q=".
            $_GET['city']."&appid=1a1a03b00b876cb5ce24c8dfef46fcbc");
            $weatherArray = json_decode($apiData , true);
            if($weatherArray['cod'] == 200 )
            {
                //celcius= kelvin - 273.15 
                $tempCelsius = $weatherArray['main']['temp'] - 273;
            
                $weather = "<b>".$weatherArray['name'].",".$weatherArray['sys']['country']." : "
                .$tempCelsius."</b> &deg;C <br>";
            
                $weather .= "<b>Weather Condition : </b>".$weatherArray['weather']['0'] ['description']."<br>";

                $weather .= "<b>Atmosperic Pressure : </b>".$weatherArray['main']['pressure']. 
                "hPa<br>";

                $weather .= "<b>Humidity : </b>".$weatherArray['main']['humidity']."%". "<br>";

                $weather .= "<b>Wind Speed : </b>".$weatherArray['wind']['speed']." m/sec<br>";

                $weather .= "<b>Cloudness : </b>".$weatherArray['clouds']['all']."%" ." <br>";
                date_default_timezone_set('Asia/Kolkata');
                $sunrise = $weatherArray['sys']['sunrise'];
                $weather .= "<b>Sunrise : </b>".date("g:i a",$sunrise)."<br>";
                $weather .= "<b> Time : </b>".date("F j, Y , g:i a")."<br>";
            }
            else
            {
                $error = "Your city name is INVALID!!";
            }
            
        } 

    }


?>

<!doctype html>
<html lang="ar" dir="rtl">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" 
    integrity="sha384-dpuaG1suU0eT09tx5plTaGMLBsfDLzUCCUXOY2j/LSvXYuG6Bqs43ALlhIqAJVRb" crossorigin="anonymous">

    <title>Weather App</title>

    <style>

        body{
            margin: 0px;
            padding: 0px;
            box-sizing: border-box;
            background-image: url(https://img.freepik.com/free-photo/sunshine-clouds-sky-during-morning-background-blue-white-pastel-heaven-soft-focus-lens-flare-sunlight-abstract-blurred-cyan-gradient-peaceful-nature-open-view-out-windows-beautiful-summer-spring_1253-1094.jpg?w=996&t=st=1719858888~exp=1719859488~hmac=9ee12a3b722a736cf0ba1f6a7503cdbfc7f354655719b80dc2d1b858b3ad0628);
            color: black;
            font-family: 'Courier New', Courier, monospace;
            font-size: large;
            background-size: cover;
            background-attachment: fixed;
        }
        .container{
            text-align: center;
            justify-content: center;
            align-items: center;
            width: 440px;
        }
        h1{
            font-weight: 700;
            margin-top: 150px;
            color: lightskyblue;
            
        }
        label{
            color: whitesmoke;
            background-color: transparent;
        }
        input{
            width: 350px;
            padding: 5px;
            text-align: center;
        
        }

    </style>

  </head>
  <body>
    <div class="container">
        <h1> Current Global Weather</h1>
        <form action="" method="GET">
            <p><label for="city">Enter Your City</label><p>
            <p><input type="text" name="city" id="city" placeholder="Enter City Name"></p>
            <button type="submit" name="submit" class="btn btn-success">Submit</button>
        

            <div class="output">
            
                   <p> <?php 
                    if($weather){
                        echo '<div class="alert alert-light" role="alert">
                           '. $weather.'
                      </div>';
                    }
                    if($error){
                        echo '<div class="alert alert-danger" role="alert">
                           '.$error.'
                      </div>';
                    }
                    ?><p>
            </div>
        </form>
    </div>
    



    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

  </body>
</html>