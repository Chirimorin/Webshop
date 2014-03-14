    </div> <!-- /container -->
    
    <script type="text/javascript">
        var link = window.location.href;
        link = link.replace(/\:/g, "%3A");
        link = link.replace(/\//g, "%2F");
        link = link.replace(/\?/g, "%3F");
        link = link.replace(/\=/g, "%3D");
        link = link.replace(/\&/g, "%26");
        
        var link = "http://validator.w3.org/check?uri=" + link;
        $("#html5check").attr("href", link);
    </script>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    
	<script src="js/cart.js"></script>
    <script src="js/functions.js"></script>
    <script src="js/bootstrap.min.js"></script>
	
  </body>
</html>
