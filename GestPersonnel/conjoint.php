<?php include 'layout/header.php'; ?>
<?php if (isset($_GET['page'])) {

	# Begin add conjoint page
	if ($_GET['page']=='ajouter'){

		if (isset($_REQUEST['IdEnt'])) :
		$IdEnt=filter_var($_REQUEST['IdEnt'],FILTER_SANITIZE_NUMBER_INT);
		if( !empty(checkIden('identite',$IdEnt)) ) {
			# begin query insert 
	    if (isset($_POST['ajouter'])):
	    if(!empty($_POST['CIN'])&&!empty($_POST['nom'])&&!
			empty($_POST['prenom'])&&!empty($_POST['nomAr'])&&
			!empty($_POST['prenomAr'])&&!empty($_POST['dateN'])&&!empty($_POST['Profession'])){
		$CIN = $_POST['CIN'];
		$nom = $_POST['nom'];
		$nomAr = $_POST['nomAr'];
		$prenom = $_POST['prenom'];
		$prenomAr = $_POST['prenomAr'];
		$dateN = $_POST['dateN'];
		$Profession = $_POST['Profession'];
		$stm=$db->prepare("INSERT INTO conjoint
			           (nom,Prenom,profession,dateNaissance,nomAr,prenomAr,CIN,IdEnt)
			             VALUES (:nom,:prenom,:Profession,:dateN,:nomAr,:prenomAr,:cin,:IdEnt)"
			              );
		$stm->execute([
			'cin'		=> $CIN,
			'nom'		=> $nom,
			'prenom'	=> $prenom,
			'prenomAr'	=> $prenomAr,
			'nomAr'		=> $nomAr,
			'dateN'		=> $dateN,
			'IdEnt'		=> $IdEnt,
			'Profession'=> $Profession]);
		echo "<div class='alert alert-success alert-dismissible'>
	    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				Votre enregistrement est <b>bien Ajouter</b>
			</div>";}
		else{
			echo "<div class='alert alert-danger alert-dismissible'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Tous les<b> Champs est obligatoire</b></div>";
		}
 	endif;
		# End Query insert 
			?>
	<div class="container">
		<div class="header">
	        <p><span class="fa fa-angle-right"></span> Ajouter Conjoint(e)</p>
	    </div>
		<div class="container">
			<form method="POST">
			<div id="contactform">	
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="panel-heading">
							<h4>Conjoint(e) information</h4>
						</div>
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
				        </div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="panel-heading">
							<h4>Profession information</h4>
						</div>
		                <div class="row">
				            <div class="form-inline">
				            	<label>CIN : </label>
				                <input type="text" class="form-control" name="CIN" placeholder="CIN"/>
				            </div>
				            <div class="form-inline">
				            	<label>Profession : </label>
				                <input type="text" class="form-control" name="Profession" placeholder="Profession"/>
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

		if (isset($_REQUEST['idC'])) :
		$idC=filter_var($_REQUEST['idC'],FILTER_SANITIZE_NUMBER_INT);
		if( !empty(checkTable('conjoint','idC',$idC)) ) {
			$result=checkTable('conjoint','idC',$idC);
			# begin query insert 
	    if (isset($_POST['modifier'])):
	    if(!empty($_POST['CIN'])&&!empty($_POST['nom'])&&!
			empty($_POST['prenom'])&&!empty($_POST['nomAr'])&&
			!empty($_POST['prenomAr'])&&!empty($_POST['dateN'])&&!empty($_POST['Profession'])){
		$CIN = $_POST['CIN'];
		$nom = $_POST['nom'];
		$nomAr = $_POST['nomAr'];
		$prenom = $_POST['prenom'];
		$prenomAr = $_POST['prenomAr'];
		$dateN = $_POST['dateN'];
		$Profession = $_POST['Profession'];
		$stm=$db->prepare("UPDATE `conjoint` 
			        SET 
			            `nom` = :nom,
						`prenom` = :prenom,
						`profession` = :Profession,
						`dateNaissance` = :dateN,
						`nomAr` = :nomAr,
						`prenomAr` = :prenomAr,
						`CIN` = :cin 
					WHERE 
					    `conjoint`.`idC` = :idC");
		$stm->execute([
			'cin'		=> $CIN,
			'nom'		=> $nom,
			'prenom'	=> $prenom,
			'prenomAr'	=> $prenomAr,
			'nomAr'		=> $nomAr,
			'dateN'		=> $dateN,
			'idC'		=> $idC,
			'Profession'=> $Profession]);
		header("Refresh:1;url=".$_SERVER['HTTP_REFERER']);
		echo "<div class='alert alert-success alert-dismissible'>
	    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				Votre enregistrement est <b>bien modifier</b>
			</div>";}
		else{
			echo "<div class='alert alert-danger alert-dismissible'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Tous les<b> Champs est obligatoire</b></div>";
		}
 	endif;
		# End Query insert 
			?>
	<div class="container">
		<div class="header">
	        <p><span class="fa fa-angle-right"></span> modifier Conjoint(e)</p>
	    </div>
		<div class="container">
			<form method="POST">
			<div id="contactform">	
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="panel-heading">
							<h4>Conjoint(e) information</h4>
						</div>
		                <div class="row">            
							<div class="form-inline">
				                <input type="text" class="form-control" name="prenom" placeholder="Prénom" value="<?php if (isset($result->prenom)) echo $result->prenom?>" />
				                <input type="text" class="form-control" id="arb" placeholder="اسم الشخصي" lang="ar" selectionDirection="rtl" name="prenomAr" value="<?php if (isset($result->prenomAr)) echo $result->prenomAr?>" />
				            </div>
				            <div class="form-inline">
				                <input type="text" class="form-control" name="nom" placeholder="Nom" value="<?php if (isset($result->nom)) echo $result->nom?>" />
				                <input type="text" class="form-control" id="arb" placeholder="اسم العائلي" selectionDirection="rtl" lang="ar" name="nomAr" value="<?php if (isset($result->nomAr)) echo $result->nomAr?>" />
				            </div>
				            <div class="form-inline">
				                <label>Date Naissance : </label>
				                <input type="Date" class="form-control float-right" name="dateN"  value="<?php if (isset($result->dateNaissance)) echo $result->dateNaissance?>" />
				            </div>
				        </div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="panel-heading">
							<h4>Profession information</h4>
						</div>
		                <div class="row">
				            <div class="form-inline">
				            	<label>CIN : </label>
				                <input type="text" class="form-control" name="CIN" placeholder="CIN"  value="<?php if (isset($result->CIN)) echo $result->CIN?>"  />
				            </div>
				            <div class="form-inline">
				            	<label>Profession : </label>
				                <input type="text" class="form-control" name="Profession" placeholder="Profession"  value="<?php if (isset($result->profession)) echo $result->profession?>" />
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