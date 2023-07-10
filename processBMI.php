<?php

// session_start();

// if(isset($_POST['submited'])){
//       $weight = $_POST['weight'];
//       $height = $_POST['height'];
//     if(!empty($weight)||!empty($height)){
//       $height = $height / 100;
//       $bmi = $weight / ($height * $height) ;
//       $_SESSION['bmi'] = $bmi;
//       if ($bmi <= 18.5) {
//           $_SESSION['status'] = "UNDERWEIGHT"; 
//           header('Location: ./index.php');
      
//         } else if ($bmi > 18.5 AND $bmi<=24.9 ) {
//           $_SESSION['status'] = "NORMAL WEIGHT";
//           header('Location: ./index.php');
      
//         } else if ($bmi > 24.9 AND $num<=29.9) {
//           $_SESSION['status'] = "OVERWEIGHT";
//           header('Location: ./index.php');
      
//         } else if ($bmi > 30.0) {
//           $_SESSION['status'] = "OBESE";
//           header('Location: ./index.php');
//         }
//     }else{
//       $_SESSION['error'] = "กรุณากรอกข้อมูลให้ครบถ้วน";
//       header('Location: ./index.php');
//     }
    
// }else{
//     $_SESSION['error'] = "กรุณากรอกข้อมูลให้ครบถ้วน";
//     header('Location: ./index.php');
//   }

  session_start();

  if(!$_POST['submitted']) header('Location: ./index.php');

  $weight = $_POST['weight'];
  $height = $_POST['height'];

  if(!empty($weight)&&!empty($height)){
    $obj = new calBMI($weight,$height);
    $_SESSION['bmi'] = $obj->bmi;
  }else{
    $_SESSION['error'] = "กรุณากรอกข้อมูลให้ครบถ้วน";
  }

  class calBMI{

    public $bmi;

    public function __construct($weight,$height){
      $height = $height / 100;
      $this->bmi = $weight / ($height * $height);
      $this->getBodyType();
    }

    public function getBodyType(){
       if($this->bmi !== 0 && $this->bmi !== NULL){
        if ($this->bmi <= 18.5) {
          $_SESSION['status'] = "UNDERWEIGHT"; 
          header('Location: ./index.php');
      
        } else if ($this->bmi > 18.5 AND $this->bmi<=24.9 ) {
          $_SESSION['status'] = "NORMAL WEIGHT";
          header('Location: ./index.php');
      
        } else if ($this->bmi > 24.9 AND $num<=29.9) {
          $_SESSION['status'] = "OVERWEIGHT";
          header('Location: ./index.php');
      
        } else if ($this->bmi > 30.0) {
          $_SESSION['status'] = "OBESE";
          header('Location: ./index.php');
        }
       }
    }
  }


  
  
?>
