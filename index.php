<?php
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $weight = $_POST['weight'];
                $height = $_POST['height'];
                if(!empty($weight)||!empty($height))
                {
                    $obj_personDetail = new personDetail();
                    $obj_personDetail->setWeight($weight);
                    $obj_personDetail->setHeight($height);
                    $calBmi = new calBMI($obj_personDetail->getWeight(),$obj_personDetail->getHeight());
                    $bmi = $calBmi->getBmi();
                    $_SESSION['bmi'] = $bmi;
                    $anatomizeBody = new anatomizeBody($bmi);
                    $_SESSION['status'] = $anatomizeBody->getBodyStatus();
                }else{
                    $_SESSION['error'] = 'กรุณากรอกข้อมูลให้ครบถ้วน';
                }
            }
?>

<?php

    class personDetail{
        private $weight;
        private $height ;

        public function setWeight(int $weight)
        {
            $this->weight = $weight;
        }

        public function setHeight(int $height) 
        {
            $this->height = $height;
        }

        public function getWeight()
        {
            return $this->weight;
        }

        public function getHeight()
        {
            return $this->height;
        }
    }

    class calBMI{
        private $bmi;
        function __construct(int $weight,int $height)
        {
            $height = $height / 100;
            $this->bmi = $weight / ($height * $height);
        }

        public function getBmi(){
            return $this->bmi;
        }
    }

    class anatomizeBody{

        private $bodyStatus;
        
        function __construct(int $bmi){
            if($bmi > 0){
                if ($bmi <= 18.5) {
                    $this->bodyStatus = "UNDERWEIGHT"; 
                
                  } else if ($bmi > 18.5 AND $bmi<=24.9 ) {
                    $this->bodyStatus = "NORMAL WEIGHT";
                
                  } else if ($bodyStatus > 24.9 AND $num<=29.9) {
                    $this->bmi = "OVERWEIGHT";
                
                  } else if ($bmi > 30.0) {
                    $this->bodyStatus = "OBESE";
                }
        
             }

        }

        public function getBodyStatus(){
            return $this->bodyStatus;
        }

    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BMI</title>
    <style>
        *{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body{
    background-color: #fafafa;
    position: relative;
    align-items: center;
    display: flex;
    padding-top:8rem;
    justify-content: center;
    font-family: Arial, Helvetica, sans-serif;
}

p{
    font-size: 13px;
}

.alert{
    background-color: rgba(40, 255, 151, 0.23);
    width: 650px;
    border:2px solid  rgba(40, 255, 151, 0.313);
    height: 60px;
    position: absolute;
    border-radius: 10px;
    top:2rem;
    align-items: center;
    padding: 0.6rem;
    transition: 0.2s all 0s ease;
}

form{
    margin-top:0.5rem;
}

.modal{
    position:fixed;
    top:0;
    left:0;
    width: 100%;
    height: 100%;
    background-color: #33333395;
    display: none;
    justify-content: center;
    padding-top: 15rem;
}

.modal-content{
    width: 550px;
    height: 80px;
    position:relative;
    background-color: #fff;
    z-index: 2;
    border-radius:10px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.modal.active{
    opacity: 1;
    display: flex;
}

.alert-danger {
    background-color: #f2dede;
    border-color: #ebccd1;
    color: #a94442;
    padding: 0.5rem;
    font-size: 13px;
    border-radius: 5px;
    width: 100%;
    margin:0.5rem 0;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: 0.3s all 0s ease;
  }

.bmi{
    border-right: solid 1px #727272;
    padding-right: 0.5rem;
    margin-right:0.5rem;
    font-size: 16px;
}

#close-btn{
    position: absolute;
    top:0.3rem;
    right: 0.4rem;
    cursor: pointer;
}

#close-btn p{
    pointer-events: none;
    font-size: 12px;
    color:#424242;
}

.alert-detail{
    position:sticky;
    width: 100;
    height: 100;
}

.alert-message{
    align-items: center;
    justify-content: center;
    display: flex;
    flex-direction: column;
}

.main-app{
    background-color:#fff ;
    margin:0 auto;
    padding: 1rem;
    margin:0 auto;
    display: flex;
    width: 650px;
    height: 100%;
    border-radius: 10px;
    transition: 0.2s all 0s ease;
    box-shadow: rgba(0, 0, 0, 0.12) 0px 1px 3px, rgba(0, 0, 0, 0.24) 0px 1px 2px;;
}

.main-app:hover{
    box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;
}

.main-form{
    width: 100%;
    display: flex;
    align-items: center;
    flex-direction: column;
    padding: 1rem;
    padding-top:2.4rem;
}

.main-form h1{
    margin-bottom:0.5rem
}

.main-form p{
    color:#535353;
    font-size: 14px;
}

.form-control{
    display: flex;
    flex-direction: column;
    width: 100%;
    font-size: large;
    align-items: center;
}

.form-control input{
    height: 33px;
    width: 100%;
    border-radius:6px;
    margin-bottom:0.8rem;
    border:1px solid #ababab;
    padding: 0.5rem;
}

.btn-submit{
    width: 250px;
    padding: 0.5rem;
    border-radius: 10px;
    background-color:#6C63FF;
    border: none;
    font-size: 15px;
    color:#fff;
    cursor: pointer;
}

.illustration{
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
}
    </style>
</head>
<body>
    
        <?php
            if(!empty($_SESSION['bmi'])){  
        ?>
         <section class="modal active">
            <div class="modal-content">
            <div id="close-btn">
                <p>X</p>
            </div>
                <p class="bmi">BMI ของคุณเท่ากับ <?=$_SESSION['bmi']?></p>
                <p>คุณอยู่ในเกณท์  <b><?=$_SESSION['status']?></b></p>
            </div>
        </section>
        <?php
            session_unset();
            }
        ?>

    <section class="main-app">
        <div class="main-form">
            <h1>BMI calculate App</h1>
            <p>กรอกน้ำหนักส่วนสูงเพื่อหาค่า BMI ของคุณ</p>
            <?php
            if(!empty($_SESSION['error'])){  
            ?>
            <div class="alert-danger">
                <div id="close-btn">
                    <p>X</p>
                </div>
                    กรุณากรอกข้อมูลให้ครบถ้วน
            </div>
            <?php
                session_unset();
                }
            ?>
            <form action="./" method="POST" >
                <div class="form-control">
                    <input placeholder="น้ำหนัก" type="number" class="weight" name="weight">
                    <input placeholder="ส่วนสูง cm" type="number" class="height" name="height">
                </div> 
                <input type="submit" class="btn-submit" name="submited" value="Submit">
            </form>
        </div>
        <div class="illustration">
            <img src="./img/wallpaper.svg" width="100%" alt="">
        </div>

        
    </section>
    

    <script src="./app.js"></script>

</body>
</html>