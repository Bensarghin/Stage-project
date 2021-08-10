<?php include 'layout/header.php'; ?>
<?php if (isset($_GET['page'])) {

	# Begin add diplome page
	if ($_GET['page']=='ajouter'){

		if (isset($_REQUEST['IdEnt'])) :
		$IdEnt=filter_var($_REQUEST['IdEnt'],FILTER_SANITIZE_NUMBER_INT);
		if( !empty(checkIden('identite',$IdEnt)) ) {
			# begin query insert 
	    if (isset($_POST['ajouter'])) {
			$spec = $_POST['spec'];
			$etab = $_POST['etab'];
			$dateDebut = $_POST['dateDebut'];
			$dateFin = $_POST['dateFin'];
			$duree = $_POST['duree'];
			$lieu = $_POST['lieu'];
			$pay = $_POST['pay'];
			$descp = $_POST['descp'];
			$IdEnt = $_POST['IdEnt'];

			$stm=$db->prepare("INSERT INTO formation 
				(`etablissment`, `specialite`, `duree`, `dateDebut`, `dateFin`, `lieu`, `pay`, `description`, `IdEnt`) 
				              VALUES (:etab,:spec,:duree,:dateDebut,:dateFin,:lieu,:pay,:descp,:IdEnt)");
			$stm->execute([
				'spec'		=> $spec,
				'etab'		=> $etab,
				'duree'	    => $duree,
				'dateDebut'	=> $dateDebut,
				'dateFin'	=> $dateFin,
				'lieu'		=> $lieu,
				'pay'		=> $pay,
				'descp'		=> $descp,
				'IdEnt'		=> $IdEnt]);
	    echo "<div class='alert alert-success alert-dismissible'>
	    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				Votre enregistrement est <b>bien ajouter</b>
			</div>";
		}# End Query insert ?>
	<div class="container">
		<div class="header">
	        <p><span class="fa fa-angle-right"></span> Ajouter Formation</p>
	    </div>
		<div class="container">
			<form method="POST" >
				<div id="contactform">
					<input type="hidden" name="IdEnt" value="<?=$IdEnt?>" />
		            <div class="form-inline">
		                <label>Spécialité </label>
		                <input type="text" class="form-control float-right" placeholder="Spécialité" 
		                name="spec" />
		            </div>
		            <div class="form-inline">
		                <label>Etablissement</label>
		                <input type="text" class="form-control float-right" name="etab" placeholder="Etablissement" />
		            </div>
		            <div class="form-inline">
		                <label>Durée</label>
		                <input type="number" class="form-control float-right" name="duree" placeholder="n mois" />
		            </div>
		            <div class="form-inline">
		                <label>Date Debut</label>
		                <input type="date" name="dateDebut" class="form-control float-right" />
		            </div>

		            <div class="form-inline">
		                <label>Date Fin</label>
		                <input type="date" name="dateFin" class="form-control float-right" />
		            </div>
		            <div class="form-inline">
		                <label>Lieu </label>
		                <input type="text" name="lieu" class="form-control float-right" placeholder="Lieu" />
		            </div>
		            <div class="form-inline">
		                <label>Pay </label>
		                <input type="text" name="pay" class="form-control float-right" placeholder="Pay" />
		            </div>
		            <div class="form-inline">
		                <textarea rows="7" placeholder="Description" class="form-control" name="descp"></textarea>
		            </div>
		            <div class="form-inline">
		                <button class="btn btn-outlined btn-primary vrf" name="ajouter">
		                	Ajouter
		                </button>
		            </div>
				</div>
	        </form>
		</div>
	</div>
	<?php 
	    
	}
 endif;

    }#end of add formation page

    # Begin edit formation page
	if ($_GET['page']=='modifier'){

	if (isset($_REQUEST['idF'])) :
	    $idF=filter_var($_REQUEST['idF'],FILTER_SANITIZE_NUMBER_INT);
		if(!empty(checkTable('formation','idF',$idF)) ) {
		$result=checkTable('formation','idF',$idF);
		# begin query update 
	    if (isset($_POST['modifier'])) {
			$spec = $_POST['spec'];
			$etab = $_POST['etab'];
			$dateDebut = $_POST['dateDebut'];
			$dateFin = $_POST['dateFin'];
			$duree = $_POST['duree'];
			$lieu = $_POST['lieu'];
			$pay = $_POST['pay'];
			$descp = $_POST['descp'];

			$stm=$db->prepare("UPDATE `formation` SET `etablissment`=:etab,`specialite`=:spec,`duree`=:duree,`dateDebut`=:dateDebut,`dateFin`=:dateFin,`lieu`=:lieu,`pay`=:pay,`description`=:descp WHERE `idF`=:idF");
			$stm->execute([
				'spec'		=> $spec,
				'etab'		=> $etab,
				'duree'	    => $duree,
				'dateDebut'	=> $dateDebut,
				'dateFin'	=> $dateFin,
				'lieu'		=> $lieu,
				'pay'		=> $pay,
				'descp'		=> $descp,
				'idF'		=> $idF]);
	    echo "<div class='alert alert-success alert-dismissible'>
	    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				Votre enregistrement est <b>bien modifier</b>
			</div>";		
			header("Refresh:1;url=".$_SERVER['HTTP_REFERER']);}# End Query update 
	}?>
	<div class="container">
		<div class="header">
	        <p><span class="fa fa-angle-right"></span> Modifier Formation</p>
	    </div>
		<div class="container">
			<form method="POST" >
				<div id="contactform">
		                <input type="hidden" name="IdEnt" value="<?php if (isset($result->IdEnt)) echo $result->IdEnt?>" />
		                <input type="hidden" name="idD" value="<?=$idF?>" />
		            <div class="form-inline">
		                <label>Spécialité </label>
		                <input type="text" class="form-control float-right" placeholder="Spécialité" 
		                name="spec" value="<?php if (isset($result->specialite)) echo $result->specialite?>" />
		            </div>
		            <div class="form-inline">
		                <label>Etablissement</label>
		                <input type="text" class="form-control float-right" name="etab" placeholder="Etablissement" value="<?php if (isset($result->etablissment)) echo $result->etablissment	?>" />
		            </div>
		            <div class="form-inline">
		                <label>Durée</label>
		                <input type="number" class="form-control float-right" name="duree" placeholder="n mois" value="<?php if (isset($result->duree)) echo $result->duree?>" />
		            </div>
		            <div class="form-inline">
		                <label>Date Debut</label>
		                <input type="date" name="dateDebut" class="form-control float-right" value="<?php if (isset($result->dateDebut)) echo $result->dateDebut?>" />
		            </div>

		            <div class="form-inline">
		                <label>Date Fin</label>
		                <input type="date" name="dateFin" class="form-control float-right" value="<?php if (isset($result->dateFin)) echo $result->dateFin?>" />
		            </div>
		            <div class="form-inline">
		                <label>Lieu </label>
		                <input type="text" name="lieu" class="form-control float-right" placeholder="Lieu" value="<?php if (isset($result->lieu)) echo $result->lieu?>" />
		            </div>
		            <div class="form-inline">
		                <label>Pay </label>
		                <input type="text" name="pay" class="form-control float-right" placeholder="Pay" value="<?php if (isset($result->pay)) echo $result->pay?>" />
		            </div>
		            <div class="form-inline">
		                <textarea rows="7" placeholder="Description" class="form-control" name="descp"><?php if (isset($result->description)) echo $result->description?></textarea>
		            </div>
		            <div class="form-inline">
		                <button class="btn btn-outlined btn-primary vrf" name="modifier">
		                	modifier
		                </button>
		            </div>
				</div>
	        </form>
		</div>
	</div>
	<?php 
	    
 endif;

    }#end of edt diplome page ?>

<?php } else{header('Location:accueil.php'); exit(); }include 'layout/footer.php'; ?>