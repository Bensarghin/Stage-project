<?php include 'layout/header.php'; ?>

<?php   $id_authent=$_SESSION['id_authent'];
		if( !empty(checkTable('authent','idAuthent',$id_authent)) ) {
		$result = checkTable('authent','idAuthent',$id_authent);

			if($_SERVER['REQUEST_METHOD']=='POST') {
			$Nom=$_POST['nom'];
			$Prenom=$_POST['prenom'];
			$Login=$_POST['login'];
		    $stm=$db->prepare("UPDATE `authent` SET `Log`=?,`Nom`=?,`Prenom`=?");
		        $stm->execute([$Login,$Nom,$Prenom]);
		    echo "<div class='alert alert-success'>
		           Bien Modifier...
		        </div>";
		    header("Refresh:1;url=".$_SERVER['HTTP_REFERER']);
			} ;?>
	<div class="container">
		<div class="header">
	        <p><span class="fa fa-angle-right"></span> Admin profile</p>
	    </div>
		<form method="POST">
			<div id="profile">
				<div class="panel panel-default">
					<div class="panel-body">
		                <div class="row">
		                    <div class="inline-form">
		                    	<label>Role</label>
					            	<p><b>Admin principale</b></p> <!-- <button class="btn btn-success">Activer</button> -->
				            </div>
							<div class="form-group">
								<label>Nom</label>
		                	    <i class="fas fa-user fa-lg"></i>		
		                	    <input type="text" name="nom" placeholder="Nom" value="<?= $result->Nom ?>" />
				            </div>
				            <div class="form-group">
				            	<label>Prenom</label>
		                	    <i class="fas fa-user fa-lg"></i>
				                <input type="text" name="prenom" placeholder="Prenom" value="<?= $result->Prenom ?>" />
				            </div>
							<div class="form-group">
								<label>Login</label>
		                	    <i class="fas fa-lock fa-lg"></i>
				                <input type="text" name="login" placeholder="Login" value="<?= $result->Log ?>" />
				            </div>
				        </div>
					</div>
					<div class="panel-footer">
				        <button class="btn btn-primary" type="submit" name="ajouter">Modifier</button>
				    </div>
				</div>
	        </div>
        </form>
	</div>
	<?php  
	}
include 'layout/footer.php';?>