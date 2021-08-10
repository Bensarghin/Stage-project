<?php include 'layout/header.php';
?>

<?php if (isset($_GET['page'])) {
# Begin Manage Fonctionaire page
if ($_GET['page']=='manage'){
	$stm=$db->prepare("SELECT * FROM identite");
		$stm->execute();
	?>
	<div class="header">
        <p><span class="fa fa-angle-right"></span>Gérer Dossier administratif des Fonctionnaires</p>
        <div class="line"></div>
    </div>
	<div class="container">
		<a class="btn btn-outlined btn-default">tous</a>
		<a class="btn btn-outlined btn-info">Meilleur échelon</a>
		<form class="filtrer-form" method="POST">
			<div class="filter-form">
				<div class="form-inline">
					<select name="etatM" class="form-control" >
						<option value="0">Selectionner Division--</option>
	                	<option value="Celibataire">DCL</option>
	                	<option value="Mariee">DSM</option>
	                	<option value="Veuve">SML</option>
	                	<option value="Divorcee">SLM</option>
	                </select>
	                <select class="form-control" name="imputatB">
	                	<option value="0">Selectionner Classe--</option>
	                	<option value="Générale">Unique</option>
	                	<option value="Communale">1ére</option>
	                	<option value="Provinciale">2éme</option>
	                </select>
					<button class="btn btn-outlined btn-default">filtrer <span class="fa fa-filter"></span></button>
			    </div>
			</div>
		</form>
		<table class="table table-bordered text-center">
			<tr class="text-center">
				<th>CIN</th>
				<th>Nom et Prenom</th>
				<th>Détails</th>
				<th>Affectation</th>
				<th>Grade</th>
				<th>Notation</th>
				<th>Mise à jour</th>
			</tr>
			<?php while($result=$stm->fetch()): ?>
			<tr>
				<td><?=$result->CIN?></td>
				<td><?=$result->Nom?> <?=$result->Prenom?></td>
				<td><a href="fonctionaire?page=detail&cin=<?=$result->CIN?>"><span class="fas fa-plus-circle"></span></a></td>
				<td><a href="affectation?page=details&IdEnt=<?=$result->IdEnt?>"><span class="fas fa-briefcase"></span></a></td>
				<td><a href="grade?page=details&IdEnt=<?=$result->IdEnt?>"><i class="fas fa-star"></i></a> </td>
				<td><a href="social?IdEnt=<?=$result->IdEnt?>"><span class="fas fa-marker"></span></a></td>
				<td>
					<a href="?page=manage&action=delete&IdEnt=<?=$result->IdEnt?>" class="btn btn-outlined btn-danger"> sup </a>
					<a href="?page=modifier&IdEnt=<?=$result->IdEnt?>"  class="btn btn-outlined btn-primary"> Mod</a>
				</td>
			</tr>
		<?php endwhile; ?>
		</table>
	</div>
<?php }
# End Manage Fonctionaire page

 } else{header('Location:accueil.php'); exit();} 
include 'layout/footer.php'; ?>