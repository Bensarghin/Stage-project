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
		$typeR = $_POST['typeR'];
		$NumAffiliation = $_POST['NumAffiliation'];
		$DateAffiliation = $_POST['DateAffiliation'];
		$stm=$db->prepare("INSERT INTO `regimeretraite`(`type`, `numAffel`, `dateAffel`, `IdEnt`) VALUES (:typeR, :num, :dateAf, :IdEnt)");
		$stm->execute([
			'typeR'	    => $typeR,
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
	        <p><span class="fa fa-angle-right"></span> Ajouter régime retraite</p>
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
		                	<label>Type Régime retraite :</label>
				                <input type="text" class="form-control" name="typeR" placeholder="Type Régime retraite " value="" />
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

		if (isset($_REQUEST['idR'])) :
		$idR=$_REQUEST['idR'];

		if( !empty(checkTable('regimeretraite','idR',$idR)) ) {
			$result=checkTable('regimeretraite','idR',$idR);
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
	        <p><span class="fa fa-angle-right"></span> modifier régime retraite</p>
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
								<label>Type régime retraite : </label>
				                <input type="text" class="form-control" name="typeMut" value="<?php if (isset($result->type)) echo $result->type?>" />
				            </div>
				            <div class="form-inline">
				                <label>Num Affiliation : </label>
				            </div>
				            <div class="form-inline">
				                <label>Date Affiliation : </label>
				                <input type="text" class="form-control" name="DateAffiliation"  value="<?php if (isset($result->dateAffel)) echo $result->dateAffel?>" />
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