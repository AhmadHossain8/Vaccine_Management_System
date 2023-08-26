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

    $this->SetFont('Arial','I',40);
    $this->SetTextColor(255, 0, 0);
    $this->Cell(200,20,'Student Information',0,0,'C');
    $this->Line(20,45,190,45);
    $this->Ln();

    $this->SetFont('Arial','B', 15);
    $this->SetTextColor(17, 27, 43);
    $this->SetRightMargin(100);
    $result = $this->connectWithDB($_POST['query']);
    $rows = mysqli_fetch_row($result);
    $i = 0;
    while($columnInfo = mysqli_fetch_field($result)){
      $this->Cell(0,10, $columnInfo->name, 0,0, 'C');
      $this->Cell(50,10, $rows[$i], 0,0, 'C');
      $this->Ln();
      $i++;
    }

    $this->Ln();

    $this->Line(30,180,85,180);
    $this->Line(135,180,190,180);
    $this->SetFont('Arial', 'B', 10);
    $this->Cell(90,67,'1st Dose Signature',0,0,'C');
    $this->Cell(125,67,'2nd Dose Signature',0,0,'C');

    $this->Ln();
    $this->Line(30,250,85,250);
    $this->Line(135,250,190,250);
    $this->Cell(96,72,'1st Dose Seal',0,0,'C');
    $this->Cell(116,72,'2nd Dose Seal',0,0,'C');

  }

  function footer(){
    $this->SetY(-15);
    $this->SetFont('Arial', 'B', 6.5);
    $this->Cell(200,10,'Page No: '.$this->PageNo().'/{nb}',0,0,'C');
  }

  function __construct()
   {
     parent::__construct();
     $query = $_POST['query'];
   }

   function viewTable(){

    // $result = $this->connectWithDB($_POST['query']);
    // $this->SetFont('Arial', 'B', 6.5);
    // while($rows = mysqli_fetch_row($result)){
    //   for($i=0;$i<mysqli_num_fields($result);$i++){
    //     $this->Cell(18,10, $rows[$i], 1,0, 'C');
    //   }
    //   $this->Ln();
    // }
   }


}


$pdf = new myPDFGenerator();
$pdf->AliasNbPages();
$pdf->AddPage('P','A4',0);
$pdf->SetFont('Arial','', 16);
$pdf->viewTable();
$pdf->Output();


?>
