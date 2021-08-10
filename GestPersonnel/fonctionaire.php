<?php include 'layout/header.php';
?>

<!-- Fonctionaire details -->
<?php if (isset($_GET['page'])) {

	# Begin Fonctionaire detail page
	if ($_GET['page']=='detail'){
		if (isset($_REQUEST['cin'])) :
		$cin=filter_var($_REQUEST['cin'],FILTER_SANITIZE_STRING);
		if(!empty(checkTable('identite',null,$cin)) ) {
		$result=checkTable('identite',null,$cin);
		$affect=checkIden('affectation',$result->IdEnt);
		$grade=checkIden('grade',$result->IdEnt);
?>
	<div class="container" id="container">
        <div class="fonc-details">
            <div>
                <a href="?page=modifier&IdEnt=<?=$result->IdEnt?>" class="btn btn-outlined btn-primary"> Modifier</a>
                <a href="?page=detail&action=delete&cin=<?=$result->CIN?>" class="btn btn-outlined btn-danger"> Supprimer</a>
            </div>
            <div class="pers-prof panel panel-default">
                <div class="panel-heading">
                    <h4><?=$result->CIN?></h4>
                </div>
                <div class="panel-body">
                	<div class="row">
                    <div class="col-sm-4">
                        <div style="background: url(<?=$result->Photo?>); height: 120px;width: 120px;background-size: cover;
                          background-position: center;">
                            </div>
                    </div>
                    <div class="col-sm-4">
                        <ul class="list-unstyled fonct-name">
                            <li>
                            	<h3><?=$result->Nom?> <?=$result->Prenom?></h3>
                            </li>
                            <li>
                            	<h3><?=$result->Nom_ar?> <?=$result->Prenom_ar?></h3>
                            </li>
                            <li><?=$result->DateNassance?>, <?=$result->LieuNaissance?>, <?=$result->PayNaissance?></li>
                            <li><?=$result->Sexe?></li>
                        </ul>
                    </div>
                    <div class="col-sm-4">
                        <ul class="list-unstyled fonct-nav">
                            <li><a href="cv?page=detail&IdEnt=<?=$result->IdEnt?>"><span class="fa fa-angle-double-right"></span> Curriculum vitae</a></li>
                            <li><a href="social?IdEnt=<?=$result->IdEnt?>"><span class="fa fa-angle-double-right"></span> Information Social</a></li>
                            <li><a href="st?IdEnt=<?=$result->IdEnt?>"><span class="fa fa-angle-double-right"></span> Situation familiale</a></li>
                        </ul>
                    </div>
                    </div>
                </div>
            </div>
            <div class="pers-info  panel panel-default">
                <div class="panel-heading">
                    <h4>Contact information</h4>
                </div>
                <div class="panel-body">
                	<div class="row">
	                    <div class="col-sm-6">Num de portable : </div>
	                    <div class="col-sm-6"><?=$result->NPort?></div>
	                </div>
                    <div class="row">
	                    <div class="col-sm-6">Num de fixe : </div>
	                    <div class="col-sm-6"><?=$result->NFix?></div>
	                </div>
                    <div class="row">
	                    <div class="col-sm-6">Email : </div>
	                    <div class="col-sm-6"><?=$result->Email?></div>
                    </div>
                    <div class="row">
	                    <div class="col-sm-6">Adresse : </div>
	                    <div class="col-sm-6"><?=$result->Adresse?></div>
	                </div>
                </div>
            </div>
            <div class="autre panel panel-default">
                <div class="panel-heading">
                    <h4>Autre</h4>
                </div>
                <div class="panel-body">
                	<div class="row">
	                    <div class="col-sm-6">Etat matrimonial : </div>
	                    <div class="col-sm-6"><?=$result->EtatMatrimonial?></div>
                    </div>
                    <div class="row">
	                    <div class="col-sm-6">Date de recrutement : </div>
	                    <div class="col-sm-6"><?=$result->DateRecrutement?></div>
                    </div>
	                    <div class="row">
	                    <div class="col-sm-6">Imputation budgétaire : </div>
                    <div class="col-sm-6"><?=$result->ImputationBudg?> </div>
                    </div>
                    <div class="row">
	                    <div class="col-sm-6">PPR : </div>
	                    <div class="col-sm-6"><?=$result->PPR?></div>
	                    </div>
                </div>
            </div>
            <div class="panel panel-default">
		        <div class="panel-heading">
		            <h4><span class="fa fa-paperclip"></span> Observation</h4>
		        </div>
            	<div class="panel-body">
            		<div class="row"><p><?=$result->Observation?></p></div>
            	</div>
            </div>
        </div>
    </div>
<?php 
	}
	else{
		echo "<div class='message-item'>
        <p><b>Pas </b>de Résultat !</p>
              </div>";
	}
	else:
		header('Location:accueil');
		exit();
	endif;
  }
	# End detail Fonctionaire page

	# Begin Add Fonctionaire page
    elseif ($_GET['page']=='ajouter') {	
		 if (isset($_POST['ajouter'])):
		 	# Began photo upload
			if(isset($_FILES['user_photo']['name'])){
		    $name=$_FILES['user_photo']['name'];
			$e = explode('.',$name);$exten = end($e);
			$AllowExt = ['png','jpg','jpeg','gif'];
			if (in_array($exten, $AllowExt)) {
			$target="uploads/".rand().basename($name);
			$photo=$_FILES['user_photo']['tmp_name'];
			move_uploaded_file($photo,$target);}
			}# end photo upload
		if(!empty($_POST['CIN'])&&!empty($_POST['nom'])&&!
			empty($_POST['prenom'])&&!empty($_POST['nomAr'])&&
			!empty($_POST['prenomAr'])&&!empty($_POST['dateN'])&&
			!empty($_POST['payN'])&&!empty($_POST['lieuN'])&&
			!empty($_POST['etatM'])&&!empty($_POST['sexe'])&&
			!empty($_POST['dateR'])&&!empty($_POST['imputatB'])&&
			!empty($_POST['PPR'])&&!empty($_POST['nPortable'])&&
			!empty($_POST['nFixe'])&&!empty($_POST['email'])&&
			!empty($_POST['adresse'])&&!empty($_POST['observation'])){
		$CIN = $_POST['CIN'];
		$nom = $_POST['nom'];
		$nomAr = $_POST['nomAr'];
		$prenom = $_POST['prenom'];
		$prenomAr = $_POST['prenomAr'];
		$dateN = $_POST['dateN'];
		$payN = $_POST['payN'];
		$lieuN = $_POST['lieuN'];
		$etatM = $_POST['etatM'];
		$sexe = $_POST['sexe'];
		$dateR = $_POST['dateR'];
		$imputatB = $_POST['imputatB'];
		$PPR = $_POST['PPR'];
		$nPortable = $_POST['nPortable'];
		$nFixe = $_POST['nFixe'];
		$email = $_POST['email'];
		$adresse = $_POST['adresse'];
		$observation = $_POST['observation'];
		$photo = isset($target)?$target:"assets/img/avatar.png";
		$stm=$db->prepare("INSERT INTO identite
			           (CIN,Nom,Prenom,Nom_ar,Prenom_ar,
			           DateNassance,LieuNaissance,PayNaissance,
			           Sexe,EtatMatrimonial,DateRecrutement,
			           ImputationBudg,PPR,NPort,NFix,Email,
			           Adresse,Photo,Observation)
			             VALUES 
			                (:cin, :nom, :prenom,:nomAr,
			             	:prenomAr,:dateN,:lieuN,:payN,
			             	:sexe,:etatM,:dateR,:imputatB,
			             	:PPR,:nPortable,:nFixe,:email,
			             	:adresse,:photo,:observation)"
			              );
		$stm->execute([
			'cin'		=> $CIN,
			'nom'		=> $nom,
			'prenom'	=> $prenom,
			'prenomAr'	=> $prenomAr,
			'nomAr'		=> $nomAr,
			'dateN'		=> $dateN,
			'lieuN'		=> $lieuN,
			'payN'		=> $payN,
			'sexe'		=> $sexe,
			'etatM'		=> $etatM,
			'dateR'		=> $dateR,
			'imputatB'	=> $imputatB,
			'PPR'		=> $PPR,
			'nPortable'	=> $nPortable,
			'nFixe'		=> $nFixe,
			'email'		=> $email,
			'adresse'	=> $adresse,
			'photo'		=> $photo,
		  'observation'	=> $observation]);
		echo "<div class='alert alert-success alert-dismissible'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Votre enregistrement est <b>bien Ajouter</b></div>";
			}
			else{
				echo "<div class='alert alert-danger alert-dismissible'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Tous les<b> Champs est obligatoire</b></div>";
			}
 	endif;
	?>
	<div class="header">
        <p>Ajouter Fonctionnaire</p>
        <div class="line"></div>
    </div>
	<div class="container">
		<form method="POST" enctype="multipart/form-data">
			<div id="contactform">
	            <div class="form-inline">
	                <input type="text" class="form-control" name="CIN" placeholder="CIN" />
	                <button class="btn btn-outlined btn-default vrf" name="verifier" type="submit">verifier</button>
	                <p style="display: inline-block; font-weight: bold; margin-left: 12px"><?php 
	                	if (isset($_POST['verifier'])) {
	                        $cin= $_POST['CIN'];
	                		if ( !empty( checkTable('identite',null,$cin) ) ) {
                               	echo "Déja exists";
                               } else {
                                 echo "Pas exists";
                               }
                                
	                	}?>
	                </p>
	            </div>
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="row">
							<div class="col-md-6">
								<div class="form-photo">
						          <input type="file" class="file-input" name="user_photo" accept="image/*" onchange="uploadFl (event)" />
						          <div class="fonct-avatar" id="output">
						           <p>Photo</p>
						         </div>
						        </div>
							</div>
							<div class="col-md-6">
					            <div class="form-inline">
					                <input type="text" class="form-control" name="prenom" placeholder="Prénom" />
					                <input type="text" class="form-control" id="arb" placeholder="اسم الشخصي" lang="ar" selectionDirection="rtl" name="prenomAr" />
					            </div>
					            <div class="form-inline">
					                <input type="text" class="form-control" name="nom" placeholder="Nom" />
					                <input type="text" class="form-control" id="arb" placeholder="اسم العائلي" selectionDirection="rtl" lang="ar" name="nomAr" />
					            </div>
							</div>
						</div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="row">
								<div class="form-inline">
					                <label>Date Naissance : </label>
					                <input type="Date" class="form-control float-right" name="dateN" />
					            </div>
					            <div class="form-inline">
					            	<label>Lieu Naissance : </label>
					                <input type="text" class="form-control" placeholder="Lieu Naissance" name="lieuN" />
					            </div>
					            <div class="form-inline">
					            	<label>Pay Naissance : </label>
					            	<input type="text" class="form-control" name="payN" placeholder="Pay Naissance" />
					            </div>
					            <div class="form-inline">
					                <label>Sexe : </label>
					                <div class="radio-group"> 
					                    <input type="radio" value="Homme" name="sexe" class="" id="homme" /> <label for="homme"> Homme</label> 
					                    <input type="radio" value="Femme" name="sexe" id="femme"/> <label for="femme"> Femme</label>
					                </div>
					            </div>
					            <div class="form-inline">
					                <label>Date De recrutement : </label>
					                <input type="Date" class="form-control" name="dateR" />
					            </div>
					            <div class="form-inline">
					                <label>Imputation Budgétaire  : </label>
					                <select class="form-control" name="imputatB">
					                	<option value="Generale">Générale</option>
					                	<option value="Communale">Communale</option>
					                	<option value="Provinciale">Provinciale</option>
					                </select>
					            </div>
					            <div class="form-inline">
					                	<label>PPR</label>
					                	<input type="text" class="form-control" name="PPR" placeholder="PPR" />
					            </div>
					    </div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="row">
				            <div class="form-inline">
				            	<label>Etat matrimonial</label>
				                <select name="etatM" class="form-control" >
				                	<option value="Celibataire">Célibataire</option>
				                	<option value="Mariee">Marié(e)</option>
				                	<option value="Veuve">Veuve</option>
				                	<option value="Divorcee">Divorcée</option>
				                </select>
				            </div>
				            <div class="form-inline">
				                <input type="text" class="form-control" name="nPortable" placeholder="Num tel portable" />
				                <input type="text" class="form-control" placeholder="Num tel fixe" name="nFixe" />
				            </div>
				            <div class="form-inline">
				                <input type="text" class="form-control" name="adresse" placeholder="Adresse" />
				                <input type="email" class="form-control" placeholder="Email" name="email" />
				            </div>
				            <div class="form-inline">
				                <textarea rows="7" placeholder="observation" class="form-control" name="observation"></textarea>
				            </div>
				        </div>
					</div>
				</div>
	            <button class="btn btn-outlined btn-primary vrf" type="submit" name="ajouter">Ajouter</button>
	        </div>
        </form>
	</div>
 <?php }
	# End Add Fonctionaire page

# Begin update Fonctionaire page
elseif ($_GET['page']=='modifier') {
    # Begin cond Fonctionaire Id 
	if (isset($_REQUEST['IdEnt'])) :

		$IdEnt=filter_var($_REQUEST['IdEnt'],FILTER_SANITIZE_NUMBER_INT);
		# Begin checkIden
		if(!empty(checkIden('identite',$IdEnt)) ) {
		$result=checkIden('identite',$IdEnt);
		# Began update query
		if (isset($_POST['modifier'])):
            # Began photo upload
			if(!empty($_FILES['user_photo']['name'])){
		    $name=$_FILES['user_photo']['name'];
			$e = explode('.',$name);$exten = end($e);
			$AllowExt = ['png','jpg','jpeg','gif'];
			if (in_array($exten, $AllowExt)) {
			if(file_exists($result->Photo) && $result->Photo != "assets/img/avatar.png"){
			unlink($result->Photo);}
			$target="uploads/".rand().basename($name);
			$photo=$_FILES['user_photo']['tmp_name'];
			move_uploaded_file($photo,$target);}
			else{
				echo "<div class='alert alert-danger'>Ce fichier est <b>pas accepter</b></div>";
			}
			}
			# end photo upload
        if(!empty($_POST['CIN'])&&!empty($_POST['nom'])&&!
			empty($_POST['prenom'])&&!empty($_POST['nomAr'])&&
			!empty($_POST['prenomAr'])&&!empty($_POST['dateN'])&&
			!empty($_POST['payN'])&&!empty($_POST['lieuN'])&&
			!empty($_POST['etatM'])&&!empty($_POST['sexe'])&&
			!empty($_POST['dateR'])&&!empty($_POST['imputatB'])&&
			!empty($_POST['PPR'])&&!empty($_POST['nPortable'])&&
			!empty($_POST['nFixe'])&&!empty($_POST['email'])&&
			!empty($_POST['adresse'])&&!empty($_POST['observation'])){
		$CIN = $_POST['CIN'];
		$nom = $_POST['nom'];
		$nomAr = $_POST['nomAr'];
		$prenom = $_POST['prenom'];
		$prenomAr = $_POST['prenomAr'];
		$dateN = $_POST['dateN'];
		$payN = $_POST['payN'];
		$lieuN = $_POST['lieuN'];
		$etatM = $_POST['etatM'];
		$sexe = $_POST['sexe'];
		$dateR = $_POST['dateR'];
		$imputatB = $_POST['imputatB'];
		$PPR = $_POST['PPR'];
		$nPortable = $_POST['nPortable'];
		$nFixe = $_POST['nFixe'];
		$email = $_POST['email'];
		$adresse = $_POST['adresse'];
		$observation = $_POST['observation'];
		$identite = $_POST['identite'];
		$photo = isset($target)?$target:$result->Photo;
		$stm=$db->prepare("UPDATE `identite` SET  
			                CIN 			=:cin,
			                Nom 			=:nom, 
			                Prenom 			=:prenom,
			                Nom_ar 			=:nomAr,
			             	Prenom_ar 		=:prenomAr,
			             	DateNassance	=:dateN,
			             	LieuNaissance	=:lieuN,
			             	PayNaissance 	=:payN,
			             	Sexe 			=:sexe,
			             	EtatMatrimonial	=:etatM,
			             	DateRecrutement	=:dateR,
			             	ImputationBudg 	=:imputatB,
			             	PPR				=:PPR,
			             	nPort 			=:nPortable,
			             	nFix			=:nFixe,
			             	Email 			=:email,
			             	Adresse 		=:adresse,
			             	Photo 			=:photo,
			             	Observation 	=:observation 
			            WHERE identite.IdEnt = :identite");
		$stm->execute([
			'cin'		=> $CIN,
			'nom'		=> $nom,
			'prenom'	=> $prenom,
			'prenomAr'	=> $prenomAr,
			'nomAr'		=> $nomAr,
			'dateN'		=> $dateN,
			'lieuN'		=> $lieuN,
			'payN'		=> $payN,
			'sexe'		=> $sexe,
			'etatM'		=> $etatM,
			'dateR'		=> $dateR,
			'imputatB'	=> $imputatB,
			'PPR'		=> $PPR,
			'nPortable'	=> $nPortable,
			'nFixe'		=> $nFixe,
			'email'		=> $email,
			'adresse'	=> $adresse,
			'photo'		=> $photo,
		  'observation'	=> $observation,
		  'identite'	=> $identite]);
		echo "<div class='alert alert-success alert-dismissible'>
	    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Votre enregistrement est <b>bien modifier</b></div>";
			header("Refresh:1;url=".$_SERVER['HTTP_REFERER']);
		}
		else{
				echo "<div class='alert alert-danger alert-dismissible'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Tous les<b> Champs est obligatoire</b></div>";
			}
 	endif;# End update query
	?>
	<div class="header">
        <p>Modifier Fonctionnaire</p>
        <div class="line"></div>
    </div>
	<div class="container">
		<form method="POST" enctype="multipart/form-data">
			<div id="contactform">
	            <div class="form-inline">
	                <input type="text" class="form-control" name="CIN" placeholder="CIN" value="<?php if (isset($result->CIN)) echo $result->CIN?>" />
	                <button class="btn btn-default vrf" name="verifier" type="submit">verifier</button>
	                <p style="display: inline-block; font-weight: bold; margin-left: 12px"><?php 
	                	if (isset($_POST['verifier'])) {
	                        $cin= $_POST['CIN'];
	                		if ( !empty( checkTable('identite',null,$cin) ) ) {
                               	echo "Déja exists";
                               } else {
                                 echo "Pas exists";
                               }
                                
	                	}?>
	                </p>
	                <input type="hidden" name="identite" value="<?php if (isset($result->IdEnt)) echo $result->IdEnt?>">
	            </div>
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="row">
							<div class="col-md-6">
								<div class="form-photo">
						          <input type="file" class="file-input" name="user_photo" accept="image/*" onchange="uploadFl (event)" />
						          <div class="fonct-avatar" style="
						          <?php if (isset($result->Photo)): ?>
						          background: url('<?=$result->Photo?>');
						          background-size: cover;
		    					  background-position: center;
						          <?php endif ?>" id="output">
						           <p>Photo</p>
						         </div>
						        </div>
			                </div>
			                <div class="col-md-6">
			                	<div class="form-inline">
					                <input type="text" class="form-control" name="prenom" placeholder="Prénom" value="<?php if (isset($result->Prenom)) echo  $result->Prenom?>" />
					                <input type="text" class="form-control" id="arb" placeholder="اسم الشخصي" lang="ar" selectionDirection="rtl" name="prenomAr" value="<?php if (isset($result->Prenom_ar)) echo $result->Prenom_ar ?>" />
					            </div>
					            <div class="form-inline">
					                <input type="text" class="form-control" name="nom" placeholder="Nom" value="<?php if (isset($result->Nom)) echo $result->Nom?>" />
					                <input type="text" class="form-control" id="arb" placeholder="اسم العائلي" selectionDirection="rtl" lang="ar" name="nomAr" value="<?php if (isset($result->Nom_ar)) echo  $result->Nom_ar?>" />
					            </div>
			                </div>
			            </div>
			        </div>
			    </div>	
			    <div class="panel panel-default">
					<div class="panel-body">
						<div class="row">            
				            <div class="form-inline">
				                <label>Date Naissance : </label>
				                <input type="Date" class="form-control float-right" name="dateN" value="<?php if (isset($result->DateNassance)) echo  $result->DateNassance?>" />
				            </div>
				            <div class="form-inline">
				                <input type="text" class="form-control" name="payN" placeholder="Pays Naissance" value="<?php if (isset($result->PayNaissance)) echo  $result->PayNaissance?>" />
				                <input type="text" class="form-control" placeholder="Lieu Naissance" name="lieuN" value="<?php if (isset($result->LieuNaissance)) echo $result->LieuNaissance ?>" />
				            </div>
				            <div class="form-inline">
				                <label>Sexe : </label>
				                <div class="radio-group"> 
				                    <input type="radio" value="Homme" name="sexe" class="" id="homme" <?php if (isset($result->Sexe)&&($result->Sexe=='Homme')) echo 'checked'?> /> <label for="homme"> Homme</label> 
				                    <input type="radio" value="Femme" name="sexe" id="femme" <?php if (isset($result->Sexe)&&($result->Sexe=='Femme')) echo 'checked'?>/> <label for="femme"> Femme</label>
				                </div>
				            </div>
				            <div class="form-inline">
				                <label>Date De recrutement : </label>
				                <input type="Date" class="form-control" name="dateR" value="<?php if (isset($result->DateRecrutement )) echo $result->DateRecrutement  ?>" />
				            </div>
				            <div class="form-inline">
				                <label>Imputation Budgétaire  : </label>
				                <select class="form-control" name="imputatB">
				                	<option value="Generale" <?php if ($result->ImputationBudg=='Generale') echo 'selected'?>>Générale</option>
				                	<option value="Communale" <?php if ($result->ImputationBudg=='Communale') echo 'selected'?>>Communale</option>
				                	<option value="Provinciale" <?php if ($result->ImputationBudg=='Provinciale') echo 'selected'?>>Provinciale</option>
				                </select>
				            </div>
				        </div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="row">
							<div class="form-inline">
				            	<label>Etat matrimonial</label>
				                <select name="etatM" class="form-control" >
				                	<option value="Celibataire" <?php if ($result->EtatMatrimonial=='Celibataire') echo 'selected'?>>Célibataire</option>
				                	<option value="Mariee" <?php if ($result->EtatMatrimonial=='Mariee') echo 'selected'?>>Marié(e)</option>
				                	<option value="Veuve" <?php if ($result->EtatMatrimonial=='Veuve') echo 'selected'?>>Veuve</option>
				                	<option value="Divorcee" <?php if ($result->EtatMatrimonial=='Divorcee') echo 'selected'?>>Divorcée</option>
				                </select>
				            </div>
				            <div class="form-inline">
					            <label>PPR</label>
					            <input type="text" class="form-control" name="PPR" placeholder="PPR" value="<?php if (isset($result->PPR)) echo $result->PPR?>" />
					        </div>
				            <div class="form-inline">
				                <input type="text" class="form-control" name="nPortable" placeholder="Num tel portable" value="<?php if (isset($result->NPort)) echo $result->NPort?>" />
				                <input type="text" class="form-control" placeholder="Num tel fixe" name="nFixe" value="<?php if (isset($result->NFix)) echo $result->NFix?>" />
				            </div>
				            <div class="form-inline">
				                <input type="text" class="form-control" name="adresse" placeholder="Adresse" value="<?php if (isset($result->Adresse)) echo $result->Adresse?>" />
				                <input type="email" class="form-control" placeholder="Email" name="email" value="<?php if (isset($result->Email)) echo $result->Email?>" />
				            </div>
				            <div class="form-inline">
				                <textarea rows="7" placeholder="observation" class="form-control" name="observation"><?php if (isset($result->Observation)) echo $result->Observation?></textarea>
				            </div>
				        </div>
					</div>
				</div>
	            <button class="btn btn-outlined btn-primary vrf" type="submit" name="modifier">Modifier</button>
	        </div>
        </form>
	</div>
 <?php
    }# End checkIden
 endif; # End cond Fonctionaire Id
}# End edit Fonctionaire page

# Begin Manage Fonctionaire page
elseif ($_GET['page']=='manage'){
	$stm=$db->prepare("SELECT * FROM identite");
	$stm->execute();
	if($_SERVER['REQUEST_METHOD']=='POST'){
		$st=isset($_POST['stuat']) ? $_POST['stuat'] : '%';
		$em=$_POST['etatM']!='0' ? $_POST['etatM'] : '%';
		$ib=$_POST['imputatB']!='0' ? $_POST['imputatB'] : '%';
		$stm=$db->prepare("SELECT * FROM identite WHERE Sexe LIKE ? AND EtatMatrimonial LIKE ? AND 	ImputationBudg LIKE ?");
			$stm->execute([$st,$em,$ib]);
		
	}
	?>
	<div class="header">
        <p><span class="fa fa-angle-right"></span> Gérer Dossier social des Fonctionnaires</p>
    </div>
	<div class="container">
		<a class="btn btn-outlined btn-default" href="?page=manage">Actualiser</a>
		<form class="filtrer-form" method="POST">
			<div class="filter-form">
				<div class="form-inline">
					<select name="etatM" class="form-control" >
						<option value="0">Selectionnez Etat---</option>
						<option value="Celibataire">Célibataire</option>
	                	<option value="Mariee">Marié(e)</option>
	                	<option value="Veuve">Veuve</option>
	                	<option value="Divorcee">Divorcée</option>
	                </select>
	                <select class="form-control" name="imputatB">
	                	<option value="0">Selectionnez Budgétaire---</option>
	                	<option value="Generale">Générale</option>
	                	<option value="Communale">Communale</option>
	                	<option value="Provinciale">Provinciale</option>
	                </select> <b> | </b> 
					<input type="radio" name="stuat" id="stuat1" value="Femme"> <label for="stuat1"> femme </label> 
					<input type="radio" name="stuat" id="stuat2" value="Homme"> <label for="stuat2">homme	</label> 
					<button class="btn btn-outlined btn-default" type="submit">filtrer <span class="fa fa-filter"></span></button>
			    </div>
			</div>
		</form>
		<?php if($stm->rowCount()<1){
		echo "<div class='message-item'>
        <p><b>Pas </b>de Résultat !</p>
              </div>";
		}else{ ?>
		<table class="table table-bordered text-center">
			<tr class="text-center">
				<th>CIN</th>
				<th>Nom et Prenom</th>
				<th>Détails</th>
				<th>Curriculum Vitae</th>
				<th>Situation Familiale</th>
				<th>Docs Social</th>
				<th>Mise à jour</th>
			</tr>
			<?php while($result=$stm->fetch()): ?>
			<tr>
				<td><?=$result->CIN?></td>
				<td><?=$result->Nom?> <?=$result->Prenom?></td>
				<td><a href="fonctionaire?page=detail&cin=<?=$result->CIN?>"><span class="fas fa-plus-circle"></span></a></td>
				<td><a href="cv?page=detail&IdEnt=<?=$result->IdEnt?>"><span class="fas fa-file-alt"></span></a></td>
				<td><a href="st?IdEnt=<?=$result->IdEnt?>"><i class="fas fa-baby-carriage"></i></a> </td>
				<td><a href="social?IdEnt=<?=$result->IdEnt?>"><span class="fas fa-folder-open"></span></a></td>
				<td>
					<a href="?page=manage&action=delete&IdEnt=<?=$result->IdEnt?>" class="btn btn-outlined btn-danger"> sup </a>
					<a href="?page=modifier&IdEnt=<?=$result->IdEnt?>"  class="btn btn-outlined btn-primary"> Mod</a>
				</td>
			</tr>
		<?php endwhile; ?>
		</table>
		<?php } ?>
	</div>
<?php
	  }
# End Manage Fonctionaire page

# if no page selection on url redirect to accueil page
else{header('Location:accueil.php'); exit();}
	  
# Begin Delete Fonctionaire page
	 if (isset($_GET['action'])) {
	  	if ($_GET['action']=='delete'):
		 	if (isset($_GET['cin'])){
		 	$cin=filter_var($_REQUEST['cin'],FILTER_SANITIZE_STRING);
		$result=checkTable('identite','CIN',$cin);
		if(file_exists($result->Photo) && $result->Photo != "assets/img/avatar.png"){
		unlink($result->Photo);}
		$stm=$db->prepare("DELETE FROM identite WHERE CIN=?");
		$stm->execute([$cin]);
			echo "<div class='alert alert-warning'>
			En attent...
		</div>";
			header("Refresh:1;url=".$_SERVER['HTTP_REFERER']);
			}
	  endif;
# End Delete Fonctionaire page
	}

	?>

<?php } else{header('Location:accueil.php'); exit();} 
include 'layout/footer.php'; ?>