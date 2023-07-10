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
                    $bmi = $calBmi->bmi;
                    $_SESSION['bmi'] = $bmi;
                    $anatomizeBody = new anatomizeBody($bmi);
                    $_SESSION['status'] = $anatomizeBody->bodyStatus;
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
        public $bmi;
        function __construct(int $weight,int $height)
        {
            $height = $height / 100;
            $this->bmi = $weight / ($height * $height);
        }
    }

    class anatomizeBody{

        public $bodyStatus;
        
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

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BMI</title>
    <link rel="stylesheet" type="text/css" href="index.css">
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