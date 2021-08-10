<?php include 'layout/header.php'; ?>
<?php if (isset($_GET['page'])) {
    # Begin cv detail page
    if ($_GET['page']=='detail'){

        # check if identite ex
        if (isset($_REQUEST['IdEnt'])){
        $IdEnt=filter_var($_REQUEST['IdEnt'],FILTER_SANITIZE_NUMBER_INT);
        # call function
        if(!empty(checkIden('identite',$IdEnt))) {
        $result=checkIden('identite',$IdEnt);
?>
<div class="container">
	<div class="header">
        <p><span class="fa fa-angle-right"></span> Curriculum vitae</p>
    </div>
	<div class="fonc-cv">
        <div class="perInfo">
            <div class="panel panel-default">
                <div class="panel-heading">
                   <h4> Personnel Information</h4>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-6">
                        <!-- <div>
                                <?=$result->CIN?>
                            </div> -->
                            <div>
                                <?=$result->Nom?> <?=$result->Prenom?>
                            </div>
                            <div>
                                <?=$result->Nom_ar?> <?=$result->Prenom_ar?>
                            </div>
                            <div>
                                <?=$result->Sexe?>
                            </div>
                            <div><?=$result->DateNassance?>, <?=$result->LieuNaissance?>, <?=$result->PayNaissance?></div>
                        </div>
                        <div class="center-mg col-sm-6"> 
                            <div style="background: url(<?=$result->Photo?>); height: 120px;width: 120px;background-size: cover;
                          background-position: center;">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <a href="fonctionaire?page=detail&cin=<?=$result->CIN?>"><span class="fa fa-angle-double-right"></span> Plus Détails </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="dipInfo">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4> Diplomes</h4>
                </div>
                <div class="panel-body">

                    <?php 
                        $stm=$db->prepare("SELECT * FROM 
                               diplomes WHERE IdEnt=?");
                        $stm->execute([$_REQUEST['IdEnt']]);
                    while ($row=$stm->fetch()):
                     ?>
                	<div class="row">
                	  	<div class="col-sm-3"><?=$row->dateEntr?> : </div>
                        <div class="col-sm-6"><?=$row->specialite?>, <?=$row->etablissement?>, <?=$row->lieu?></div>
	                    <div class="col-sm-3"><a href="diplome?page=modifier&idD=<?=$row->idD?>" class="btn btn-outlined btn-primary">Mod</a>&nbsp;<a href="?page=detail&action=deleteD&IdEnt=<?=$IdEnt?>&idD=<?=$row->idD?>" class="btn btn-outlined btn-danger">Sup</a>
	                    </div>
                	</div>
                    <?php 
                    endwhile; ?>
                    <div class="row">
                        <a href="diplome?page=ajouter&IdEnt=<?=$IdEnt?>"><span class="fa fa-angle-double-right"></span> Ajouter Diplome </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="formInfo">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>Formations</h4>
                </div>
                <div class="panel-body">
                    <?php 
                        $stm=$db->prepare("SELECT * FROM 
                               formation WHERE IdEnt=?");
                        $stm->execute([$_REQUEST['IdEnt']]);
                    while ($row=$stm->fetch()):
                     ?>
                    <div class="row">
                        <div class="col-sm-3"><?=$row->duree?> mois : </div>
                        <div class="col-sm-6"><?=$row->specialite?>, <?=$row->etablissment?>, <?=$row->lieu?></div>
                        <div class="col-sm-3"><a href="formation?page=modifier&idF=<?=$row->idF?>" class="btn btn-outlined btn-primary">Mod</a>&nbsp;<a href="?page=detail&action=deleteF&IdEnt=<?=$IdEnt?>&idF=<?=$row->idF?>" class="btn btn-outlined btn-danger">Sup</a>
                        </div>
                    </div>
                    <?php 
                    endwhile; ?>
                    <div class="row">
                        <a href="formation?page=ajouter&IdEnt=<?=$IdEnt?>"><span class="fa fa-angle-double-right"></span> Ajouter Formation </a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="langInfo">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>langues</h4>
                </div>
                <div class="panel-body">

                    <?php 
                        $stm=$db->prepare("SELECT * FROM 
                               langues WHERE IdEnt=?");
                        $stm->execute([$_REQUEST['IdEnt']]);
                    while ($row=$stm->fetch()):
                     ?>
                    <div class="row">
                        <div class="col-sm-3"><?=$row->langue?> : </div>
                        <div class="col-sm-6"><?=$row->Niveau?></div>
                        <div class="col-sm-3">
                            <a href="langue?page=modifier&idL=<?=$row->id?>" class="btn btn-outlined btn-primary">Mod</a>&nbsp;<a href="?page=detail&action=deleteL&IdEnt=<?=$IdEnt?>&idL=<?=$row->id?>" class="btn btn-outlined btn-danger">Sup</a>
                        </div>
                    </div>
                    <?php 
                    endwhile; ?>
                    <div class="row">
                        <a href="langue?page=ajouter&IdEnt=<?=$IdEnt?>"><span class="fa fa-angle-double-right"></span> Ajouter langue </a>
                    </div>
                </div>
            </div>
        </div>
	</div>
</div>
<?php 
    # Begin Delete diplome page
    if (isset($_GET['action'])) {
        if ($_GET['action']=='deleteD'){
            if (isset($_GET['idD'])):
            $idD=filter_var($_GET['idD'],FILTER_SANITIZE_NUMBER_INT) ;
            $stm=$db->prepare("DELETE FROM diplomes WHERE idD=?");
            $stm->execute([$idD]);
            echo "<div class='alert alert-warning'>
            En attent...
            </div>";
            header("Refresh:1;url=".$_SERVER['HTTP_REFERER']);
            endif;
        }
        elseif ($_GET['action']=='deleteF'){
            if (isset($_GET['idF'])){
            $idF=filter_var($_GET['idF'],FILTER_SANITIZE_NUMBER_INT) ;
            $stm=$db->prepare("DELETE FROM formation WHERE idF=?");
            $stm->execute([$idF]);
            echo "<div class='alert alert-warning'>
            En attent...
            </div>";
            header("Refresh:1;url=".$_SERVER['HTTP_REFERER']);
          }
        }
        elseif ($_GET['action']=='deleteL'){
            if (isset($_GET['idL'])){
            $idL=filter_var($_GET['idL'],FILTER_SANITIZE_NUMBER_INT) ;
            $stm=$db->prepare("DELETE FROM langues WHERE id=?");
            $stm->execute([$idL]);
            echo "<div class='alert alert-warning'>
            En attent...
            </div>";
            header("Refresh:1;url=".$_SERVER['HTTP_REFERER']);
          }
        };
    }# End Delete Diplome page

    }# End funct call
?>
<?php 
    }# check if identite ex
    else{header('Location:accueil.php'); exit();}
    }# End detail CV page
    else{header('Location:accueil.php'); exit();}
}
else{header('Location:accueil.php'); exit();} 
 include 'layout/footer.php'; ?>