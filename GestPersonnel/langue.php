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
			$langue = $_POST['langue'];
			$Niveau = $_POST['Niveau'];

			$stm=$db->prepare("INSERT INTO `langues`(`langue`, `Niveau`, `IdEnt`)  
				              VALUES (:langue,:Niveau,:IdEnt)");
			$stm->execute([
				'langue'	=> $langue,
				'Niveau'	=> $Niveau,
				'IdEnt'		=> $IdEnt]);
	    echo "<div class='alert alert-success alert-dismissible'>
	    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				Votre enregistrement est <b>bien Ajouter</b>
			</div>";
		}# End Query insert?>
	<div class="container">
		<div class="header">
	        <p><span class="fa fa-angle-right"></span> Ajouter Langue</p>
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
				                <label>Langue</label>
				                <input type="hidden" name="IdEnt" value="<?=$IdEnt?>" />
				                <input type="text" class="form-control float-right" placeholder="Langue" name="langue" />
				            </div>
				            <div class="form-inline">
				                <label>Niveau </label>
				                <input type="text" class="form-control float-right" placeholder="Niveau" 
				                name="Niveau" />
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
	if (isset($_REQUEST['idL'])) :
	    $idL=filter_var($_REQUEST['idL'],FILTER_SANITIZE_NUMBER_INT);
		if(!empty(checkTable('langues','id',$idL)) ) {
		$result=checkTable('langues','id',$idL);
		$fk=checkIden('identite',$result->IdEnt);
		# begin query update 
	    if (isset($_POST['modifier'])) {
			$langue = $_POST['langue'];
			$Niveau = $_POST['Niveau'];

			$stm=$db->prepare("UPDATE `langues` SET `langue`= ?,`Niveau`= ? WHERE `id`= ?");
			$stm->execute([$langue,$Niveau,$idL]);
	    echo "<div class='alert alert-success alert-dismissible'>
	    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				Votre Enregistrement est <b>bien modifier</b>
			</div>";
		header('Refresh:1;url='.$_SERVER['HTTP_REFERER']);
		}# End Query update?>
	<div class="container">
		<div class="header">
	        <p><span class="fa fa-angle-right"></span> Modifier Langue</p>
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
				                <label>Langue</label>
				                <input type="text" class="form-control float-right" placeholder="Langue" name="langue" value="<?php echo $result->langue?>" />
				            </div>
				            <div class="form-inline">
				                <label>Niveau</label>
				                <input type="text" class="form-control float-right" placeholder="Niveau" 
				                name="Niveau" value="<?php echo $result->Niveau?>" />
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