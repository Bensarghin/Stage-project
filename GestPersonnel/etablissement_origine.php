<?php include 'layout/header.php'; ?>
<?php if (isset($_GET['page'])) {
    
    # Begin of details affectation page
	if ($_GET['page']=='details'){

		if (isset($_REQUEST['IdEnt'])) :
		$IdEnt=filter_var($_REQUEST['IdEnt'],FILTER_SANITIZE_NUMBER_INT);
		if( !empty(checkIden('etablissement_origine',$IdEnt)) ) {
		$result = checkIden('etablissement_origine',$IdEnt);
		$fk = checkIden('identite',$IdEnt);?>
	<div class="container">
		<div class="header">
	        <p><span class="fa fa-angle-right"></span> Etablissement d'origine</p>
	    </div>
		<div class="container">
			<div id="row">
				<div class="col-md-3">
					<div class="panel panel-default">
						<div class="panel-body">
			                <div class="row">
			                	<div style="<?php if (isset($fk->Photo)): ?>background: url('<?=$fk->Photo?>');background-size: cover;background-position: center;height: 190px;width: 100%
						          <?php endif ?>" id="output">
						         </div>
					        </div>
					        <div class="panel-footer text-center"><a href="fonctionaire?page=detail&cin=<?=$fk->CIN?>"><?=$fk->Nom?> - <?=$fk->Prenom?></a></div>
						</div>
					</div>
				</div>
				<div class="col-md-9">
					<div class="panel panel-default">
						<div class="panel panel-heading">
							<h4><?=$fk->CIN?></h4>
						</div>
						<div class="panel-body">
			                <div class="row">
			                	<div class="col-sm-6">
			                		<i class="fas fa-suitcase"></i> Intitule :
			                	</div>
			                	<div class="col-sm-6">
			                		<?=$result->intitule?>
			                	</div>
					        </div>
					        <div class="row">
			                	<div class="col-sm-6">
			                		<i class="fas fa-sitemap"></i> Poste :
			                	</div>
			                	<div class="col-sm-6">
			                		<?=$result->poste?>
			                	</div>
					        </div>
					        <div class="row">
			                	<div class="col-sm-6">
			                		<i class="fas fa-user-tie"></i> Spécialité :
			                	</div>
			                	<div class="col-sm-6"><?=$result->specialite?>
			                	</div>
					        </div>
					        <div class="row">
			                	<div class="col-sm-6">
			                		<i class="fas fa-handshake"></i> Date Debut :
			                	</div>
			                	<div class="col-sm-6">
			                		<?=$result->dateDebut?>
			                	</div>
					        </div>
					        <div class="row">
			                	<div class="col-sm-6">
			                		<i class="fas fa-hourglass-end"></i> Date Fin :
			                	</div>
			                	<div class="col-sm-6"> <?=$result->dateFin?></div>
					        </div>
					        <div class="row">
			                	<div class="col-sm-6">
			                		<a href="?page=modifier&idEt=<?=$result->idEt?>" class="btn btn-primary">modifier</a> 
			                		<a href="?page=details&IdEnt=<?=$result->IdEnt?>&action=delete&idEt=<?=$result->idEt?>" class="btn btn-danger">supprimer</a>
			                	</div>
					        </div>
						</div>
					</div>
					<div class="panel panel-default">
						<div class="panel panel-heading">
							<h4><i class="fas fa-paperclip"></i> Description</h4>
						</div>
						<div class="panel panel-body">
							<div class="row">
								<textarea placeholder="Description" class="form-control" rows="7" name="description" style="resize: none;"><?php echo $result->description?></textarea>
							</div>
						</div>
					</div>
				</div>
	        </div>
		</div>
	</div>
	<?php 
	    
	}
	else{
		echo"<div class='message-item'>
        <p><b>Pas </b>de Résultat ! <a href='affectation?page=ajouter&IdEnt=$IdEnt'><span class='fa fa-angle-double-right'></span> Ajouter Etablissement d'origine</a></p>
              </div>";
	}
 endif;

    }#end of details affectation page

	# Begin add bank data page
	elseif ($_GET['page']=='ajouter'){

		if (isset($_REQUEST['IdEnt'])) :
		$IdEnt=filter_var($_REQUEST['IdEnt'],FILTER_SANITIZE_NUMBER_INT);
		if( !empty(checkIden('identite',$IdEnt)) ) {
			$fk=checkIden('identite',$IdEnt);
			# begin query insert 
	    if (isset($_POST['ajouter'])):
	    if(!empty($_POST['intitule'])&&!empty($_POST['specialite'])&&!
			empty($_POST['dateDebut'])&&!empty($_POST['dateFin'])&&
			!empty($_POST['lieu'])&&!empty($_POST['pay'])&&
			!empty($_POST['description'])&&
			!empty($_POST['poste'])) {
		$intitule = $_POST['intitule'];
		$poste = $_POST['poste'];
		$specialite = $_POST['specialite'];
		$dateDebut = $_POST['dateDebut'];
		$dateFin = $_POST['dateFin'];
		$lieu = $_POST['lieu'];
		$pay = $_POST['pay'];
		$description = $_POST['description'];
		$stm=$db->prepare("INSERT INTO `etablissement_origine` 
								(`intitule`, `poste`, `specialite`, 
								`dateDebut`, `dateFin`, `lieu`, 
								`pay`, `description`, `IdEnt`) 
						VALUES 
								(:intitule, :poste, :specialite,
								:dateDebut, :dateFin, :lieu, 
								:pay, :description, :IdEnt)");
		$stm->execute([
			'intitule'		=> $intitule,
			'poste'	    	=> $poste,
			'specialite'	=> $specialite,
			'dateDebut'		=> $dateDebut,
			'dateFin'		=> $dateFin,
			'lieu'			=> $lieu,
			'pay'			=> $pay,
			'description'	=> $description,
			'IdEnt'			=> $IdEnt]);
		echo "<div class='alert alert-success alert-dismissible'>
	    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				Votre enregistrement est <b>bien ajouter</b>
			</div>";
		}
		else{
			echo "<div class='alert alert-danger alert-dismissible'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Tous les<b> Champs est obligatoire</b></div>";
		}
 	endif;
		# End Query insert 
			?>
	<div class="container">
		<div class="header">
	        <p><span class="fa fa-angle-right"></span> Ajouter établissement d'origine</p>
	    </div>
		<div class="container">
			<form method="POST">
			<div id="contactform">	
				<div class="panel panel-default">
					<div class="panel-body">
		                <div class="row">
		                	<div class="form-inline">
								<label>Fonctionnaire concerné :</label>
				                <input type="text" class="form-control" name="fnt" placeholder="Prénom" value="<?php echo $fk->CIN?>" readonly/>
				            </div>
							<div class="form-inline">
		                	<label>intitule : </label>
				                <input type="text" class="form-control" name="intitule" placeholder="intitule" value="" />
				            </div>
				            <div class="form-inline">
		                	<label>poste : </label>
				                <input type="text" class="form-control" name="poste" placeholder="Poste" value="" />
				            </div>
							<div class="form-inline">
		                	<label>Spécialité : </label>
				                <input type="text" class="form-control" name="specialite" placeholder="Spécialité" value="" />
				            </div>
				            <div class="form-inline">
				            	<label>Date Debut : </label>
				                <input type="date" class="form-control" name="dateDebut" placeholder="Date Debut" value="" />
				            </div>
				            <div class="form-inline">
				            	<label>Date Fin : </label>
				                <input type="date" class="form-control" name="dateFin" placeholder="Date Fin" value="" />
				            </div>
				            <div class="form-inline">
				            	<label>Lieu : </label>
				                <input type="text" class="form-control" name="lieu" placeholder="Lieu" />
				            </div>
				            <div class="form-inline">
				            	<label>Pay : </label>
				                <input type="text" class="form-control" name="pay" placeholder="pay"/>
				            </div>
				            <div class="form-inline">
				            	<textarea placeholder="Description" class="form-control" rows="7" name="description"></textarea>
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

    }#end of add bank data page

    # Begin update bank data page
	elseif ($_GET['page']=='modifier'){

		if (isset($_REQUEST['idEt'])) :
		$idEt=filter_var($_REQUEST['idEt'],FILTER_SANITIZE_NUMBER_INT);

		if( !empty(checkTable('etablissement_origine','idEt',$idEt)) ) {
			$result=checkTable('etablissement_origine','idEt',$idEt);
			$fk=checkIden('identite',$result->IdEnt);
			# begin query insert 
	if (isset($_POST['modifier'])):
		$intitule = $_POST['intitule'];
		$poste = $_POST['poste'];
		$specialite = $_POST['specialite'];
		$dateDebut = $_POST['dateDebut'];
		$dateFin = $_POST['dateFin'];
		$lieu = $_POST['lieu'];
		$pay = $_POST['pay'];
		$description = $_POST['description'];
		$stm=$db->prepare("UPDATE `etablissement_origine` SET `intitule`=:intitule,`poste`= :poste,`specialite`=:specialite,`dateDebut`= :dateDebut,`dateFin`= :dateFin,`lieu`= :lieu,`pay`= :pay,`description`= :description WHERE idEt=:idEt");
		$stm->execute([
			'intitule'		=> $intitule,
			'poste'	    	=> $poste,
			'specialite'	=> $specialite,
			'dateDebut'		=> $dateDebut,
			'dateFin'		=> $dateFin,
			'lieu'			=> $lieu,
			'pay'			=> $pay,
			'description'	=> $description,
			'idEt'			=> $idEt]);
		echo "<div class='alert alert-success alert-dismissible'>
	    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				Votre enregistrement est <b>bien modifier</b>
			</div>";
			header("Refresh:1;url=".$_SERVER['HTTP_REFERER']);
 	endif;
		# End Query update 
			?>
	<div class="container">
		<div class="header">
	        <p><span class="fa fa-angle-right"></span> modifier établissement D'origine</p>
	    </div>
		<div class="container">
			<form method="POST">
			<div id="contactform">	
				<div class="panel panel-default">
					<div class="panel-body">
		                <div class="row">
							<div class="form-inline">
								<label>Fonctionnaire concerné :</label>
				                <input type="text" class="form-control" name="fnt" placeholder="Prénom" value="<?php echo $fk->CIN?>" readonly/>
				            </div>
							<div class="form-inline">
		                	<label>intitule : </label>
				                <input type="text" class="form-control" name="intitule" placeholder="intitule" value="<?php echo $result->intitule?>" />
				            </div>
				            <div class="form-inline">
		                	<label>poste : </label>
				                <input type="text" class="form-control" name="poste" placeholder="Poste" value="<?php echo $result->poste?>" />
				            </div>
							<div class="form-inline">
		                	<label>Spécialité : </label>
				                <input type="text" class="form-control" name="specialite" placeholder="Spécialité" value="<?php echo $result->specialite?>" />
				            </div>
				            <div class="form-inline">
				            	<label>Date Debut : </label>
				                <input type="date" class="form-control" name="dateDebut" placeholder="Date Debut" value="<?php echo $result->dateDebut?>" />
				            </div>
				            <div class="form-inline">
				            	<label>Date Fin : </label>
				                <input type="date" class="form-control" name="dateFin" placeholder="Date Fin" value="<?php echo $result->dateFin?>" />
				            </div>
				            <div class="form-inline">
				            	<label>Lieu : </label>
				                <input type="text" class="form-control" name="lieu" placeholder="Lieu" value="<?php echo $result->lieu?>" />
				            </div>
				            <div class="form-inline">
				            	<label>Pay : </label>
				                <input type="text" class="form-control" name="pay" placeholder="pay" value="<?php echo $result->pay?>" />
				            </div>
				            <div class="form-inline">
				            	<textarea placeholder="Description" class="form-control" rows="7" name="description"><?php echo $result->description?></textarea>
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
 }#end of modifier affectation page

 # Begin Delete affectation page
    if (isset($_GET['action'])) {
        if ($_GET['action']=='delete'):
            if (isset($_GET['idA'])){
            $idA=filter_var($_GET['idA'],FILTER_SANITIZE_NUMBER_INT) ;
            $stm=$db->prepare("DELETE FROM `affectation` WHERE idA=?");
            $stm->execute([$idA]);
            echo "<div class='alert alert-warning'>
            En attent sup...
        </div>";
            header("Refresh:1;url=".$_SERVER['HTTP_REFERER']);
        }
        endif;
    }# End Delete affectation page
} else{header('Location:accueil.php'); exit(); }include 'layout/footer.php'; ?>