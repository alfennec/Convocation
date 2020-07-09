<?php

  $sql_category = "SELECT COUNT(*) as num FROM convocation";
  $total_category = mysqli_query($connect, $sql_category);
  $total_category = mysqli_fetch_array($total_category);
  $total_category = $total_category['num'];

  /*$sql_news = "SELECT COUNT(*) as num FROM tbl_radio";
  $total_radio = mysqli_query($connect, $sql_news);
  $total_radio = mysqli_fetch_array($total_radio);
  $total_radio = $total_radio['num'];*/

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
                            <div class="color-class-name">Total ( <?php //echo $total_radio; ?> ) Locaux</div>
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
                            <div class="color-class-name">Total ( 10 ) Fictifs</div>
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
                            <div class="color-class-name">Total ( 10 ) Jours</div>
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

                            <?php for($i=0; $i< sizeof($nom); $i++){ ?>
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
                                        <?php //for($i=0; $i< 7; $i++){ ?>
                                            <tr>
                                                <td><span class="label bg-green">1</span></td>
                                                <td>Task A</td>
                                                <td><span class="label bg-green">Doing</span></td>
                                                <td>BERMED</td>
                                                <td>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-green" role="progressbar" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100" style="width: 62%"></div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php //} ?>
                                    </tbody>
                                </table>
                            </div>

                            <?php } ?>

                            <br><br>

                            <center>
                                <a class="btn btn-info" href="#" role="button">
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