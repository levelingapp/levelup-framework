<?php require_once("application/views/snippets/layout/header.php"); ?>

<div id="content">

	<div class="steps_wrapped">
		<h1>Personalize your profile</h1>
		
		<div>
			<img id="loading_profile" src="<?php echo PATH; ?>images/assets/progress_bar.gif" />
		</div>
		<div class="upload_pic_step" id="wrapped_upload_profile_pic" style="margin-right: 20px;">
			<img src ="<?php echo PATH; ?>images/assets/profile-icon.png" />
			<p>Upload Profile Picture</p>
		</div>
		<form  action="<?php echo PATH; ?>application/controller/ajaxController/a_upload_profile_pic.php" method="post" enctype="multipart/form-data" id="upload_profile_pic_form">
			<input type="file" class="upload_file" name="upload_profile_pic" id="upload_profile_pic"/>
			<select id="image_type" name="image_type" style="display:none;">
				<option value="profile"></option>
				<option value="cover"></option>
			</select>
		</form>
		
		
		<div class="upload_pic_step" id="wrapped_upload_bg_pic" style="float: right">
			<img src ="<?php echo PATH; ?>images/assets/cover-icon.png" />
			<p>Upload Cover Picture</p>
		</div>
		<form  action="<?php echo PATH; ?>controller/ajaxController/dsd.php" method="post" enctype="multipart/form-data" id="upload_bg_pic_form">
			<input type="file" class="upload_file" name="upload_bg_pic" id="upload_bg_pic"/>
		</form>
		<div class="clear"></div>
		
		<div class="upload_bio">
			<p>Tell us a little about you</p>
			<textarea placeholder="Tell us a little about you" id="small_bio" name="small_bio"></textarea>
		</div>
		
		
		<div class="join_menu_bottom">
			<a href="#" class="do_it_later">May be I'll do this later</a>
			<a class="btns" id="step1_submit">Next</a>
		</div>
		
		<div class="clear"></div>
		
	</div>
	
</div>

<?php require_once("application/views/snippets/layout/footer.php"); ?>