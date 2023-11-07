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
    "words"=>"",
  ];

   $sql="select fee_data.*, date_format(paid_date,'%d-%m-%Y') as date, institute.inst_name as college,institute.img as logo,institute.mob1 as mob1,institute.mob2 as mob2,
   institute.addr1 as add1,institute.addr2 as add2,institute.addr3 as add3,institute.addr4 as add4,institute.ins_email as email,institute.website as web  from institute,fee_data 
   where fee_data.id='{$_GET["id"]}'";
  // $res1=mysqli_query($con,"select * from institute");
  $res=$con->query($sql);             
  if ($res->num_rows > 0) {
      $row=$res->fetch_assoc(); 
      
      $obj=new IndianCurrency($row["paid_fee"]);
      


      $info=[

        "college"=>$row["college"],
        "logo"=>$row["logo"],
        "mobile"=>'Mob : '. $row["mob1"] .', '. $row["mob2"],
        "address"=> $row["add1"] .','. $row["add2"].', '. $row["add3"].'- '. $row["add4"],
        "email"=>$row["email"].' - '. $row["web"],
        


        "sess"=>$row["sess"],
        "feeslip"=>$row["id"],
        "sid"=>$row["adm_no"],
        "regno"=>$row["regno"],
        "course"=>$row["course"].'('.$row["cl_name"].')',
        "name"=>$row["st_name"],
        "father"=>$row["st_fath"],
        "pfee"=>$row["paid_fee"],
        "hfee"=>$row["fee_head"],
        "date"=>$row["date"],
        "addr"=>$row["addr1"],
        
        "words"=> $obj->get_words(),
        
      ];
    }
  
  
  //invoice Products
  $products_info=[
    [
      "sr"=>"1",
      "feehead"=>$row["fee_head"],
      "feetype"=>$row["pay_type"],
      "paidfee"=>$row["paid_fee"],
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

        $this->SetY(28);
        $this->SetX(80);
        $this->SetFont('Arial','',11);
        $this->Cell(50,9,"Student Fee Slip",0,1,'C');
        

      //Billing Details
      $this->SetY(28);
      $this->SetX(10);
      $this->SetFont('Arial','B',10);
      $this->Cell(35,10,"Admis.Id : ".$info["sid"]);
      $this->Cell(60,10,"Reg.No : ".$info["regno"]);
      $this->SetY(35);
      $this->SetX(10);
      $this->SetFont('Arial','',10);
      $this->Cell(50,7,"Student Name : ".$info["name"]);
      $this->SetY(40);
      $this->SetX(10);
      $this->Cell(50,7,"Course : ".$info["course"]);
      $this->SetY(45);
      $this->SetX(10);
      $this->Cell(50,7,"Father's Name  : ".$info["father"]);
      $this->SetY(50);
      $this->SetX(10);
      $this->Cell(50,7,"Address : ".$info["addr"]);
      //$this->Cell(50,7,$info["address"],0,1);
      
           
      
      //Display Invoice no
      $this->SetY(30);
      $this->SetX(-50);
      $this->Cell(50,7,"Session : ".$info["sess"]);
      $this->SetY(35);
      $this->SetX(-50);
      $this->Cell(50,7,"Fee Slip No : ".$info["feeslip"]);
      
      //Display Invoice date
      $this->SetY(40);
      $this->SetX(-50);
      $this->Cell(50,7,"Fee Date : ".$info["date"]);
      
      //Display Table headings
      $this->SetY(60);
      $this->SetX(10);
      $this->SetFont('Arial','B',11);
      $this->Cell(10,9,"Sr.",1,0);
      $this->Cell(100,9,"Description",1,0,"C");
      $this->Cell(40,9,"Paytype",1,0,"C");
      $this->Cell(40,9,"Amount",1,1,"C");
      $this->SetFont('Arial','',11);
     
      //Display table product rows
      foreach($products_info as $row){
        $this->Cell(10,9,$row["sr"],"LR",0);
        $this->Cell(100,9,$row["feehead"],"R",0,"C");
        $this->Cell(40,9,$row["feetype"],"R",0,"C");
        $this->Cell(40,9,$row["paidfee"],"R",1,"C");
      }
      //Display table empty rows
      for($i=0;$i<3-count($products_info);$i++)
      {
        $this->Cell(10,9,"","LR",0);
        $this->Cell(100,9,"","R",0,"R");
        $this->Cell(40,9,"","R",0,"C");
        $this->Cell(40,9,"","R",1,"R");
      }
      //Display table total row
      $this->SetFont('Arial','B',11);
      $this->Cell(150,9,"TOTAL",1,0,"R");
      $this->Cell(40,9,$info["pfee"],1,1,"C");
      
      //Display amount in words
      $this->SetY(106);
      $this->SetX(10);
      $this->SetFont('Arial','B',10);
      $this->Cell(0,6," Amount in Words ",0,1);
      $this->SetFont('Arial','',11);
      $this->Cell(0,9,$info["words"],0,1);


      //set footer position
      $this->SetY(-190);
      $this->SetFont('Arial','B',10);
      $this->Cell(0,10,"For ".$info["college"],0,1,"R");
      $this->Ln(15);
      $this->SetFont('Arial','',10);
      $this->Cell(0,10,"Authorized Signature",0,1,"R");
      $this->SetFont('Arial','',8);
      
      //Display Footer Text
      $this->Cell(0,9,"This is a computer generated Fee Slip",0,1,"C");
      
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