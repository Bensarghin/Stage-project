<?php include 'layout/header.php';
# check if identite ex
        if (isset($_REQUEST['IdEnt'])){
        $IdEnt=filter_var($_REQUEST['IdEnt'],FILTER_SANITIZE_NUMBER_INT);
        # call function
        $result=checkIden('conjoint',$IdEnt);
            if(!empty($result)){ ?>
<div class="container">
	<div class="header">
        <p><span class="fa fa-angle-right"></span> Situation Familiale </p>
    </div>
	<div class="fonc-cv">
        <div class="perInfo">
            <div class="panel panel-default">
                <div class="panel-heading">
                   <h4>Conjoint(<span style="text-transform: lowercase;">e</span>) Information </h4>
                </div>
                <div class="panel-body">
                    <div class="row">
                       <span class="fas fa-key"></span> CIN : <?=$result->CIN?>
                    </div>
                    <div class="row">
                        <span class="fas fa-user"></span> Nom et prenom : <?=$result->nom?> <?=$result->prenom?>
                    </div>
                    <div lang="ar"  class="row">
                        <span class="fas fa-language"></span> اسم الكامل : <?=$result->nomAr?> <?=$result->prenomAr?>
                    </div>
                    <div class="row">
                      <span class="fas fa-suitcase"></span> Profession : <?=$result->profession?>
                    </div>
                    <div class="row">
                        <span class="fas fa-birthday-cake"></span> Date Naissance : <?=$result->dateNaissance?>
                    </div>
                    <div class="row">
                    <a href="?IdEnt=<?=$result->IdEnt?>&action=deleteC&idC=<?=$result->idC?>" class="btn btn-danger">supprimer</a> <a href="conjoint?page=modifier&idC=<?=$result->idC?>" class="btn btn-primary">modifier</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <div class="EnfantInfo">
        	<div class="panel panel-default">
        		<div class="panel-heading">
        			<h4>Enfants</h4>
        		</div>
        		<div class="panel-body">
        			<div class="row">
                        <?php 
                        $stm=$db->prepare("SELECT * FROM 
                                enfant WHERE idC=?");
                        $stm->execute([$result->idC]);
                        if ( $stm->rowCount() > 0 ) {
                         ?>
                        <table class="table text-center">
                            <tr>
                                <th>Nom et Prénom</th>
                                <th>اسم الكامل</th>
                                <th>DateNaissance</th>
                                <th>Sexe</th>
                                <th>Mise à jour</th>
                            </tr>
                            <?php 
                        while ($row=$stm->fetch()):?>
                            <tr>
                                <td><?= $row->Nom ?> <?= $row->Prenom ?></td>
                                <td><?= $row->NomAr ?> <?= $row->PrenomAr ?></td>
                                <td><?= $row->DateNa ?></td>
                                <td><?= $row->Sexe ?></td>
                                <td><a href="enfant?page=modifier&idE=<?=$row->idE?>" class="btn btn-primary">Modifier</a> <a href="?IdEnt=<?=$result->IdEnt?>&action=deleteE&idE=<?=$row->idE?>" class="btn btn-danger">Supprimer</a></td>
                            </tr>
                        <?php endwhile; ?>
                        </table>
                        <?php } ?>
					</div>
					<div class="row">
						<a href="enfant?page=ajouter&idC=<?=$result->idC?>"><span class="fa fa-angle-double-right"></span> Ajouter Enfant</a>
					</div>
        		</div>
        	</div>
        </div>
</div>

<?php 

# Begin Delete conjoint page
    if (isset($_GET['action'])) {
        if ($_GET['action']=='deleteC'):
            if (isset($_GET['idC'])){
            $idC=filter_var($_GET['idC'],FILTER_SANITIZE_NUMBER_INT) ;
            $stm=$db->prepare("DELETE FROM `conjoint` WHERE idC=?");
            $stm->execute([$idC]);
            echo "<div class='alert alert-warning'>
            En attent sup...
        </div>";
            header("Refresh:1;url=".$_SERVER['HTTP_REFERER']);
        }
        endif;
        if ($_GET['action']=='deleteE'):
            if (isset($_GET['idE'])){
            $idE=filter_var($_GET['idE'],FILTER_SANITIZE_NUMBER_INT) ;
            $stm=$db->prepare("DELETE FROM `enfant` WHERE idE=?");
            $stm->execute([$idE]);
            echo "<div class='alert alert-warning'>
            En attent sup...
        </div>";
            header("Refresh:1;url=".$_SERVER['HTTP_REFERER']);
        }endif;
    }# End Delete conjoint page
}
else
{
    echo "<div class='message-item'>
        <p><b>Pas </b>de Résultat !  
        <a href='conjoint?page=ajouter&IdEnt=$IdEnt'><span class='fa fa-angle-double-right'></span> Ajouter Conjoint(<span style='text-transform: lowercase;'>e</span>)</a></p>
              </div>";}
} include 'layout/footer.php'; ?>