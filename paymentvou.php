<?php 
  include('config.php');
  require ("fpdf/fpdf.php");
  require ("word.php");
  

  //customer and invoice details
  $info=[
    "regno"=>"",
    "course"=>"",
    "feeslip"=>"",
    
    "name"=>"",
    "father"=>"",
    "pfee"=>"",
    "date"=>"",
    "addr"=>"",
    "logo"=>"",
    "words"=>"",
     ];

   $sql="select payment.* , date_format(pay_date,'%d-%m-%Y') as date,institute.inst_name as college,institute.img as logo,institute.mob1 as mob1,institute.mob2 as mob2,
   institute.addr1 as add1,institute.addr2 as add2,institute.addr3 as add3,institute.addr4 as add4,institute.ins_email as email,institute.website as web  from institute,payment 
   where payment.id='{$_GET["id"]}'";
  // $res1=mysqli_query($con,"select * from institute");
  $res=$con->query($sql);             
  if ($res->num_rows > 0) {
      $row=$res->fetch_assoc(); 
      
      $obj=new IndianCurrency($row["pay_amt"]);
      


      $info=[

        "college"=>$row["college"],
        "logo"=>$row["logo"],
        "mobile"=>'Mob : '. $row["mob1"] .', '. $row["mob2"],
        "address"=> $row["add1"] .','. $row["add2"].', '. $row["add3"].'- '. $row["add4"],
        "email"=>$row["email"].' - '. $row["web"],
        



        "payslip"=>$row["id"],
        "payvo"=>$row["pay_vo"],
        "payto"=>$row["pay_to"],
        "payfor"=>$row["pay_for"],
        "paynar"=>$row["pay_nar"],
        "payamt"=>$row["pay_amt"],
        "paytype"=>$row["pay_type"],
        "date"=>$row["date"],
                
        "words"=> $obj->get_words(),
        
      ];
    }
  
  
  //invoice Products
  $products_info=[
    [
      "sr"=>"1",
      
        "payto"=>$row["pay_to"],
        "payfor"=>$row["pay_for"],
        "paynar"=>$row["pay_nar"],
        "payamt"=>$row["pay_amt"],
        "paytype"=>$row["pay_type"],
    ],
    
  ];
  
  class PDF extends FPDF
  {
    function Header(){
      
      //Display Company Info
      //$this->SetFont('Arial','B',14);
      //$this->Cell(58,9,"ABC COMPUTERS",0,1);
      //$this->SetFont('Arial','',14);
      //$this->Cell(50,7,"West Street,",0,1);
      //$this->Cell(50,7,"Salem 636002.",0,1);
      //$this->Cell(50,7,"PH : 8778731770",0,1);
      
      
      
      //Display Horizontal line
      $this->Line(0,30,210,30);
    }
    
    function body($info,$products_info){
        #shows image with given width and height
        if (file_exists($info["logo"])) {
          #shows image with given width and height
          $this->Image($info["logo"],5,9,20,20,"");
        } else {
          // Handle the error when image file is not found
          $this->Image('images/college.jpg',5,9,20,20,"");
      }

       // $this->Image($info["logo"],5,9,20,20,"");
        //Display INVOICE text
        $this->SetY(10);
        $this->SetX(80);
        $this->SetFont('Arial','B',18);
        $this->Cell(50,9,$info["college"],0,1,'C');

        $this->SetY(16);
        $this->SetX(80);
        $this->SetFont('Arial','B',10);
        $this->Cell(50,9,$info["address"],0,1,'C');

        $this->SetY(20);
        $this->SetX(80);
        $this->SetFont('Arial','B',10);
        $this->Cell(50,9,$info["mobile"],0,1,'C');
        $this->SetY(24);
        $this->SetX(80);
        $this->SetFont('Arial','',8);
        $this->Cell(50,9,$info["email"],0,1,'C');
        $this->SetY(29);
        $this->SetX(80);
        $this->SetFont('Arial','',11);
        $this->Cell(50,9,"Payment Voucher",0,1,'C');
        

      //Billing Details
      $this->SetY(34);
      $this->SetX(10);
      $this->SetFont('Arial','B',10);
      $this->Cell(50,10,"Pay Slip No : ".$info["payslip"]);
      $this->SetY(37);
      $this->SetX(10);
      $this->SetFont('Arial','',10);
      //$this->Cell(50,7,"Paymet Type  : ".$info["paytype"]);
      
      
      $this->SetY(42);
      $this->SetX(10);
      $this->Cell(5,7,"Narration: ".$info["paynar"]);
      //Display Invoice no
      $this->SetY(37);
      $this->SetX(-55);
      $this->Cell(50,7,"Paymet Type : ".$info["paytype"]);
      
      //Display Invoice date
      $this->SetY(42);
      $this->SetX(-55);
      $this->Cell(50,7,"Payment Date : ".$info["date"]);
      
      //Display Table headings
      $this->SetY(50);
      $this->SetX(10);
      $this->SetFont('Arial','B',11);
      $this->Cell(10,9,"Sr.",1,0);
      $this->Cell(80,9,"Pay To",1,0,"C");
      $this->Cell(75,9,"Pay For",1,0,"C");
      $this->Cell(25,9,"Amount",1,1,"C");
      $this->SetFont('Arial','',11);
     
      //Display table product rows

      

      foreach($products_info as $row){
        $this->Cell(10,9,$row["sr"],"LR",0);
        $this->Cell(80,9,$row["payto"],"R",0,"C");
        $this->Cell(75,9,$row["payfor"],"R",0,"C");
        $this->Cell(25,9,$row["payamt"],"R",1,"R");
      }
      //Display table empty rows
      for($i=0;$i<2-count($products_info);$i++)
      {
        $this->Cell(10,9,"","LR",0);
        $this->Cell(80,9,"","R",0,"R");
        $this->Cell(75,9,"","R",0,"C");
        $this->Cell(25,9,"","R",1,"R");
      }
      //Display table total row
      $this->SetFont('Arial','B',12);
      $this->Cell(165,9,"TOTAL",1,0,"R");
      $this->Cell(25,9,$info["payamt"],1,1,"R");
      
      //Display amount in words
      $this->SetY(88);
      $this->SetX(10);
      $this->SetFont('Arial','',11);
      $this->Cell(0,5," Amount in Words ",0,1);
      $this->SetFont('Arial','B',11);
      $this->Cell(0,9,$info["words"],0,1);


      //set footer position
      $this->SetY(-210);
      $this->SetFont('Arial','B',11);
      $this->Cell(0,10,"For ".$info["college"],0,1,"R");
      $this->Ln(15);
      $this->SetY(-195);
      $this->SetFont('Arial','',11);
      $this->Cell(0,10,"Authorized Signature",0,1,"R");
      $this->SetFont('Arial','',8);
      
      //Display Footer Text
      $this->SetY(-190);
      $this->Cell(0,8,"** This is a computer generated Payment Slip **",0,1,"C");
      
    }
    function Footer(){
      
      
      
    }
    
  }
  //Create A4 Page with Portrait 
  $pdf=new PDF("P","mm","A4");
  $pdf->AddPage();
  $pdf->body($info,$products_info);
  $pdf->Output();
?>