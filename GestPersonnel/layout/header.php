<?php
    ob_start();
    session_start();
    if(!isset($_SESSION['id_authent'])){
        header ('Location:index.php');
        exit();
    }
    include 'connect.php';
    include 'functions.php';
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="shortcut icon" href="assets/img/favicon.ico">
	<title>Gestion Personnel</title>
	<link href="assets/css/bootstrap.css" rel="stylesheet">
	<link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/all.min.css" rel="stylesheet">
</head>

<body> 
    <div class="wrap">
    <div id="search-wrapper">
        <div class="container">
            <div class="user col-sm-6">
                <img src="assets/img/admin.jpg" height="40" width="40">
                <a href="profile"><?php echo $_SESSION['nom_authent']." ". $_SESSION['prenom_authent']  ?></a>
                <ul class="user-nav">
                    <li><a href="" data-toggle="modal" data-target="#myModal">Edit Mot-Pass /</a></li>
                    <li><a href="deconnect.php"> Déconnecter</a></li>
                </ul>
            </div>
            <div class="col-sm-6">
                <form method="GET" action="fonctionaire" class="form-inline" id="search-wrapper">
                    <input type="hidden" name="page" value="detail">
                    <input type="search" name="cin" class="" placeholder="Entrer CIN">
                    <button class="search-btn" ><span class="fa fa-search"></span></button>
                </form>
            </div>
        </div>
    </div>
    
    <!-- END NAV -->
    <nav class="menu" id="theMenu">
        <div class="menu-wrap">
            <i class="fa fa-bars menu-close"></i>
            <div id="menu-logo">
                <h2><span class="fas fa-cogs"></span> ProvLar</h2>
            </div>
            <ul id="main-menu">
                <li class="dropdown">
                    <a href="accueil.php">Accueil <i class="fas fa-home menu-icon"></i> </a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Gérer Fonctionaires <i class="fas fa-user-tie menu-icon"></i></a>
                    <ul class="dropdown-menu">
                        <li><a href="fonctionaire.php?page=manage">Dossier Social</a></li>  
                        <li><a href="administratif.php?page=manage">Dossier Administratif</a></li>                  
                    </ul>
                </li>   
                <li class="dropdown">
                    <a href="fonctionaire.php?page=ajouter">Ajouter Fonctionaire<i class="fas fa-plus-square menu-icon"></i></a>
                </li>
                <li class="dropdown">
                    <a href="profile.php">Modifier profile <i class="fas fa-user-cog menu-icon"></i></a>
                </li>
                <li class="dropdown">
                    <a href="deconnect.php">Déconnecter <i class="fas fa-sign-out-alt menu-icon"></i> </a>
                </li>
            </ul>
        </div>
    </nav>
    <!-- END NAV -->

 <!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <form class="modal-dialog" method="POST">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <p>Modifier Mot de pass</p>
      </div>
      <div class="modal-body" id="contactform">
            <div class="form-inline">
                <input type="password" class="form-control" name="opwd" placeholder="Mot de pass actuel" value="" />
            </div>
            <div class="form-inline">
                <input type="password" class="form-control" name="npwd" placeholder="Nouveau mot de pass" value="" />
            </div>
            <div class="form-inline">
                <input type="password" class="form-control" name="cpwd" placeholder="Confirm mot de pass" value="" />
            </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-outlined btn-primary" type="submit" name="Edit">Modifier</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
      </div>
    </div>

  </form>
</div>

<?php if (isset($_POST['Edit'])) {
    $MotPass=password_hash($_POST['cpwd'], PASSWORD_DEFAULT);
   $stm=$db->prepare("UPDATE `authent` SET `MotPass`=?");
        $stm->execute([$MotPass]);
    echo "<div class='alert alert-success'>
           Bien Modifier...
        </div>";
    header("Refresh:1;url=".$_SERVER['HTTP_REFERER']);
} ?>