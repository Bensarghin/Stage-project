<?php include 'layout/header.php';
?>





<?php 
	$stm=$db->prepare("SELECT * FROM identite ");
		$stm->execute();
	if($_SERVER['REQUEST_METHOD']=='POST'){
		if(!empty($_POST['cin'])){
		$cin=$_POST['cin'];
		$stm=$db->prepare("SELECT * FROM identite  WHERE CIN=?");
		$stm->execute([$cin]);
		}
	}
	?>
	<div class="container">
		<form method="POST">
			<div id="contactform">
				<div class="form-inline">
					<input type="search" name="cin" class="form-control" placeholder="Entrer CIN">
					<button class="btn btn-default vrf"><span class="fa fa-search"></span></button>
			    </div>
			</div>
		</form>
		<div>
			<h3>Liste Fonctionnaires</h3>
			<hr>
		</div>
		<table class="table table-bordered text-center">
			<tr class="text-center">
				<th>CIN</th>
				<th>Nom Prénom</th>
				<th>اسم الكامل</th>
				<th>Date et Lieu Naissance</th>
				<th>Etat Matrimonial</th>
				<th>Date Recrutement</th>
				<th>Mise à jour</th>
			</tr>
			<?php while($result=$stm->fetch()): ?>
			<tr>
				<td><?=$result->CIN?>
				</td>
				<td><?=$result->Nom?> <?=$result->Prenom?></td>
				<td><?=$result->Nom_ar?> <?=$result->Prenom_ar?></td>
				<td><?=$result->DateNassance?> <?=$result->LieuNaissance?>, <?=$result->PayNaissance?></td>
				<td><?=$result->EtatMatrimonial?></td>
				<td><?=$result->DateRecrutement	?></td>
				<td>
					<a class="btn btn-default" href="fonctionaire?page=detail&cin=<?=$result->CIN?>">Dét</a>
					<a href="?page=manage&action=delete&IdEnt=<?=$result->IdEnt?>" class="btn btn-outlined btn-danger"> sup </a>
					<a href="Fonctionnaire?page=modifier&IdEnt=<?=$result->IdEnt?>"  class="btn btn-outlined btn-primary"> Mod</a>
				</td>
			</tr>
		<?php endwhile; ?>
		</table>
	</div>






<?php 
	$stm=$db->prepare("SELECT * FROM 
						identite i 
					INNER JOIN 
						Grade g 
					ON 
						g.IdEnt=i.IdEnt
					INNER JOIN
						Affectation a
					ON
						a.IdEnt=i.IdEnt");
		$stm->execute();
	if($_SERVER['REQUEST_METHOD']=='POST'){
		if(!empty($_POST['cin'])){
		$cin=$_POST['cin'];
		$stm=$db->prepare("SELECT * FROM 
						identite i 
					INNER JOIN 
						Grade g 
					ON 
						g.IdEnt=i.IdEnt
					INNER JOIN
						Affectation a
					ON
						a.IdEnt=i.IdEnt WHERE i.CIN=?");
		$stm->execute([$cin]);
		}
	}
	?>
	<div class="container">
		<div>
			<h3>Liste Données Administratif De Fonctionnaires</h3>
			<hr>
		</div>
		<table class="table table-bordered text-center">
			<tr class="text-center">
				<th colspan="3">Fonctionnaire</th>
				<th colspan="3">Affectation</th>
				<th colspan="4">Grade</th>
				<th rowspan="2">Note</th>
			</tr>
			<tr class="text-center">
				<th>CIN</th>
				<th>Nom Prénom</th>
				<th>Mise à jour</th>
				<th>Affectation</th>
				<th>Division</th>
				<th>Mise à jour</th>
				<th>Indice</th>
				<th>Echelon</th>
				<th>Date Effet</th>
				<th>Mise à jour</th>
			</tr>
			<?php while($result=$stm->fetch()): ?>
			<tr>
				<td><?=$result->CIN?>
				</td>
				<td><?=$result->Nom?> <?=$result->Prenom?></td>
				<td><a class="btn btn-default" href="fonctionaire?page=detail&cin=<?=$result->CIN?>">Dét</a></td>
				<td><?=$result->affectation?></td>
				<td><?=$result->division?></td>
				<td>
					<a href="affectation?page=details&IdEnt=<?=$result->IdEnt?>" class="btn btn-default">Dét</a>
					<a href="" class="btn btn-danger"> sup </a>
					<a href="affectation?page=modifier&idA=<?=$result->idA?>"  class="btn btn-outlined btn-primary"> Mod</a>
				</td>
				<td><?=$result->indice?></td>
				<td><?=$result->Echelon?></td>
				<td><?=$result->dateEffect?></td>
				<td>
					<a href="?page=manage&action=delete&IdEnt=<?=$result->IdEnt?>" class="btn btn-outlined btn-danger"> sup </a>
					<a href="grade?page=modifier&idG=<?=$result->idG?>"  class="btn btn-outlined btn-primary"> Mod</a>
				</td>
				<td>20</td>
			</tr>
		<?php endwhile; ?>
		</table>
	</div>
<?php 
include 'layout/footer.php'; ?>