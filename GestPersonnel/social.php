<?php include 'layout/header.php';
# check if identite ex
        if (isset($_REQUEST['IdEnt'])){
        $IdEnt=filter_var($_REQUEST['IdEnt'],FILTER_SANITIZE_NUMBER_INT);
        # call function?>
<div class="container">
	<div class="header">
        <p><span class="fa fa-angle-right"></span> Données Sociale</p>
    </div>
	<div class="fonc-cv">
        <div class="perInfo">
            <div class="panel panel-default">
                <div class="panel-heading">
                   <h4>Coordonées bancaire </h4>
                </div>
                <div class="panel-body">
                    <?php 
        $result=checkIden('coordbanc',$IdEnt);
            if(!empty($result)){  ?>
                    <div class="row">
                       <span class="fas fa-coins"></span> Banque : <?=$result->banque?>
                    </div>
                    <div class="row">
                        <span class="fas fa-building"></span> Agence : <?=$result->agence?>
                    </div>
                    <div class="row">
                        <span class="fas fa-road"></span> Ville : <?=$result->ville?>
                    </div>
                    <div class="row">
                    <a href="?IdEnt=<?=$result->IdEnt?>&action=delete&idC=<?=$result->idC?>" class="btn btn-danger">supprimer</a> <a href="coordoBancaire?page=modifier&idC=<?=$result->idC?>" class="btn btn-primary">modifier</a>
                    </div>
                <?php } else{ ?>
                <div class="row"><a href="coordoBancaire?page=ajouter&IdEnt=<?=$IdEnt?>"><span class="fa fa-angle-double-right"></span> Ajouter Coordonées bancaire</a>
                </div>
                <?php } ?>
                </div>
            </div>
        </div>
    </div>
        <div class="EnfantInfo">
        	<div class="panel panel-default">
        		<div class="panel-heading">
        			<h4>Régime de retraite</h4>
        		</div>
        		<div class="panel-body">
                 <?php  $result=checkIden('regimeretraite',$IdEnt);
            if(!empty($result)){  ?>
                    <div class="row">
                       <span class="fas fa-map-signs"></span> Type : <?=$result->type?>
                    </div>
                    <div class="row">
                        <span class="fas fa-handshake"></span> Num Affel : <?=$result->numAffel?>
                    </div>
                    <div class="row">
                        <span class="fas fa-calendar-check"></span>   Date Affel  : <?=$result->dateAffel ?>
                    </div>
                    <div class="row">
                    <a href="?IdEnt=<?=$result->IdEnt?>&action=delete&idR=<?=$result->idR?>" class="btn btn-danger">supprimer</a> <a href="coordoBancaire?page=modifier&idR=<?=$result->idR?>" class="btn btn-primary">modifier</a>
                    </div>
                <?php } else{ ?>
                <div class="row">
                    <a href="regime_retraite?page=ajouter&IdEnt=<?=$IdEnt?>">
                        <span class="fa fa-angle-double-right"></span> Ajouter Régime de retraite
                    </a>
                </div>
                <?php } ?>
                </div>
        	</div>
            <div class="panel panel-default">
                <div class="panel-heading">
                   <h4>Mutuelle </h4>
                </div>
                <div class="panel-body">
                   <?php $result=checkIden('mutuelle',$IdEnt);
                    if(!empty($result)){  ?>
                    <div class="row">
                       <span class="fas fa-map-signs"></span>   type Mutuelle  : <?=$result->typeMut ?>
                    </div>
                    <div class="row">
                        <span class="fas fa-id-badge"></span> Matricule : <?=$result->Matricule?>
                    </div>
                    <div class="row">
                        <span class="fas fa-handshake"></span> Num Affiliation  : <?=$result->NumAffiliation ?>
                    </div>
                    <div class="row">
                        <span class="fas fa-calendar-check"></span> Date Affiliation  : <?=$result->DateAffiliation ?>
                    </div>
                    <div class="row">
                    <a href="?IdEnt=<?=$result->IdEnt?>&action=delete&idC=<?=$result->idM?>" class="btn btn-danger">supprimer</a> <a href="mutuelle?page=modifier&idM=<?=$result->idM?>" class="btn btn-primary">modifier</a>
                    </div>
                <?php } else{ ?>
                <div class="row"><a href="mutuelle?page=ajouter&IdEnt=<?=$IdEnt?>"><span class="fa fa-angle-double-right"></span> Ajouter mutuelle</a>
                </div>
                <?php } ?>
                </div>
            </div>
        </div>
</div>

<?php 

# Begin Delete conjoint page
    if (isset($_GET['action'])) {
        if ($_GET['action']=='delete'):
            if (isset($_GET['idC'])){
            $idC=filter_var($_GET['idC'],FILTER_SANITIZE_NUMBER_INT) ;
            $stm=$db->prepare("DELETE FROM `conjoint` WHERE idC=?");
            $stm->execute([$idC]);
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
 include 'layout/footer.php'; ?>