<?php include 'layout/header.php'; ?>
<?php if (isset($_GET['page'])) {

	# Begin add bank data page
	if ($_GET['page']=='ajouter'){

		if (isset($_REQUEST['IdEnt'])) :
		$IdEnt=filter_var($_REQUEST['IdEnt'],FILTER_SANITIZE_NUMBER_INT);
		if( !empty(checkIden('identite',$IdEnt)) ) {
			$fk=checkIden('identite',$IdEnt);
			# begin query insert 
	    if (isset($_POST['ajouter'])):
		$typeMut = $_POST['typeMut'];
		$Matricule = $_POST['Matricule'];
		$NumAffiliation = $_POST['NumAffiliation'];
		$DateAffiliation = $_POST['DateAffiliation'];
		$stm=$db->prepare("INSERT INTO `mutuelle`(`typeMut`, `Matricule`, `NumAffiliation`, `DateAffiliation`, `IdEnt`) VALUES (:typeMut, :mat, :num, :dateAf, :IdEnt)");
		$stm->execute([
			'typeMut'	=> $typeMut,
			'mat'	    => $Matricule,
			'num'		=> $NumAffiliation,
			'dateAf'	=> $DateAffiliation,
			'IdEnt'		=> $IdEnt]);
		echo "<div class='alert alert-success alert-dismissible'>
	    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				Votre enregistrement est <b>bien ajouter</b>
			</div>";
 	endif;
		# End Query insert 
			?>
	<div class="container">
		<div class="header">
	        <p><span class="fa fa-angle-right"></span> Ajouter Mutuelle</p>
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
		                	<label>type Mutuelle</label>
				                <input type="text" class="form-control" name="typeMut" placeholder="Type Mutuelle" value="" />
				            </div>
							<div class="form-inline">
		                	<label>Matricule</label>
				                <input type="text" class="form-control" name="Matricule" placeholder="Matricule" value="" />
				            </div>
				            <div class="form-inline">
				            	<label>Num Affiliation</label>
				                <input type="text" class="form-control" name="NumAffiliation" placeholder="Num Affiliation" value="" />
				            </div>
				            <div class="form-inline">
				            	<label>Date Affiliation</label>
				                <input type="date" class="form-control" name="DateAffiliation" placeholder="Date Affiliation" value="" />
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
	if ($_GET['page']=='modifier'){

		if (isset($_REQUEST['idM'])) :
		$idM=$_REQUEST['idM'];

		if( !empty(checkTable('mutuelle','idM',$idM)) ) {
			$result=checkTable('mutuelle','idM',$idM);
			$fk=checkIden('identite',$result->IdEnt);
			# begin query insert 
	if (isset($_POST['modifier'])):
		$typeMut = $_POST['typeMut'];
		$Matricule = $_POST['Matricule'];
		$NumAffiliation = $_POST['NumAffiliation'];
		$DateAffiliation = $_POST['DateAffiliation'];
		$stm=$db->prepare("UPDATE `mutuelle` SET `typeMut`=:typeMut, `Matricule`=:mat, `NumAffiliation`=:num, `DateAffiliation`=:dateAf WHERE idM=:idM");
		$stm->execute([
			'typeMut'	=> $typeMut,
			'mat'	    => $Matricule,
			'num'		=> $NumAffiliation,
			'dateAf'	=> $DateAffiliation,
			'idM'		=> $idM]);
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
	        <p><span class="fa fa-angle-right"></span> modifier Mutuelle</p>
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
								<label>Type Mutuelle : </label>
				                <input type="text" class="form-control" name="typeMut" placeholder="Type Mutuelle" value="<?php if (isset($result->typeMut)) echo $result->typeMut?>" />
				            </div>
				            <div class="form-inline">
				            	<label>Matricule : </label>
				                <input type="text" class="form-control" name="Matricule" placeholder="Matricule" value="<?php if (isset($result->Matricule)) echo $result->Matricule?>" />
				            </div>
				            <div class="form-inline">
				                <label>Num Affiliation : </label>
				                <input type="text" class="form-control" name="NumAffiliation"  value="<?php if (isset($result->NumAffiliation)) echo $result->NumAffiliation?>" />
				            </div>
				            <div class="form-inline">
				                <label>Date Affiliation : </label>
				                <input type="text" class="form-control" name="DateAffiliation"  value="<?php if (isset($result->DateAffiliation)) echo $result->DateAffiliation?>" />
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