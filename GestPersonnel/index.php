<?php 
    ob_start();
	include 'layout/connect.php';
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="template/css/bootstrap.min.css">
	<link rel="stylesheet" href="template/css/font-awesome.min.css">
	<link rel="stylesheet" href="template/css/logn.css">
	<title></title>
</head>
<body>
	<div class="log-logo">
		<h5><span class="fa fa-gears"></span> ProvLar</h5>
	</div>
	<div class="form-div">
		<p>Page  d'authentification</p>
		<form method="POST">
			<div class="form-group">
				<input type="text" name="log" placeholder="Login">
				<span class="fa fa-user"></span>
			</div>
			<div class="form-group">
				<input type="password" name="pwd" placeholder="Mot Pass">
				<span class="fa fa-lock"></span>
			</div>
			<div class="form-group">
				<button type="submit" name="ver-user">Se Connecter</button>
			</div>
		</form>
		<?php 
		if($_SERVER['REQUEST_METHOD']=='POST'){
			if(!empty($_POST['log'])&&!empty($_POST['pwd'])):
				$login = $_POST['log'];
				$MotPass =password_hash($_POST['pwd'], PASSWORD_DEFAULT);
				$stm=$db->prepare("SELECT * FROM authent WHERE Log=? LIMIT 1");
				$stm->execute([$login]);
				$row = $stm->fetch();
				if($stm->rowCount()>0){
					if(password_verify($_POST['pwd'], $row->MotPass)){
					session_start();
					$_SESSION['id_authent']=$row->idAuthent;
					$_SESSION['nom_authent']=$row->Nom;
					$_SESSION['prenom_authent']=$row->Prenom;
					header('Location:accueil.php');
					}
					else{
						echo "<div class='alert alert-danger alert-dismissible'>
					<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Mot de pass est <strong> incorrect ! </strong><br>
					</div>";
					}
				}
				else{
					echo "<div class='alert alert-danger alert-dismissible'>
					<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					Login est <strong> incorrect ! </strong><br>
					</div>";
				}
			else:
				echo "<div class='alert alert-danger alert-dismissible'>
					<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					<strong>Saisie </strong>les champs !
					</div>";
			endif;
			}
		?>
		
	</div>
	<script src="template/js/Jquery.min.js"></script>
	<script src="template/js/bootstrap.min.js"></script>
</body>
</html>
<?php ob_end_flush(); ?>