<?php include 'layout/header.php'; ?>
<?php if (isset($_GET['page'])) {

	# Begin add diplome page
	if ($_GET['page']=='ajouter'){

		if (isset($_REQUEST['IdEnt'])) :
		$IdEnt=filter_var($_REQUEST['IdEnt'],FILTER_SANITIZE_NUMBER_INT);
		if( !empty(checkIden('identite',$IdEnt)) ) {
        $fk=checkIden('identite',$IdEnt);
	    # begin query insert 
	    if (isset($_POST['ajouter'])) {
	    	if(!empty($_POST['intitule'])&&!empty($_POST['spec'])&&!
			empty($_POST['etab'])&&!empty($_POST['dateEnt'])&&
			!empty($_POST['lieu'])&&!empty($_POST['pay'])&&!empty($_POST['descp'])){
			$intitule = $_POST['intitule'];
			$spec = $_POST['spec'];
			$etab = $_POST['etab'];
			$dateEnt = $_POST['dateEnt'];
			$lieu = $_POST['lieu'];
			$pay = $_POST['pay'];
			$descp = $_POST['descp'];
			$IdEnt = $_POST['IdEnt'];

			$stm=$db->prepare("INSERT INTO 
				                    `diplomes` (`intitule`, `specialite`, `etablissement`, `dateEntr`, `lieu`, `pay`, `descp`, `IdEnt`) 
				              VALUES (:intitule,:spec,:etab,:dateEnt,:lieu,:pay,:descp,:IdEnt)");
			$stm->execute([
				'intitule'	=> $intitule,
				'spec'		=> $spec,
				'etab'		=> $etab,
				'dateEnt'	=> $dateEnt,
				'lieu'		=> $lieu,
				'pay'		=> $pay,
				'descp'		=> $descp,
				'IdEnt'		=> $IdEnt]);
	    echo "<div class='alert alert-success alert-dismissible'>
	    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				Votre enregistrement est <b>bien Ajouter</b>
			</div>";}
			else{
				echo "<div class='alert alert-danger alert-dismissible'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Tous les<b> Champs est obligatoire</b></div>";
			}
		}# End Query insert?>
	<div class="container">
		<div class="header">
	        <p><span class="fa fa-angle-right"></span> Ajouter Diplome</p>
	        <div class="line"></div>
	    </div>
		<div class="container">
			<form method="POST" >
				<div id="contactform">
				   <div class="panel panel-default">
					  <div class="panel-body">
		                <div class="row">
							<div class="form-inline">
								<label>Fonctionnaire concerné</label>
				                <input type="text" class="form-control" name="fnt" placeholder="Prénom" value="<?php echo $fk->CIN?>" readonly/>
				            </div>
							<div class="form-inline">
				                <label>Intitule</label>
				                <input type="hidden" name="IdEnt" value="<?=$IdEnt?>" />
				                <input type="text" class="form-control float-right" placeholder="Intitule" name="intitule" />
				            </div>
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
				                <label>Date Entrer</label>
				                <input type="date" name="dateEnt" class="form-control float-right" />
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
				                <textarea rows="7" placeholder="Descirption" class="form-control" name="descp"></textarea>
				            </div>
				        </div>
				     </div>
				</div>
				<button class="btn btn-outlined btn-primary vrf" name="ajouter">Ajouter</button>
				</div>
	        </form>
		</div>
	</div>
	<?php  
	}
 endif;

    }#end of add diplome page

    # Begin edit diplome page
	if ($_GET['page']=='modifier'){
	if (isset($_REQUEST['idD'])) :
	    $idD=filter_var($_REQUEST['idD'],FILTER_SANITIZE_NUMBER_INT);
		if(!empty(checkTable('diplomes','idD',$idD)) ) {
		$result=checkTable('diplomes','idD',$idD);
		$fk=checkIden('identite',$result->IdEnt);
		# begin query update 
	    if (isset($_POST['modifier'])) {
	    	if(!empty($_POST['intitule'])&&!empty($_POST['spec'])&&!
			empty($_POST['etab'])&&!empty($_POST['dateEnt'])&&
			!empty($_POST['lieu'])&&!empty($_POST['pay'])&&!empty($_POST['descp'])){
			$intitule = $_POST['intitule'];
			$spec = $_POST['spec'];
			$etab = $_POST['etab'];
			$dateEnt = $_POST['dateEnt'];
			$lieu = $_POST['lieu'];
			$pay = $_POST['pay'];
			$descp = $_POST['descp'];

			$stm=$db->prepare("UPDATE `diplomes` SET `intitule`=:intitule,`specialite`=:spec,`etablissement`=:etab,`dateEntr`=:dateEnt,`lieu`=:lieu,`pay`=:pay,`descp`=:descp WHERE `idD`=:idD");
			$stm->execute([
				'intitule'	=> $intitule,
				'spec'		=> $spec,
				'etab'		=> $etab,
				'dateEnt'	=> $dateEnt,
				'lieu'		=> $lieu,
				'pay'		=> $pay,
				'descp'		=> $descp,
				'idD'		=> $idD]);
	    echo "<div class='alert alert-success alert-dismissible'>
	    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				Votre Enregistrement est <b>bien modifier</b>
			</div>";
		header('Refresh:1;url='.$_SERVER['HTTP_REFERER']);}
			else{
				echo "<div class='alert alert-danger alert-dismissible'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Tous les<b> Champs est obligatoire</b></div>";
			}
		}# End Query update?>
	<div class="container">
		<div class="header">
	        <p><span class="fa fa-angle-right"></span> Modifier Diplome</p>
	    </div>
		<div class="container">
			<form method="POST" >
				<div id="contactform">
					<div class="panel panel-default">
					  <div class="panel-body">
		                <div class="row">
							<div class="form-inline">
								<label>Fonctionnaire concerné</label>
				                <input type="text" class="form-control" name="fnt" placeholder="Prénom" value="<?php echo $fk->CIN?>" readonly/>
				            </div>
				            <div class="form-inline">
				                <label>Intitule</label>
				                <input type="hidden" name="IdEnt" value="<?php if (isset($result->IdEnt)) echo $result->IdEnt?>" />
				                <input type="hidden" name="idD" value="<?=$idD?>" />
				                <input type="text" class="form-control float-right" placeholder="Intitule" name="intitule" value="<?php if (isset($result->intitule)) echo $result->intitule?>" />
				            </div>
				            <div class="form-inline">
				                <label>Spécialité </label>
				                <input type="text" class="form-control float-right" placeholder="Spécialité" 
				                name="spec" value="<?php if (isset($result->specialite)) echo $result->specialite?>" />
				            </div>
				            <div class="form-inline">
				                <label>Etablissement</label>
				                <input type="text" class="form-control float-right" name="etab" placeholder="Etablissement" value="<?php if (isset($result->etablissement)) echo $result->etablissement?>" />
				            </div>
				            <div class="form-inline">
				                <label>Date Entrer</label>
				                <input type="date" value="<?php if (isset($result->dateEntr)) echo $result->dateEntr?>" name="dateEnt" class="form-control float-right" />
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
				                <textarea rows="7" placeholder="observation" class="form-control" name="descp"><?php if (isset($result->descp)) echo $result->descp?></textarea>
				            </div>
				         </div>
				     </div>
				    </div>
				    <button class="btn btn-outlined btn-primary vrf" name="modifier">modifier</button>
				</div>
	        </form>
		</div>
	</div>
	<?php  	
}
else{
     echo "<div class='message-item'>
        <p><b>Pas </b>de Résultat !</p>
              </div>";}
 endif;
    }#end of edt diplome page ?>

<?php } else{header('Location:accueil.php'); exit(); }include 'layout/footer.php'; ?>