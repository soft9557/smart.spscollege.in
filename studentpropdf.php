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
    "photo"=>'images/default-avatar',
    
  ];

   $sql="select student_data.*, date_format(st_dob,'%d-%m-%Y') as dobdate,institute.inst_name as college,institute.img as logo,institute.mob1 as imob1,institute.mob2 as imob2,institute.sese as session,
   institute.addr1 as add1,institute.addr2 as add2,institute.addr3 as add3,institute.addr4 as add4,institute.ins_email as iemail,institute.website as web  from student_data,institute 
   where student_data.id='{$_GET["id"]}'";
  // $res1=mysqli_query($con,"select * from institute");
  $res=$con->query($sql);             
  if ($res->num_rows > 0) {
      $row=$res->fetch_assoc(); 
      
     
      

      //$imagePath = 'images/default-avatar.jpg';
       $info=[
        
        "college"=>$row["college"],
        "logo"=>$row["logo"],
        "mobile"=>'Mob : '. $row["imob1"] .', '. $row["imob2"],
        "address"=> $row["add1"] .','. $row["add2"].', '. $row["add3"].'- '. $row["add4"],
        "iemail"=>$row["iemail"].' - '. $row["web"],
        "ses"=>$row["session"],


        "stphoto"=>$row["st_ph_id"],
        //"photo"=>$imagePath,
    
        "stid"=>$row["id"],
        "regno"=>$row["st_adm_no"],
        "adhno"=>$row["st_adh"],
        "course"=>$row["cl_cd"].'('. $row["cl_name"].')'.'  Sub: - ['. $row["subject"].']',
        "name"=>$row["st_name"],
        "father"=>$row["st_fath"],
        "mother"=>$row["st_moth"],
        
        "date"=>date("d-m-y",strtotime($row["adm_date"])),
        "addr1"=>$row["addr1"],
        "addr2"=>$row["addr2"],
        "addr3"=>$row["addr3"],
        "addr4"=>$row["addr4"],


        "gen"=>$row["st_sex"],
        "dob"=>$row["dobdate"],
        "rel"=>$row["st_rel"],
        "caste"=>$row["st_caste"],
        "cat"=>$row["st_cat"],


        "email"=>$row["email"],
        "mob1"=>$row["mob1"],
        "mob2"=>$row["mob2"],
       
      ];
   
  
  
  //invoice Products
  $products_info=[
    [
      "sr"=>"1",
      "exam1"=>$row["exam1"],
      "board1"=>$row["board1"],
      "year1"=>$row["year1"],
      "marks1"=>$row["marks1"],
      "sub1"=>$row["sub1"],
      "sr2"=>"2",
      "exam2"=>$row["exam2"],
      "board2"=>$row["board2"],
      "year2"=>$row["year2"],
      "marks2"=>$row["marks2"],
      "sub2"=>$row["sub2"],
      "sr3"=>"3",
      "exam3"=>$row["exam3"],
      "board3"=>$row["board3"],
      "year3"=>$row["year3"],
      "marks3"=>$row["marks3"],
      "sub3"=>$row["sub3"],
      
      
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

      if (file_exists($info["logo"])) {
        #shows image with given width and height
        $this->Image($info["logo"],5,9,20,20,"");
      } else {
        // Handle the error when image file is not found
        $this->Image('images/college.jpg',5,9,20,20,"");
    }
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
        $this->Cell(50,9,$info["iemail"],0,1,'C');

        $this->SetY(30);
        $this->SetX(80);
        $this->SetFont('Arial','',15);
        $this->Cell(50,9,"ADMISSION FORM",0,1,'C');

        $this->SetY(35);
        $this->SetX(80);
        $this->SetFont('Arial','',10);
        $this->Cell(50,9,"Session : ".$info["ses"],0,1,'C');
        

      //STUDENT Details
      $this->SetY(42);
      $this->SetX(10);
      $this->SetFont('Arial','B',10);
      $this->Cell(35,10,"Admis.Id : ".$info["stid"]);
      $this->Cell(60,10,"Registration No : ".$info["regno"]);
      $this->SetFont('Arial','',10);
      $this->Cell(55,10,"Aadhar No : ".$info["adhno"]);


      $this->SetY(50);
      $this->SetX(10);
      $this->SetFont('Arial','',10);
      $this->Cell(50,7,"Student Name : ".$info["name"]);
      $this->SetY(57);
      $this->SetX(10);
      $this->Cell(50,7,"Course : ".$info["course"]);
      $this->SetY(64);
      $this->SetX(10);
      $this->Cell(50,7,"Father's Name  : ".$info["father"]);
      $this->SetY(71);
      $this->SetX(10);
      $this->Cell(50,7,"Mother's Name  : ".$info["mother"]);
      $this->SetY(78);
      $this->SetX(10);
      $this->Cell(50,7,"Address : ".$info["addr1"]);
      $this->SetY(85);
      $this->SetX(10);
      $this->Cell(70,7,"City : ".$info["addr2"]);
      $this->Cell(50,7,"Pincode. : ".$info["addr3"]);
      $this->Cell(40,7,"State : ".$info["addr4"]);
      $this->SetY(92);
      $this->SetX(10);
      
      $this->SetY(92);
      $this->SetX(10);
      $this->Cell(40,7,"Gender : ".$info["gen"]);
      $this->Cell(40,7,"DOB. : ".$info["dob"]);
      $this->Cell(40,7,"Religion : ".$info["rel"]);
      $this->Cell(43,7,"Caste : ".$info["caste"]);
      $this->Cell(40,7,"Category : ".$info["cat"]);

      $this->SetY(98);
      $this->SetX(10);
      $this->Cell(100,7,"E-mail : ".$info["email"]);
      $this->Cell(45,7,"Mobile # : ".$info["mob1"]);
      $this->Cell(40,7,"WhatsApp # : ".$info["mob2"]);
      
      $this->SetY(105);
      $this->SetX(10);
      $this->SetFont('Arial','B',12);
      $this->Cell(100,7,"EDUCATION QUALIFICATION :" );
          
      
      //Display stusent Photo

      if (file_exists($info["stphoto"])) {
        #shows image with given width and height
       // list($width, $height) = getimagesize($info["stphoto"]);
        $this->Image($info["stphoto"],160,35,20,20,"");
      } else {
        // Handle the error when image file is not found
        $this->Image('images/default-avatar.jpg',160,35,20,20,"");
    }
      
                 
      //Display Invoice date
      $this->SetY(35);
      $this->SetX(-45);
     // $this->Cell(50,7,"Fee Date : ".$info["date"]);
      
      //Display Table headings
      $this->SetY(115);
      $this->SetX(10);
      $this->SetFont('Arial','B',10);
      $this->Cell(7,9,"Sr.",1,0);
      $this->Cell(25,9,"Examination",1,0,"L");
      $this->Cell(30,9,"Board/University",1,0,"L");
      $this->Cell(12,9,"Year",1,0,"C");
      $this->Cell(35,9,"To.Marks/Ob.Marks",1,0,"C");
      $this->Cell(85,9,"Subject",1,1,"C");
      $this->SetFont('Arial','',8);
      
      //Display table product rows
      foreach($products_info as $row){
        $this->Cell(7,9,$row["sr"],"LR",0);
        $this->Cell(25,9,$row["exam1"],"R",0,"L");
        $this->Cell(30,9,$row["board1"],"R",0,"L");
        $this->Cell(12,9,$row["year1"],"R",0,"C");
        $this->Cell(35,9,$row["marks1"],"R",0,"C");
        $this->Cell(85,9,$row["sub1"],"R",1,"L");
        
        $this->Cell(7,11,$row["sr2"],"LR",0);
        $this->Cell(25,11,$row["exam2"],"R",0,"L");
        $this->Cell(30,11,$row["board2"],"R",0,"L");
        $this->Cell(12,11,$row["year2"],"R",0,"C");
        $this->Cell(35,11,$row["marks2"],"R",0,"C");
        $this->Cell(85,11,$row["sub2"],"R",1,"L");
        
        $this->Cell(7,11,$row["sr3"],"LR",0);
        $this->Cell(25,11,$row["exam3"],"R",0,"L");
        $this->Cell(30,11,$row["board3"],"R",0,"L");
        $this->Cell(12,11,$row["year3"],"R",0,"C");
        $this->Cell(35,11,$row["marks3"],"R",0,"C");
        $this->Cell(85,11,$row["sub3"],"R",1,"L");
      }
      //Display table empty rows
      for($i=0;$i<3-count($products_info);$i++)
      {
        
      }
      //Display table total row
      $this->SetFont('Arial','',10);
      $this->Cell(109,9,"",1,0,0,0,"R");
      $this->Cell(85,9,"",1,0,0,0,"R");
     
      
      //Display amount in words
         


      //set footer position
      $this->SetY(-130);
      $this->SetFont('Arial','B',12);
      $this->Cell(0,9,"DECLARATION BY THE CANDIDATE",0,1,"C");
      $this->SetY(-123);
      $this->SetFont('Arial','',11);
      $this->Cell(0,9,"I........................................................ heraby declare that the informtion furnished in the form is true to the best of  ",0,1,"L");
      $this->SetY(-117);
      $this->Cell(0,9,"my knowledge & belief. I understand that my candidature is liable to be cancelled by the .....................................  ",0,1,"L");
      $this->SetY(-112);
      $this->Cell(0,9,"If any information given share by me is found incorrect or misleading.",0,1,"L");
      $this->SetY(-98);
      $this->Cell(0,9,"...............................................",0,1,"R");
      $this->Ln(15);
      $this->SetY(-90);
      $this->SetFont('Arial','',11);
      $this->Cell(0,13,"Signature of the Applicant",0,1,"R");
            
      //Display Footer Text
      $this->SetY(-80);
      $this->SetFont('Arial','B',12);
      $this->Cell(0,9,"VERIFICATION CERTIFICATE",0,1,"C");
      $this->SetFont('Arial','',11);
      $this->Cell(0,14,"I have verfied the original documents of candidate.",0,1,"C");

      $this->SetY(-55);
      $this->SetFont('Arial','',11);
      $this->Cell(0,13,"...............................................",0,1,"R");
      
      $this->SetY(-45);
      $this->SetFont('Arial','',11);
      $this->Cell(0,13,"Date............................",0,1,"L");
      $this->SetY(-45);
      $this->Cell(0,13,"Verifier Signature(Father/Guardian)",0,1,"R");
      
    }
    function Footer(){
    
    }
    
  }
}
  //Create A4 Page with Portrait 
  $pdf=new PDF("P","mm","A4");
  $pdf->AddPage();
  $pdf->body($info,$products_info);
  $pdf->Output();
?>