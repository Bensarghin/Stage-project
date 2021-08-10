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
		$banque = $_POST['banque'];
		$agence = $_POST['agence'];
		$ville = $_POST['ville'];
		$stm=$db->prepare("INSERT INTO `coordbanc`(`banque`, `agence`, `ville`, `IdEnt`) VALUES (:banque,:agence,:ville,:IdEnt)"
			              );
		$stm->execute([
			'banque'	=> $banque,
			'agence'	=> $agence,
			'ville'		=> $ville,
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
	        <p><span class="fa fa-angle-right"></span> Ajouter Coordonnées bancaire</p>
	    </div>
		<div class="container">
			<form method="POST">
			<div id="contactform">	
				<div class="panel panel-default">
					<div class="panel-body">
		                <div class="row">
		                	<div class="form-inline">
								<label>Fonctionnaire concerné</label>
				                <input type="text" class="form-control" name="fnt" placeholder="Prénom" value="<?php echo $fk->CIN?>" readonly/>
				            </div>
							<div class="form-inline">
		                	<label>Banque</label>
				                <input type="text" class="form-control" name="banque" placeholder="Banque" value="" />
				            </div>
				            <div class="form-inline">
				            	<label>Agence</label>
				                <input type="text" class="form-control" name="agence" placeholder="Agence" value="" />
				            </div>
				            <div class="form-inline">
				            	<label>Ville</label>
				                <input type="text" class="form-control" name="ville" placeholder="Ville" value="" />
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

		if (isset($_REQUEST['idC'])) :
		$idC=$_REQUEST['idC'];

		if( !empty(checkTable('coordbanc','idC',$idC)) ) {
			$result=checkTable('coordbanc','idC',$idC);
			$fk=checkIden('identite',$result->IdEnt);
			# begin query insert 
	if (isset($_POST['modifier'])):
		$banque = $_POST['banque'];
		$agence = $_POST['agence'];
		$ville = $_POST['ville'];
		$stm=$db->prepare("UPDATE `coordbanc` SET `banque`=:banque,`agence`=:agence,`ville`=:ville WHERE `idC`=:idC");
		$stm->execute([
			'banque'	=> $banque,
			'agence'	=> $agence,
			'ville'		=> $ville,
			'idC'		=> $idC]);
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
	        <p><span class="fa fa-angle-right"></span> modifier Coordonnées bancaire</p>
	    </div>
		<div class="container">
			<form method="POST">
			<div id="contactform">	
				<div class="panel panel-default">
					<div class="panel-body">
		                <div class="row">
							<div class="form-inline">
								<label>Fonctionnaire</label>
				                <input type="text" class="form-control" name="fnt" placeholder="Prénom" value="<?php echo $fk->CIN?>" readonly/>
				            </div>            
							<div class="form-inline">
								<label>Banque</label>
				                <input type="text" class="form-control" name="banque" placeholder="Prénom" value="<?php if (isset($result->banque)) echo $result->banque?>" />
				            </div>
				            <div class="form-inline">
				            	<label>Agence</label>
				                <input type="text" class="form-control" name="agence" placeholder="Nom" value="<?php if (isset($result->agence)) echo $result->agence?>" />
				            </div>
				            <div class="form-inline">
				                <label>Ville : </label>
				                <input type="text" class="form-control" name="ville"  value="<?php if (isset($result->ville)) echo $result->ville?>" />
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