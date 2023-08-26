<?php
require('fpdf.php');
session_start();
$query = $_POST['query'];

class myPDFGenerator extends FPDF{
  var $query;
  function connectWithDB($sql){
    $serverName = 'localhost';
    $userName = 'root';
    $passWord = '';
    $db = 'COVID';

    $conn = mysqli_connect($serverName, $userName, $passWord, $db);
    $execSql = $sql;
    return mysqli_query($conn, $sql); //return the result of executed query.
    $conn->close();
  }

  function header(){
    //set font Arial, Size 15
    $this->Image('Pic.jpg',100,10,20,20, 'JPG');
    $this->SetFont('Arial','I',18);
    $this->Cell(20,20,'',0,0,'C');
    $this->Ln();

    $this->SetFont('Arial','I',18);
    $this->SetTextColor(255, 0, 0);
    $this->Cell(200,20,'Student Covid 19 Vaccine Documents',0,0,'C');
    $this->Line(20,45,190,45);
    $this->Ln();

    $this->SetFont('Arial','B', 6.5);
    $this->SetTextColor(17, 27, 43);
    $this->SetRightMargin(100);
    $result = $this->connectWithDB($_POST['query']);
    while($columnInfo = mysqli_fetch_field($result)){
      $this->Cell(22,10, $columnInfo->name, 1,0, 'C');
    }

    $this->Ln();
  }

  function footer(){
    $this->SetY(-15);
    $this->SetFont('Arial', 'B', 7.5);
    $this->Cell(22,10,'Page No: '.$this->PageNo().'/{nb}',0,0,'C');
  }

  function __construct()
   {
     parent::__construct();
     $query = $_POST['query'];
   }

   function viewTable(){
    $result = $this->connectWithDB($_POST['query']);
    $this->SetFont('Arial', 'I', 6.0);
    while($rows = mysqli_fetch_row($result)){
      for($i=0;$i<mysqli_num_fields($result);$i++){
        $this->Cell(22,10, $rows[$i], 1,0, 'C');
      }
      $this->Ln();
    }
   }


}


$pdf = new myPDFGenerator();
$pdf->AliasNbPages();
$pdf->AddPage('P','A4',0);
$pdf->SetFont('Arial','', 16);
$pdf->viewTable();
$pdf->Output();


?>
