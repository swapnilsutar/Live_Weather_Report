<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Weather Reports</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300&display=swap" rel="stylesheet">
</head>
<body>
    <?php 
    error_reporting(0); 
        $status="";
        $msg= '';
        if(isset($_POST['submit'])){

            $city=$_POST['city'];

            $url ="http://api.openweathermap.org/data/2.5/weather?q=$city&appid=dbd259c90002d548fb3e0ad50fc5ee58";
            
            $ch = curl_init();
            curl_setopt($ch,CURLOPT_URL,$url);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
            $result = curl_exec($ch);
            curl_close($ch);

            
            $result =json_decode($result,true);
            // echo '<pre>';
            // print_r($result);
            if($result['cod']==200){
                $status='yes';
            }
            else{
                $msg=$result['message'];
            }
        }
    ?>
        <form method="post">
            <div class="form-group">
                <input type="text" class="form-control" name="city" placeholder="Enter City" value="<?php echo $city;?>">
                <input type="submit" class="btn" name="submit" value="Search" >
            </div>
        </form>
        

        <div class="card">
        <?php
        if($status == 'yes'){
        ?>
            <div class="card-header">
                    <?php echo $result['name'];?> <sup><?php echo $result['sys']['country'];?></sup>
            </div>
            <img src="http://openweathermap.org/img/wn/<?php echo $result['weather'][0]['icon'];?>@4x.png" alt="">
            <div class="card-body">
                <div class="section1">
                    Temp
                    <h3 style="display:flex;">
                        <span style="font-size:45px;display:flex;"> <?php echo round($result['main']['temp']-273.15);?> </span> °C    
                    </h3>
                    <!-- <sub> <?php echo round($result['main']['temp_min']-273.15);?> </sub> -->
                </div>
                <div class="section2">
                    Wind
                    <h3 style="font-size:30px;display:flex;"> 
                        <?php echo $result['wind']['speed'];?>
                    </h3>
                    Km/h
                </div>
                <div class="section3">
                    <?php 
                    echo $result['weather'][0]['main'];?>
                    <h3 style="font-size:40px;">
                        <?php echo $result['clouds']['all'];?>%
                    </h3>
                </div>
                <div class="section4">
                    <h4 style="font-size:30px;">
                        <?php echo date("M d",$result['dt']);?>
                    </h4>
                </div>
            </div>  
        </div>

                <?php
                }
                else{
                    echo "<h1 class='notfound'>";
                    echo $msg;
                    echo "</h1>";
                }
                ?>

<footer>
    Copyright &#169; 2021 : 
    <a href="http://swapnilsutar.netlify.com/" target="_blank"> Swapnil Sutar </a>
</footer>

</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
</html>