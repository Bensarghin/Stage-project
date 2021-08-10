	<!-- MAIN FOOTER -->
	<div id="footer-copyright">
		<div class="container">
			&copy; Hamid Bensarghin | TDI 2018 - 2019
		</div>
	</div>

    <!-- END MAIN FOOTER -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/init.js"></script>
    <script src="assets/js/ajax.js"></script>
    <script type="text/javascript">
        function uploadFl (event) {
        var reader = new FileReader();
        reader.onload=function () 
        {  
            var output = document.getElementById('output');
            output.style.background ='url('+reader.result+')';
            output.style.backgroundSize ='cover';
        }
          reader.readAsDataURL(event.target.files[0]);
        };
    </script>
    </div>
  </body>
</html>
<?php  
ob_end_flush();
?>