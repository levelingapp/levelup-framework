<div id="footer">
	LEVELING APP &copy; <?php echo date("Y"); ?>

	<div id="footer_links">
		<a href="<?php echo PATH; ?>about/" title="" >About</a> &#183; 
		<a href="<?php echo PATH; ?>advertising/" title="Advertise on Leveling App" >Advertising</a> &#183; 
		<a href="<?php echo PATH; ?>developers/" title="Develope on our API" >Developers</a> &#183; 
		<a href="<?php echo PATH; ?>terms/" title="Please read these terms of use carefully" >Terms</a>  &#183; 
		<a href="<?php echo PATH; ?>careers/" title="Level up your career" >Careers</a>  &#183; 
		<a href="<?php echo PATH; ?>privacy/" title="Learn about your privacy policy" >Privacy</a>  &#183;  
		<a href="<?php echo PATH; ?>help/" title="The most frequently asked questions" >Help</a>
	</div>

</div> <!-- DIV ENDS footer -->

</div> <!-- DIV ENDS CONTAINER -->

<!-- Call javascript -->
<script type="text/javascript">
$(document).ready(function(){
	load();
});
</script>

</body>
</html>
<?php
	//close connection just in case
	$this->connection->close_connection();
?>
