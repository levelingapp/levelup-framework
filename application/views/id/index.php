<?php 
require_once("application/views/snippets/layout/header.php"); 
?>
<div class="cover-profile">
	<div class="profile-image-cover" data-cover_image="<?php echo $pathCover; ?>">
		<img src="<?php echo PATH . "images/me.jpg"; ?>"/>
	</div>
	
	<div class="name-profile-cover">
		<h3>lord_luisv</h3>
	</div>
</div>

<div id="content" class="no-top-pad">
	<h1>Profile</h1>

</div>

<?php require_once("application/views/snippets/layout/footer.php"); ?>