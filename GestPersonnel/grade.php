<?php include 'layout/header.php'; ?>

<?php if (isset($_GET['page'])) {

    # Begin of details affectation page
	if ($_GET['page']=='details'){

		if (isset($_REQUEST['IdEnt'])) :
		$IdEnt=filter_var($_REQUEST['IdEnt'],FILTER_SANITIZE_NUMBER_INT);
		if( !empty(checkIden('grade',$IdEnt)) ) {
		$result = checkIden('grade',$IdEnt);
		$fk = checkIden('identite',$IdEnt);?>
	<div class="container">
		<div class="header">
	        <p><span class="fa fa-angle-right"></span> Grade</p>
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
						</div>
					    <div class="panel-footer text-center"><a href="fonctionaire?page=detail&cin=<?=$fk->CIN?>"><?=$fk->Nom?> - <?=$fk->Prenom?></a></div>
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
			                		<i class="fas fa-ruler-vertical"></i> Echelle :
			                	</div>
			                	<div class="col-sm-6">
			                		<?=$result->Echelle?>
			                	</div>
					        </div>
					        <div class="row">
			                	<div class="col-sm-6">
			                		<i class="fas fa-sitemap"></i> Classe :
			                	</div>
			                	<div class="col-sm-6">
			                		<?=$result->Classe?>
			                	</div>
					        </div>
					        <div class="row">
			                	<div class="col-sm-6">
			                		<i class="fas fa-sort-numeric-up"></i> Echelon :
			                	</div>
			                	<div class="col-sm-6"><?=$result->Echelon?>
			                	</div>
					        </div>
					        <div class="row">
			                	<div class="col-sm-6">
			                		<i class="fas fa-thumbtack"></i> Indice :
			                	</div>
			                	<div class="col-sm-6">
			                		<?=$result->indice?>
			                	</div>
					        </div>
					        <div class="row">
			                	<div class="col-sm-6">
			                		<i class="fas fa-hourglass-start"></i> Date Effet Echelon :
			                	</div>
			                	<div class="col-sm-6"> <?=$result->dateEffect?></div>
					        </div>
					        <div class="row">
			                	<div class="col-sm-6">
			                		<a href="?page=modifier&idG=<?=$result->idG?>" class="btn btn-primary">modifier</a> 
			                		<a href="?page=details&IdEnt=<?=$result->IdEnt?>&action=delete&idG=<?=$result->idG?>" class="btn btn-danger">supprimer</a>
			                	</div>
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
        <p><b>Pas </b>de Résultat ! <a href='?page=ajouter&IdEnt=$IdEnt'><span class='fa fa-angle-double-right'></span> Ajouter Grade</a></p>
              </div>";
	}
 endif;

    }#end of details grade page

	# Begin add grade page
	elseif ($_GET['page']=='ajouter'){

		if (isset($_REQUEST['IdEnt'])) :
		$IdEnt=filter_var($_REQUEST['IdEnt'],FILTER_SANITIZE_NUMBER_INT);
		if( !empty(checkIden('identite',$IdEnt)) ) {
			$fk=checkIden('identite',$IdEnt);
			# begin query insert 
	    if (isset($_POST['ajouter'])):
		$Classe = $_POST['Classe'];
		$Echelle = $_POST['Echelle'];
		$Echelon = $_POST['Echelon'];
		$indice = $_POST['indice'];
		$dateEffect = $_POST['dateEffect'];
		$stm=$db->prepare("INSERT INTO `grade`(`Echelle`, `Classe`, `Echelon`, `indice`, `dateEffect`, `IdEnt`) VALUES (:Echelle,:Classe,:Echelon,:indice,:dateEffect,:IdEnt)");
		$stm->execute([
			'Echelle'	=> $Echelle,
			'Classe'	=> $Classe,
			'Echelon'	=> $Echelon,
			'indice'	=> $indice,
			'dateEffect'=> $dateEffect,
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
	        <p><span class="fa fa-angle-right"></span> Ajouter Grade</p>
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
		                	<label>Echelle : </label>
				                <input type="number" class="form-control" name="Echelle" placeholder="Echelle" value="" />
				            </div>
				            <div class="form-inline">
		                	<label>Classe : </label>
				                <input type="text" class="form-control" name="Classe" placeholder="Classe" value="" />
				            </div>
							<div class="form-inline">
		                	<label>Echelon : </label>
				                <input type="number" class="form-control" name="Echelon" placeholder="Echelon" value="" />
				            </div>
				            <div class="form-inline">
				            	<label>Indice : </label>
				                <input type="number" class="form-control" name="indice" placeholder="Indice" value="" />
				            </div>
				            <div class="form-inline">
				            	<label>Date Effet Echelon : </label>
				                <input type="date" class="form-control" name="dateEffect" value="<?= date("Y-m-d") ?>" />
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

		if (isset($_REQUEST['idG'])) :
        $idG=filter_var($_REQUEST['idG'],FILTER_SANITIZE_NUMBER_INT);
		if( !empty(checkTable('grade','idG',$idG)) ) {
			$result=checkTable('grade','idG',$idG);
			$fk=checkIden('identite',$result->IdEnt);
			# begin query insert 
	if (isset($_POST['modifier'])):
		$Classe = $_POST['Classe'];
		$Echelle = $_POST['Echelle'];
		$Echelon = $_POST['Echelon'];
		$indice = $_POST['indice'];
		$dateEffect = $_POST['dateEffect'];
		$stm=$db->prepare("UPDATE `grade` SET `Echelle`=:Echelle,`Classe`=:Classe,`Echelon`=:Echelon,`indice`=:indice,`dateEffect`=:dateEffect WHERE `idG`=:idG");
		$stm->execute([
			'Echelle'	=> $Echelle,
			'Classe'	=> $Classe,
			'Echelon'	=> $Echelon,
			'indice'	=> $indice,
			'dateEffect'=> $dateEffect,
			'idG'		=> $idG]);
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
	        <p><span class="fa fa-angle-right"></span> modifier Grade</p>
	    </div>
		<div class="container">
			<form method="POST">
			<div id="contactform">	
				<div class="panel panel-default">
					<div class="panel-body">
		                <div class="row">
							<div class="form-inline">
								<label>Fonctionnaire : </label>
				                <input type="text" class="form-control" name="fnt" value="<?php echo $fk->CIN?>" readonly/>
				            </div>            
							<div class="form-inline">
		                	<label>Echelle : </label>
				                <input type="number" class="form-control" name="Echelle" placeholder="Echelle" value="<?php if (isset($result->Echelle)) echo $result->Echelle?>" />
				            </div>
				            <div class="form-inline">
		                	<label>Classe : </label>
				                <input type="text" class="form-control" name="Classe" placeholder="Classe" value="<?php if (isset($result->Classe)) echo $result->Classe?>"/>
				            </div>
							<div class="form-inline">
		                	<label>Echelon : </label>
				                <input type="number" class="form-control" name="Echelon" placeholder="Echelon" value="<?php if (isset($result->Echelon)) echo $result->Echelon?>" />
				            </div>
				            <div class="form-inline">
				            	<label>Indice : </label>
				                <input type="number" class="form-control" name="indice" placeholder="Indice" value="<?php if (isset($result->indice)) echo $result->indice?>"/>
				            </div>
				            <div class="form-inline">
				            	<label>Date Effet Echelon : </label>
				                <input type="date" class="form-control" name="dateEffect" value="<?php if (isset($result->dateEffect)) echo $result->dateEffect?>" />
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

    }#end of modifier grade page
# Begin Delete grade page
    if (isset($_GET['action'])) {
        if ($_GET['action']=='delete'):
            if (isset($_GET['idG'])){
            $idG=filter_var($_GET['idG'],FILTER_SANITIZE_NUMBER_INT) ;
            $stm=$db->prepare("DELETE FROM `grade` WHERE idG=?");
            $stm->execute([$idG]);
            echo "<div class='alert alert-warning'>
            En attent sup...
        </div>";
            header("Refresh:1;url=".$_SERVER['HTTP_REFERER']);
        }
        endif;
    }# End Delete grade page
} else{header('Location:accueil.php'); exit(); }include 'layout/footer.php'; ?>