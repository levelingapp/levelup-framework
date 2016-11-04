<?php
	require_once("application/views/snippets/layout/header.php");
	echo $this->header->get_meta_description();
?>
<div id="content">
<div id="game_slide">
		<!-- CONTENT 1 -->
		<div id="content_1" class="content" style="display: block;">
			<div id= "image_slide">
				<a href="#" title=""><img src = "images/assets/slide_game_big_03.jpg" alt="" /></a>
			</div>
			<div class="clear"> </div>
		</div>
		
		<!-- CONTENT 2 -->
		<div id="content_2" class="content" style="display: none;">
			<div id= "image_slide">
				<a href="#" title=""><img src = "images/assets/slide_game_big_02.jpg" alt="" /></a>
			</div>
			<div class="clear"> </div>
		</div>
		
		<!-- CONTENT 3 -->
		<div id="content_3" class="content" style="display: none;">
			<div id= "image_slide">
				<a href="#" title=""><img src = "images/assets/slide_game_big.jpg" alt="" /></a>
			</div>
			<div class="clear"> </div>
		</div>
		
		
		<!-- BUTTONS -->
		<div id="buttons_sider">
				<div id="button_slide_1" class="button_slide active"><img src="<?php echo PATH; ?>images/assets/slide_game_03.jpg" alt="" /></div>
				<div id="button_slide_2" class="button_slide"><img src="<?php echo PATH; ?>images/assets/slide_game_02.jpg" alt="" /></div>
				<div id="button_slide_3" class="button_slide"><img src="<?php echo PATH; ?>images/assets/slide_game_01.jpg" alt=""  /></div>
				<div class="clear"> </div>
		</div>
		<div class="clear"> </div>
		<!-- <img src="<?php echo PATH; ?>images/assets/slide_game.jpg" />-->
	</div>

	
	<?php
		if($this->session->is_loged_in()){
	?>
	<div id="advertise_home">
		<h1>Welcome to LEVELING APP</h1>
		<img src="<?php echo PATH; ?>images/assets/250x250.gif" />
	
	</div>
	<?php

		}// End  session is_loged_in
		else{
	?>
	
	<div id="join_home">
			<h1>Sign Up</h1>

			<?php
			if($pageController->msg != ""){

			?>
				<div class="error">
					<center><?php echo $msg; ?> </center>
				</div>

			<?php
			}
			?>
			<form name ="register_form" id="register_form" method="post" action ="<?php echo PATH; ?>">
				<div class="form_space">
				<div class="form_width" >First Name: </div>
				<div class="form_input" > <input type="text" name="fname" id="fname" class="input" value="<?php if (isset($_POST['fname'])) { echo $_POST['fname']; } ?>"  onkeyup="fillNoo()" placeholder="First Name" /></div>
				</div>
				
				<div class="form_space">
				<div class="form_width" >Last Name: </div><input type="text" name="lname" id="lname" class="input" value="<?php if (isset($_POST['lname'])) { echo $_POST['lname']; } ?>" placeholder="Last Name" />
				</div>
				
				<div class="form_space">
				<div class="form_width" >Levelingapp.com/: </div><input type="text" name="nick" id="nick" class="input" value="<?php if (isset($_POST['nick'])) { echo $_POST['nick']; } ?>" placeholder="Username" />
				<div class="form_width_taken" id="nick_width_taken" >&nbsp;</div><div class ="alert_taken" id="nick_message" >&nbsp;</div>
				</div>
				
				<div class="clear"></div>
				<div class="form_space">
				<div class="form_width" >Email: </div><input type="email" name="email" id="email" class="input" value="<?php if (isset($_POST['email'])) { echo $_POST['email']; } ?>" placeholder="Email" />
				<div class="form_width_taken" id="email_width_taken">&nbsp;</div><div class ="alert_taken" id="email_message" >&nbsp;</div> 
				</div>
				
				<div class="clear"></div>
				<div class="form_space">
				<div class="form_width" >Confirm Email: </div><input type="email" name="confirm_email" id="confirm_email" class="input" value="<?php if (isset($_POST['confirm_email'])) { echo $_POST['confirm_email']; } ?>" placeholder="Confirm Email" />
				</div>
				 
				<div class="form_space">
				<div class="form_width" >Password: </div><input type="password" name="password" id="password" class="input" value="" placeholder="Password" />
				</div>
				
				<div class="form_space">
					<div class="form_width" >
						Day of birth: 	
					</div>
				
					<select name="month" id="month" class="input_select">
						<option value="">Month</option>
						<?php
						for($m = 1; $m <= 12; $m++){
						if($m < 10){
							$m = "0".$m;
						}
						?>
						<option value="<?php echo $m; ?>"><?php echo $m; ?></option>
						<?php
						}
						?>
					</select>
					<select name="day" id="day" class="input_select">
						<option value ="">Day</option>
						<?php
						for($d = 1; $d <= 31; $d++){
						if($d < 10){
							$d = "0".$d;
						}
						?>
						<option value="<?php echo $d; ?>"><?php echo $d; ?></option>
						<?php
						}
						?>
					</select>
					<select name="year" id="year" class="input_select">
						<option value ="">Year</option>
						<?php
						$end = date("Y") - 106;
						$start = date("Y") - 13;
						
						for($y = $start; $y >= $end; $y--){

						?>
						<option value="<?php echo $y; ?>"><?php echo $y; ?></option>
						<?php
						}
						?>
					</select>
				</div>
				
				
				<div class="form_space">
				<div class="form_width" >Sex: </div>
					<select name="sex" id="sex" class="input_select">
						<option value="">Sex</option>
						<option value="Male">Male</option>
						<option value="Female">Female</option>
					</select>
				</div>
				
				<input type="text" name="nooB" id="nooB" class="noo" value="" />
				<input type="text" name="nooJ" id="nooJ" class="noo" value="" />
				
				<div id="button_register">
					<script language="javascript">
						<!--
						document.write('<input type="submit" name="submit_register" id="submit_register" class="buttonSign" value="Sign Up"/>');
						-->
					</script>
				</div>
				
				<div class="form_space">
					<noscript>
						<div class="enable_js">
							You need to enable Javascript
						</div>
					</noscript>
				</div>


						
			</form>
	</div><!-- End div Join_home -->
	<?php
		}// End  else
	?>
	<div class="clear"></div>

</div><!-- content ENDs -->

<?php
	require_once("application/views/snippets/layout/footer.php");
?>