<?php include 'layout/header.php'; ?>
<?php if (isset($_GET['page'])) {

	# Begin add conjoint page
	if ($_GET['page']=='ajouter'){

		if (isset($_REQUEST['idC'])) :
		$idC=filter_var($_REQUEST['idC'],FILTER_SANITIZE_NUMBER_INT);
		if( !empty(checkTable('conjoint','idC',$idC)) ) {
			# begin query insert 
	    if (isset($_POST['ajouter'])):
		$nom = $_POST['nom'];
		$nomAr = $_POST['nomAr'];
		$prenom = $_POST['prenom'];
		$prenomAr = $_POST['prenomAr'];
		$dateN = $_POST['dateN'];
		$sexe = $_POST['sexe'];
		$stm=$db->prepare("INSERT INTO `enfant`(`Nom`, `Prenom`, `NomAr`, `PrenomAr`, `DateNa`, `Sexe`, `idC`) VALUES (:nom,:prenom,:nomAr,:prenomAr,:dateN,:sexe,:idC)"
			              );
		$stm->execute([
			'nom'		=> $nom,
			'prenom'	=> $prenom,
			'prenomAr'	=> $prenomAr,
			'nomAr'		=> $nomAr,
			'dateN'		=> $dateN,
			'idC'		=> $idC,
			'sexe'=> $sexe]);
		echo "<div class='alert alert-success alert-dismissible'>
	    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				Votre enregistrement est <b>bien Ajouter</b>
			</div>";
 	endif;
		# End Query insert 
			?>
	<div class="container">
		<div class="header">
	        <p><span class="fa fa-angle-right"></span> Ajouter Enfant</p>
	    </div>
		<div class="container">
			<form method="POST">
			<div id="contactform">	
				<div class="panel panel-default">
					<div class="panel-body">
		                <div class="row">            
							<div class="form-inline">
				                <input type="text" class="form-control" name="prenom" placeholder="Prénom" value="" />
				                <input type="text" class="form-control" id="arb" placeholder="اسم الشخصي" lang="ar" selectionDirection="rtl" name="prenomAr" />
				            </div>
				            <div class="form-inline">
				                <input type="text" class="form-control" name="nom" placeholder="Nom" value="" />
				                <input type="text" class="form-control" id="arb" placeholder="اسم العائلي" selectionDirection="rtl" lang="ar" name="nomAr" />
				            </div>
				            <div class="form-inline">
				                <label>Date Naissance : </label>
				                <input type="Date" class="form-control float-right" name="dateN" />
				            </div>
				            <div class="form-inline">
				                <label>Sexe : </label>
				                <div class="radio-group"> 
				                    <input type="radio" value="Homme" name="sexe" class="" id="homme" /> <label for="homme"> Homme</label> 
				                    <input type="radio" value="Femme" name="sexe" id="femme"/> <label for="femme"> Femme</label>
				                </div>
				            </div>
				        </div>
					</div>
				</div>
	            <button class="btn btn-outlined btn-primary vrf" type="submit" name="ajouter">Ajouter</button>
	        </div>
        </form>
		</div>
	</div>
	<?php 
	    
	}
 endif;

    }#end of add conjoint page

    # Begin modifier conjoint page
	if ($_GET['page']=='modifier'){

		if (isset($_GET['idE'])) :
		$idE=filter_var($_GET['idE'],FILTER_SANITIZE_NUMBER_INT);
		if( !empty(checkTable('enfant','idE',$idE)) ) {
			$result=checkTable('enfant','idE',$idE);
			# begin query insert 
	    if (isset($_POST['modifier'])):
		$nom = $_POST['nom'];
		$nomAr = $_POST['nomAr'];
		$prenom = $_POST['prenom'];
		$prenomAr = $_POST['prenomAr'];
		$dateN = $_POST['dateN'];
		$sexe = $_POST['sexe'];
		$stm=$db->prepare("UPDATE `enfant` 
			        SET 
			            `Nom` = :nom,
						`Prenom` = :prenom,
						`DateNa` = :dateN,
						`NomAr` = :nomAr,
						`Sexe` = :sexe,
						`PrenomAr` = :prenomAr
					WHERE 
					    `idE` = :idE");
		$stm->execute([
			'nom'		=> $nom,
			'prenom'	=> $prenom,
			'prenomAr'	=> $prenomAr,
			'nomAr'		=> $nomAr,
			'dateN'		=> $dateN,
			'idE'		=> $idE,
			'sexe'=> $sexe]);
		header("Refresh:1;url=".$_SERVER['HTTP_REFERER']);
		echo "<div class='alert alert-success alert-dismissible'>
	    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				Votre enregistrement est <b>bien modifier</b>
			</div>";
 	endif;
		# End Query insert 
			?>
	<div class="container">
		<div class="header">
	        <p><span class="fa fa-angle-right"></span> modifier Enfant</p>
	    </div>
		<div class="container">
			<form method="POST">
			<div id="contactform">	
				<div class="panel panel-default">
					<div class="panel-body">
		                <div class="row">            
							<div class="form-inline">
				                <input type="text" class="form-control" name="prenom" placeholder="Prénom" value="<?php if (isset($result->Prenom)) echo $result->Prenom?>" />
				                <input type="text" class="form-control" id="arb" placeholder="اسم الشخصي" lang="ar" selectionDirection="rtl" name="prenomAr" value="<?php if (isset($result->PrenomAr)) echo $result->PrenomAr?>" />
				            </div>
				            <div class="form-inline">
				                <input type="text" class="form-control" name="nom" placeholder="Nom" value="<?php if (isset($result->Nom)) echo $result->Nom?>" />
				                <input type="text" class="form-control" id="arb" placeholder="اسم العائلي" selectionDirection="rtl" lang="ar" name="nomAr" value="<?php if (isset($result->NomAr)) echo $result->NomAr?>" />
				            </div>
				            <div class="form-inline">
				                <label>Date Naissance : </label>
				                <input type="Date" class="form-control float-right" name="dateN"  value="<?php if (isset($result->DateNa)) echo $result->DateNa?>" />
				            </div>
				            <div class="form-inline">
				                <label>Sexe : </label>
				                <div class="radio-group"> 
				                    <input type="radio" value="Homme" name="sexe" class="" id="homme" <?php if (isset($result->Sexe) && $result->Sexe=='Homme') echo "checked"?>/> <label for="homme"> Homme</label> 
				                    <input type="radio" value="Femme" name="sexe" id="femme" <?php if (isset($result->Sexe) && $result->Sexe=='Femme') echo "checked"?>/> <label for="femme"> Femme</label>
				                </div>
				            </div>
				        </div>
					</div>
				</div>
	            <button class="btn btn-outlined btn-primary vrf" type="submit" name="modifier">modifier</button>
	        </div>
        </form>
		</div>
	</div>
	<?php 
	    
	}
 endif;

    }#end of add diplome page

} else{header('Location:accueil.php'); exit(); }include 'layout/footer.php'; ?>