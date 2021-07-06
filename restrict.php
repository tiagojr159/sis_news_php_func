<?php
@session_start();
if (isset($_SESSION['nome'])){
}else{
   echo"<script>window.location='login.php';</script>";
   die;
}?>


