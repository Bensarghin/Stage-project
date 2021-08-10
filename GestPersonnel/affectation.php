<?php include 'layout/header.php'; ?>
<?php if (isset($_GET['page'])) {
    
    # Begin of details affectation page
	if ($_GET['page']=='details'){

		if (isset($_REQUEST['IdEnt'])) :
		$IdEnt=filter_var($_REQUEST['IdEnt'],FILTER_SANITIZE_NUMBER_INT);
		if( !empty(checkIden('affectation',$IdEnt)) ) {
		$result = checkIden('affectation',$IdEnt);
		$fk = checkIden('identite',$IdEnt);?>
	<div class="container">
		<div class="header">
	        <p><span class="fa fa-angle-right"></span> Affectation</p>
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
			                		<i class="fas fa-suitcase"></i> Affectation :
			                	</div>
			                	<div class="col-sm-6">
			                		<?=$result->affectation?>
			                	</div>
					        </div>
					        <div class="row">
			                	<div class="col-sm-6">
			                		<i class="fas fa-sitemap"></i> Division :
			                	</div>
			                	<div class="col-sm-6">
			                		<?=$result->division?>
			                	</div>
					        </div>
					        <div class="row">
			                	<div class="col-sm-6">
			                		<i class="fas fa-user-tie"></i> Poste occupé :
			                	</div>
			                	<div class="col-sm-6"><?=$result->posteOccupe?>
			                	</div>
					        </div>
					        <div class="row">
			                	<div class="col-sm-6">
			                		<i class="fas fa-handshake"></i> Date de prise service :
			                	</div>
			                	<div class="col-sm-6">
			                		<?=$result->DatePriseServ?>
			                	</div>
					        </div>
					        <div class="row">
			                	<div class="col-sm-6">
			                		<i class="fas fa-hourglass-end"></i> Date de cessation service :
			                	</div>
			                	<div class="col-sm-6"> <?=$result->DateCessServ?></div>
					        </div>
					        <div class="row">
			                	<div class="col-sm-6">
			                		<a href="?page=modifier&idA=<?=$result->idA?>" class="btn btn-primary">modifier</a> 
			                		<a href="?page=details&IdEnt=<?=$result->IdEnt?>&action=delete&idA=<?=$result->idA?>" class="btn btn-danger">supprimer</a>
			                	</div>
					        </div>
						</div>
					</div>
					<div class="panel panel-default">
						<div class="panel panel-heading">
							<h4><i class="fas fa-paperclip"></i> Observation</h4>
						</div>
						<div class="panel panel-body">
							<div class="row">
								<textarea placeholder="observation" class="form-control" rows="7" name="observation" style="resize: none;"><?php if (isset($result->observation)) echo $result->observation?></textarea>
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
        <p><b>Pas </b>de Résultat ! <a href='affectation?page=ajouter&IdEnt=$IdEnt'><span class='fa fa-angle-double-right'></span> Ajouter Affectation</a></p>
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
		$affectation = $_POST['affectation'];
		$division = $_POST['division'];
		$posteOccupe = $_POST['posteOccupe'];
		$DatePriseServ = $_POST['DatePriseServ'];
		$DateCessServ = $_POST['DateCessServ'];
		$observation = $_POST['observation'];
		$stm=$db->prepare("INSERT INTO `affectation`(`affectation`, `division`, `posteOccupe`, `DatePriseServ`, `DateCessServ`, `observation`, `IdEnt`) VALUES (:affectation,:division,:posteOccupe,:DatePriseServ,:DateCessServ,:observation,:IdEnt)");
		$stm->execute([
			'affectation'	=> $affectation,
			'division'	    => $division,
			'posteOccupe'	=> $posteOccupe,
			'DatePriseServ'	=> $DatePriseServ,
			'DateCessServ'	=> $DateCessServ,
			'observation'	=> $observation,
			'IdEnt'		    => $IdEnt]);
		echo "<div class='alert alert-success alert-dismissible'>
	    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				Votre enregistrement est <b>bien ajouter</b>
			</div>";
 	endif;
		# End Query insert 
			?>
	<div class="container">
		<div class="header">
	        <p><span class="fa fa-angle-right"></span> Ajouter Affectation</p>
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
		                	<label>Affectation : </label>
				                <input type="text" class="form-control" name="affectation" placeholder="Affectation" value="" />
				            </div>
				            <div class="form-inline">
		                	<label>Division : </label>
				                <input type="text" class="form-control" name="division" placeholder="Affectation" value="" />
				            </div>
							<div class="form-inline">
		                	<label>Poste occupé : </label>
				                <input type="text" class="form-control" name="posteOccupe" placeholder="Poste occupé" value="" />
				            </div>
				            <div class="form-inline">
				            	<label>Date de prise de service : </label>
				                <input type="date" class="form-control" name="DatePriseServ" placeholder="Date de prise de service " value="" />
				            </div>
				            <div class="form-inline">
				            	<label>Date de cessation de service : </label>
				                <input type="date" class="form-control" name="DateCessServ" placeholder="Date de cessation de service" value="" />
				            </div>
				            <div class="form-inline">
				            	<textarea placeholder="observation" class="form-control" rows="7" name="observation"></textarea>
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

		if (isset($_REQUEST['idA'])) :
		$idA=$_REQUEST['idA'];

		if( !empty(checkTable('affectation','idA',$idA)) ) {
			$result=checkTable('affectation','idA',$idA);
			$fk=checkIden('identite',$result->IdEnt);
			# begin query insert 
	if (isset($_POST['modifier'])):
		$affectation = $_POST['affectation'];
		$division = $_POST['division'];
		$posteOccupe = $_POST['posteOccupe'];
		$DatePriseServ = $_POST['DatePriseServ'];
		$DateCessServ = $_POST['DateCessServ'];
		$observation = $_POST['observation'];
		$stm=$db->prepare("UPDATE `affectation` SET `affectation`=:affectation,`division`=:division,`posteOccupe`=:posteOccupe,`DatePriseServ`=:DatePriseServ,`DateCessServ`=:DateCessServ,`observation`=:observation WHERE idA=:idA");
		$stm->execute([
			'affectation'	=> $affectation,
			'division'	    => $division,
			'posteOccupe'	=> $posteOccupe,
			'DatePriseServ'	=> $DatePriseServ,
			'DateCessServ'	=> $DateCessServ,
			'observation'	=> $observation,
			'idA'		=> $idA]);
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
	        <p><span class="fa fa-angle-right"></span> modifier affectation</p>
	    </div>
		<div class="container">
			<form method="POST">
			<div id="contactform">	
				<div class="panel panel-default">
					<div class="panel-body">
		                <div class="row">
							<div class="form-inline">
								<label>Fonctionnaire concerné : </label>
				                <input type="text" class="form-control" name="fnt" placeholder="Prénom" value="<?php echo $fk->CIN?>" readonly/>
				            </div>            
							<div class="form-inline">
								<label>affectation : </label>
				                <input type="text" class="form-control" name="affectation" placeholder="Affectation" value="<?php if (isset($result->affectation)) echo $result->affectation?>" />
				            </div>
				            <div class="form-inline">
				            	<label>Division : </label>
				                <input type="text" class="form-control" name="division" placeholder="Division" value="<?php if (isset($result->division)) echo $result->division?>" />
				            </div>
				            <div class="form-inline">
				                <label>Poste Occupé : </label>
				                <input type="text" class="form-control" name="posteOccupe"  value="<?php if (isset($result->posteOccupe)) echo $result->posteOccupe?>" />
				            </div>
				            <div class="form-inline">
				                <label>Date de Prise Service : </label>
				                <input type="date" class="form-control" name="DatePriseServ"  value="<?php if (isset($result->DatePriseServ)) echo $result->DatePriseServ?>" />
				            </div>
				            <div class="form-inline">
				                <label>Date de Cessation Service : </label>
				                <input type="date" class="form-control" name="DateCessServ"  value="<?php if (isset($result->DateCessServ)) echo $result->DateCessServ?>" />
				            </div>
				            <div class="form-inline">
				            	<textarea placeholder="observation" class="form-control" rows="7" name="observation"><?php if (isset($result->observation)) echo $result->observation?></textarea>
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