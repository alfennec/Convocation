<?php

    $id_cal = array();
    $semestre_cal = array();
    $date_day = array();
    $date_heure = array();
    $module = array();

  $sql_category = "SELECT COUNT(*) as num FROM convocation";
  $total_category = mysqli_query($connect, $sql_category);
  $total_category = mysqli_fetch_array($total_category);
  $total_category = $total_category['num'];

  /*$sql_news = "SELECT COUNT(*) as num FROM tbl_radio";
  $total_radio = mysqli_query($connect, $sql_news);
  $total_radio = mysqli_fetch_array($total_radio);
  $total_radio = $total_radio['num'];*/

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
            $GLOBALS['id_cal'][$i]         =    $data['id'];
            $GLOBALS['semestre_cal'][$i]   =    $data['semestre'];
            $GLOBALS['date_day'][$i]       =    $data['date_day'];
            $GLOBALS['date_heure'][$i]     =    $data['date_heure'];
            $GLOBALS['module'][$i]         =    $data['module'];
           
            $i++;
        }
  }
?>

    <section class="content">

    <ol class="breadcrumb">
        <li><a href="dashboard.php">Tableaux de bord</a></li>
        <li class="active">Acceuil</a></li>
    </ol>

        <div class="container-fluid">
             
             <div class="row">

                <a href="manage-category.php">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="card demo-color-box bg-blue waves-effect col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <br>
                            <div class="color-name">Nombres des Etudiants</div>
                            <div class="color-name"><i class="material-icons">people</i></div>
                            <div class="color-class-name">Total ( <?php echo $total_category; ?> ) Etudiants</div>
                            <br>
                        </div>
                    </div>
                </a>

               <a href="manage-radio.php">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="card demo-color-box bg-blue waves-effect col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <br>
                            <div class="color-name">Nombres de locaux</div>
                            <div class="color-name"><i class="material-icons">domain</i></div>
                            <div class="color-class-name">Total ( 284 ) Locaux</div>
                            <br>
                        </div>
                    </div>
                </a>

                <a href="members.php">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="card demo-color-box bg-blue waves-effect col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <br>
                            <div class="color-name">Nombres des Fictifs</div>
                            <div class="color-name"><i class="material-icons">list_alt</i></div>
                            <div class="color-class-name">Total ( 200 ) Fictifs</div>
                            <br>
                        </div>
                    </div>
                </a>

                <a href="settings.php">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="card demo-color-box bg-blue waves-effect col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <br>
                            <div class="color-name">Nombres des Jours d'examen</div>
                            <div class="color-name"><i class="material-icons">settings</i></div>
                            <div class="color-class-name">Total ( 7 ) Jours</div>
                            <br>
                        </div>
                    </div>
                </a>

            </div>




            <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2 class="align-center">Convocation pour l'examen du Printemps Session Ordinaire</h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Impression PDF</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">

                            <div class="row clearfix">
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 ">
                                    <h5>Nom & Prénom : <?php echo $nom[0]." ".$prenom[0]; ?></h5>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 align-right">
                                    <h5>Session : Printemps - Ordinaire</h5>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 align-left">
                                    <h5>Apogée : <?php echo $apogee[0]; ?></h5>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 align-right">
                                    <h5></h5>
                                </div>
                            </div>

                            <br>

                            <?php for($i=0; $i< sizeof($nom); $i++)
                                    { 
                                        getCal($connect, $semestre[$i])
                            ?>
                            <h4>Filière/Semetre : <?php echo $semestre[$i]; ?></h4>

                            <div class="table-responsive">
                                <table class="table table-hover dashboard-task-infos">
                                    <thead>
                                        <tr>
                                            <th>NUMERO EXAMEN</th>
                                            <th>MODULE</th>
                                            <th>DATE</th>
                                            <th>HORAIRE</th>
                                            <th>LOCAL</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php if($mod1[$i] == "I"){ ?>
                                            <tr>
                                                <td><span class="label bg-green"><?php echo $examen[$i]; ?></span></td>
                                                <td><?php echo $module[0]; ?></td>
                                                <td><?php echo $date_day[0]; ?></td>
                                                <td><?php echo $date_heure[0]; ?></td>
                                                <td>
                                                    <span class="label bg-green"> <?php echo $local[$i]; ?> </span>
                                                </td>
                                            </tr>
                                        <?php } ?>

                                        <?php if($mod2[$i] == "I"){ ?>
                                            <tr>
                                                <td><span class="label bg-green"><?php echo $examen[$i]; ?></span></td>
                                                <td><?php echo $module[1]; ?></td>
                                                <td><?php echo $date_day[1]; ?></td>
                                                <td><?php echo $date_heure[1]; ?></td>
                                                <td>
                                                    <span class="label bg-green"> <?php echo $local[$i]; ?> </span>
                                                </td>
                                            </tr>
                                        <?php } ?>

                                        <?php if($mod3[$i] == "I"){ ?>
                                            <tr>
                                                <td><span class="label bg-green"><?php echo $examen[$i]; ?></span></td>
                                                <td><?php echo $module[2]; ?></td>
                                                <td><?php echo $date_day[2]; ?></td>
                                                <td><?php echo $date_heure[2]; ?></td>
                                                <td>
                                                    <span class="label bg-green"> <?php echo $local[$i]; ?> </span>
                                                </td>
                                            </tr>
                                        <?php } ?>

                                        <?php if($mod4[$i] == "I"){ ?>
                                            <tr>
                                                <td><span class="label bg-green"><?php echo $examen[$i]; ?></span></td>
                                                <td><?php echo $module[3]; ?></td>
                                                <td><?php echo $date_day[3]; ?></td>
                                                <td><?php echo $date_heure[3]; ?></td>
                                                <td>
                                                    <span class="label bg-green"> <?php echo $local[$i]; ?> </span>
                                                </td>
                                            </tr>
                                        <?php } ?>

                                        <?php if($mod5[$i] == "I"){ ?>
                                            <tr>
                                                <td><span class="label bg-green"><?php echo $examen[$i]; ?></span></td>
                                                <td><?php echo $module[4]; ?></td>
                                                <td><?php echo $date_day[4]; ?></td>
                                                <td><?php echo $date_heure[4]; ?></td>
                                                <td>
                                                    <span class="label bg-green"> <?php echo $local[$i]; ?> </span>
                                                </td>
                                            </tr>
                                        <?php } ?>

                                        <?php if($mod6[$i] == "I"){ ?>
                                            <tr>
                                                <td><span class="label bg-green"><?php echo $examen[$i]; ?></span></td>
                                                <td><?php echo $module[5]; ?></td>
                                                <td><?php echo $date_day[5]; ?></td>
                                                <td><?php echo $date_heure[5]; ?></td>
                                                <td>
                                                    <span class="label bg-green"> <?php echo $local[$i]; ?> </span>
                                                </td>
                                            </tr>
                                        <?php } ?>

                                        <?php if($mod7[$i] == "I"){ ?>
                                            <tr>
                                                <td><span class="label bg-green"><?php echo $examen[$i]; ?></span></td>
                                                <td><?php echo $module[6]; ?></td>
                                                <td><?php echo $date_day[6]; ?></td>
                                                <td><?php echo $date_heure[6]; ?></td>
                                                <td>
                                                    <span class="label bg-green"> <?php echo $local[$i]; ?> </span>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>

                            <?php } ?>

                            <br><br>

                            <center>
                                <a class="btn btn-info" href="pdf/?apogee=<?php echo $apogee[0]; ?>" role="button">
                                    <h5>
                                        <i class="material-icons">picture_as_pdf</i>
                                        Impression de la convocation
                                    </h5>
                                </a>
                            </center>

                            <br><br>

                            <div class="body">
                                <div class="alert alert-success">
                                    <strong>Consigne à suivre !</strong> N'oublier pas votre CIN, Carte d'étudiant et l'imprimé de la convocation.
                                </div>
                                
                                <div class="alert alert-danger">
                                    <strong>Attention !</strong> En cas de désaccord sur les informations ci-dessus nous saurions grè de se présenter aux services de la scolarité avant la période des examens.
                                </div>
                            </div>

                            
                        </div>
                    </div>
                </div>
                <!-- #END# Task Info -->
            </div>


            
        </div>

    </section>