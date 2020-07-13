<?php include '../includes/config.php' ?>
<?php
    $apogee = $_GET['apogee'];
    $sql_query = "SELECT * FROM convocation WHERE apogee = ? ";
            
    // create array variable to store previous data
    $data = array();

    
		$stmt = $connect->stmt_init();
        if ($stmt->prepare($sql_query)) 
        {	
			// Bind your variables to replace the ?s
			$stmt->bind_param('s', $apogee);
			
			// Execute query
			$stmt->execute();
			// store result 
			$stmt->store_result();
			$stmt->bind_result( 
                $data['id'],
                $data['examen'],
                $data['apogee'],
                $data['nom'],
                $data['prenom'],
                $data['mod1'],
                $data['mod2'],
                $data['mod3'],
                $data['mod4'],
                $data['mod5'],
                $data['mod6'],
                $data['mod7'],
                $data['semestre'],
                $data['local'],
                $data['session'],
                $data['num_table']
					);
			// get total records
			$total_records = $stmt->num_rows;
        }
        
        $id = array();
        $examen = array();
        $apogee = array();
        $nom = array();
        $prenom = array();
        $mod1 = array();
        $mod2 = array();
        $mod3 = array();
        $mod4 = array();
        $mod5 = array();
        $mod6 = array();
        $mod7 = array();
        $semestre = array();
        $local = array();
        $session = array();
        $num_table = array();

        $i=0;
        while ($stmt->fetch()) 
        { 
            $id[$i]=        $data['id'];
            $examen[$i]=    $data['examen'];
            $apogee[$i]=    $data['apogee'];
            $nom[$i]=       $data['nom'];
            $prenom[$i]=    $data['prenom'];
            $mod1[$i] = $data['mod1'];
            $mod2[$i] = $data['mod2'];
            $mod3[$i] = $data['mod3'];
            $mod4[$i] = $data['mod4'];
            $mod5[$i] = $data['mod5'];
            $mod6[$i] = $data['mod6'];
            $mod7[$i] = $data['mod7'];
            $semestre[$i] = $data['semestre'];
            $local[$i] = $data['local'];
            $session[$i] = $data['session'];
            $num_table[$i] = $data['num_table'];

            $i++;
        }





        $id_cal = array();
        $semestre_cal = array();
        $date_day = array();
        $date_heure = array();
        $module = array();

        function getCal($connect, $semestre)
  {
        $sql_query = "SELECT * FROM calendrier WHERE semestre = ? ";
        $data = array();
		$stmt = $connect->stmt_init();
        if ($stmt->prepare($sql_query)) 
        {	
			// Bind your variables to replace the ?s
			$stmt->bind_param('s', $semestre);
			
			// Execute query
			$stmt->execute();
			// store result 
			$stmt->store_result();
			$stmt->bind_result( 
                $data['id'],
                $data['semestre'],
                $data['date_day'],
                $data['date_heure'],
                $data['module']
					);
			// get total records
			$total_records = $stmt->num_rows;
        }

        $i=0;
        while ($stmt->fetch()) 
        { 
            $GLOBALS['id_cal'][$i]  =    $data['id'];
            $GLOBALS['semestre_cal'][$i]   =    $data['semestre'];
            $GLOBALS['date_day'][$i]       =    $data['date_day'];
            $GLOBALS['date_heure'][$i]     =    $data['date_heure'];
            $GLOBALS['module'][$i]         =    $data['module'];
           
            $i++;
        }
  }
         
?>

<?php
require('fpdf.php');

class PDF extends FPDF
{
    // En-tête
    function Header()
    {
        // Logo
        $this->Image('../assets/images/ic_launcher.png',90,6,40);
        // Police Arial gras 15
        $this->SetFont('Arial','B',20);
        // Décalage à droite
        $this->Ln(40);

        $this->Cell(50);
        // Titre
        $this->Cell(95,10,"Convocation pour l'examen",1,0,'C');
        // Saut de ligne
        $this->Ln(20);

        $this->SetFont('Arial','B',15);

        $this->Cell(50);
        // Titre
        $this->Cell(80,10,"Examen Printemps 2019/2020 - Session Ordinaire",0,0,'C');

        $this->Ln(15);
    }


    // Pied de page
    function Footer()
    {
        // Positionnement à 1,5 cm du bas
        $this->SetY(-15);
        // Police Arial italique 8
        $this->SetFont('Arial','I',8);
        // Numéro de page
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }

    // Tableau simple
    function BasicTable($header, $data)
    {
        for ($i=0; $i< sizeof($GLOBALS['nom']); $i++) 
        {
            getCal($GLOBALS['connect'], $GLOBALS['semestre'][$i]);
        
            $this->SetFont('Times','B',12);

            $this->Cell(40,10,utf8_decode("Filière / Semestre : "));
            $this->Cell(0,10,$GLOBALS['semestre'][$i],0,1);

             // En-tête
            //foreach($header as $col)
            
            $this->Cell(20,10,utf8_decode("Num-Exa"),1,0,'C');
            $this->Cell(55,10,utf8_decode("Module"),1,0,'C');
            $this->Cell(20,10,utf8_decode("Date"),1,0,'C');
            $this->Cell(25,10,utf8_decode("Horaire"),1,0,'C');
            $this->Cell(70,10,utf8_decode("Local"),1,0,'C');

            $this->Ln();

            $this->SetFont('Times','',10);

            if($GLOBALS['mod1'][$i] == "I")
            {
                $this->Cell(20,10,utf8_decode($GLOBALS['examen'][$i]),1);
                $this->Cell(55,10,utf8_decode($GLOBALS['module'][0]),1);
                $this->Cell(20,10,utf8_decode($GLOBALS['date_day'][0]),1);
                $this->Cell(25,10,utf8_decode($GLOBALS['date_heure'][0]),1);
                $this->Cell(70,10,utf8_decode($GLOBALS['local'][$i]),1);
        
                $this->Ln();
            }

            if($GLOBALS['mod2'][$i] == "I")
            {
                $this->Cell(20,10,utf8_decode($GLOBALS['examen'][$i]),1);
                $this->Cell(55,10,utf8_decode($GLOBALS['module'][1]),1);
                $this->Cell(20,10,utf8_decode($GLOBALS['date_day'][1]),1);
                $this->Cell(25,10,utf8_decode($GLOBALS['date_heure'][1]),1);
                $this->Cell(70,10,utf8_decode($GLOBALS['local'][$i]),1);
        
                $this->Ln();
            }

            if($GLOBALS['mod3'][$i] == "I")
            {
                $this->Cell(20,10,utf8_decode($GLOBALS['examen'][$i]),1);
                $this->Cell(55,10,utf8_decode($GLOBALS['module'][2]),1);
                $this->Cell(20,10,utf8_decode($GLOBALS['date_day'][2]),1);
                $this->Cell(25,10,utf8_decode($GLOBALS['date_heure'][2]),1);
                $this->Cell(70,10,utf8_decode($GLOBALS['local'][$i]),1);
        
                $this->Ln();
            }

            if($GLOBALS['mod4'][$i] == "I")
            {
                $this->Cell(20,10,utf8_decode($GLOBALS['examen'][$i]),1);
                $this->Cell(55,10,utf8_decode($GLOBALS['module'][3]),1);
                $this->Cell(20,10,utf8_decode($GLOBALS['date_day'][3]),1);
                $this->Cell(25,10,utf8_decode($GLOBALS['date_heure'][3]),1);
                $this->Cell(70,10,utf8_decode($GLOBALS['local'][$i]),1);
        
                $this->Ln();
            }

            if($GLOBALS['mod5'][$i] == "I")
            {
                $this->Cell(20,10,utf8_decode($GLOBALS['examen'][$i]),1);
                $this->Cell(55,10,utf8_decode($GLOBALS['module'][4]),1);
                $this->Cell(20,10,utf8_decode($GLOBALS['date_day'][4]),1);
                $this->Cell(25,10,utf8_decode($GLOBALS['date_heure'][4]),1);
                $this->Cell(70,10,utf8_decode($GLOBALS['local'][$i]),1);
        
                $this->Ln();
            }

            if($GLOBALS['mod6'][$i] == "I")
            {
                $this->Cell(20,10,utf8_decode($GLOBALS['examen'][$i]),1);
                $this->Cell(55,10,utf8_decode($GLOBALS['module'][5]),1);
                $this->Cell(20,10,utf8_decode($GLOBALS['date_day'][5]),1);
                $this->Cell(25,10,utf8_decode($GLOBALS['date_heure'][5]),1);
                $this->Cell(70,10,utf8_decode($GLOBALS['local'][$i]),1);
        
                $this->Ln();
            }

            if($GLOBALS['mod7'][$i] == "I")
            {
                $this->Cell(20,10,utf8_decode($GLOBALS['examen'][$i]),1);
                $this->Cell(55,10,utf8_decode($GLOBALS['module'][6]),1);
                $this->Cell(20,10,utf8_decode($GLOBALS['date_day'][6]),1);
                $this->Cell(25,10,utf8_decode($GLOBALS['date_heure'][6]),1);
                $this->Cell(70,10,utf8_decode($GLOBALS['local'][$i]),1);
        
                $this->Ln();
            }


            ///final 
            $this->Ln(5);

        }
    }
}

// Instanciation de la classe dérivée
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',14);
// Titre
$pdf->Cell(40,10,utf8_decode("Nom et Prénom : "));
$pdf->Cell(80,10,$nom[0]." ".$prenom[0],0,1);

$pdf->Cell(40,10,utf8_decode("Apogée : "));
$pdf->Cell(0,10,$apogee[0],0,1);

$pdf->Ln(5);

$header="";$data="";

$pdf->BasicTable($header,$data);

$pdf->Ln(5);

$pdf->SetFont('Times','',12);

$pdf->MultiCell(0,5,utf8_decode("Consigne à suivre ! N'oublier pas votre CIN, Carte d'étudiant et l'imprimé de la convocation."));
$pdf->Ln(2);
$pdf->MultiCell(0,5,utf8_decode("Attention ! En cas de désaccord sur les informations ci-dessus nous saurions grè de se présenter aux services de la scolarité avant la période des examens."));


$pdf->Output();
?>