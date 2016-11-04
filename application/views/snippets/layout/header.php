<!DOCTYPE html>
<html>
<head>	
    <!-- Meta tags -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta content="<?php echo $this->header->get_meta_description(); ?>" name="Description" />
    <meta content="<?php echo $this->header->get_tags(); ?>" name="Keywords" />
    <?php echo $this->header->get_index_robots();?>

    <!-- Link Tags -->
    <link media="screen" href="<?php echo PATH; ?>styles/style.css" type="text/css" rel="stylesheet" />
    <link rel="shortcut icon" href="<?php echo PATH; ?>images/assets/favicon.ico" type="image/x-icon" />
    <link rel="apple-touch-icon" href="images/logo.png">
    <link rel="image_src" href="Logo.jpg" />

    <!-- Javascript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="http://www.google.com/recaptcha/api/js/recaptcha_ajax.js"></script>
    <script src ="<?php echo PATH; ?>js/iframe-post.js" type = "text/javascript" > </script>
    <script src ="<?php echo PATH; ?>js/javascript.js" type = "text/javascript" > </script>
    <!-- Adding script library for unity -->
    <script type="text/javascript" src="<?php echo PATH; ?>js/unityobject.js"></script>

    <!-- title -->
    <title><?php echo $this->header->get_title(); ?></title>

    <!-- Open Graph Meta tags -->
    <meta property="og:title" content="<?php echo $this->header->get_title_property(); ?>" />
    <meta property="og:type" content="games" />
    <meta property="og:url" content="<?php echo $this->header->get_url_property(); ?>" />
    <meta property="og:image" content="http://www.levelingapp.com/image/assets/Logo.jpg" />
    <meta property="og:site_name" content="<?php echo $this->header->get_site_name(); ?>" />
    <meta property="og:description" content="<?php echo $this->header->get_property_description(); ?>" />

    <script type="text/javascript">

    </script>

	
</head>

<body>



<!-- Next script is for facebook api -->
<div id="fb-root"></div>
<script>
	(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=187587693815";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));
</script>

<!-- Wrapp the entire header -->
<div id="header_wrap">
	<div id="header">
		<!-- Logo -->
		<div id="logo">
		<?php
			//Check if is login to show Navigation menu
			if($this->session->is_loged_in()){
				$logoPath = PATH . $this->session->user_nick();
			}
			else{
				$logoPath = PATH;
			}
		?>
			<a class="logoButton" href="<?php echo $logoPath; ?>" title="Home">Leveling App</a>
		</div>
		
		<!-- Menu -->
		<div id="main_menu">
			<ul id="navigation">
				<li id="1"><a class="gamesButton"  title="Games">Games</a>
					<ul class="naviagtion_tab">
						<li class="tatos">
							<div id="game_tab"> 
								
								<div id ="game_tab_title">CATEGORIES</div>
								
								<div id ="game_tab_left">
									<div class="game_category_list"><a href="<?php echo PATH; ?>games/category/action/" title="Action" >Action</a></div>
									<div class="game_category_list"><a href="<?php echo PATH; ?>games/category/multiplayer/" title="Multiplayer" >Multiplayer</a></div>
									<div class="game_category_list"><a href="<?php echo PATH; ?>games/category/shooter/" title="Shooter" >Shooter</a></div>
									<div class="game_category_list"><a href="<?php echo PATH; ?>games/category/adventure/" title="Adventure & RPG" >Adventure & RPG</a></div>
									<div class="game_category_list"><a href="<?php echo PATH; ?>games/category/strategy/" title="Strategy & Defense" >Strategy & Defense</a></div>
									<div class="game_category_list"><a href="<?php echo PATH; ?>games/category/puzzle/" title="Puzzle / Jigsaw" >Puzzle / Jigsaw</a></div>
									<div class="game_category_list"><a href="<?php echo PATH; ?>games/category/music/" title="Music / Rhyhm" >Music / Rhyhm</a></div>
									<div class="game_category_list"><a href="<?php echo PATH; ?>games/category/tutorials/" title="Tutorials" >Tutorials</a></div>
									<div class="game_category_list"><a href="<?php echo PATH; ?>games/category/mmo/" title="MMO" >MMO</a></div>
								</div>
								
								<div id ="game_tab_right">
									<div class="game_category_list"><a href="<?php echo PATH; ?>games/category/arcade/" title="Arcade" >Arcade</a></div>
									<div class="game_category_list"><a href="<?php echo PATH; ?>games/category/sports/" title="Sports" >Sports</a></div>
									<div class="game_category_list"><a href="<?php echo PATH; ?>games/category/board/" title="Board" >Board</a></div>
									<div class="game_category_list"><a href="<?php echo PATH; ?>games/category/casino/" title="Casino" >Casino</a></div>
									<div class="game_category_list"><a href="<?php echo PATH; ?>games/category/racing/" title="Driving / Racing" >Driving / Racing</a></div>
									<div class="game_category_list"><a href="<?php echo PATH; ?>games/category/custumize/" title="Dress up / Custumize" >Dress up / Custumize</a></div>
									<div class="game_category_list"><a href="<?php echo PATH; ?>games/category/fighting/" title="Fighting" >Fighting</a></div>
									<div class="game_category_list"><a href="<?php echo PATH; ?>games/category/education/" title="Education" >Education</a></div>
									<div class="game_category_list"><a href="<?php echo PATH; ?>games/category/webcam/" title="Web cam" >Web cam</a></div>
								</div>
								<div class="clear"></div>
							</div>
						</li>
					</ul>
				</li>
	
		
				<li id="2"><a class="alertsButton" title="Buzz">Buzz</a>
					<ul class="naviagtion_tab">
						<li><a href="#">test alert button</a></li>
					</ul>
				
				</li>
				<li id="3"><a class="achievementsButton"  title="Achievements">Achievements</a></li>
				<li id="4"><a class="commentsButton"  title="Comments">Comments</a></li>
				<li id="5"><a class="friendsButton"  title="Friends">Friends</a></li> 

			</ul>
		</div>
		
		
		<?php
			//Check if is login to show Navigation menu
			if($this->session->is_loged_in()){
		?>
		<!-- Textbox  serch bar-->
		<div class="textbox">
			<form>
			<div id="search_bar">
					<input id="search" type="text" name="search" value= "" placeholder="Search"/>	
			</div>
			
			<div id="submmit_button">
				<!-- <input id="go" type="submit" name="go" value="GO" /> -->
				<!-- <img src="<?php echo PATH; ?>images/assets/lupa.png" /> -->
				<input id="go" type="submit" class="search_button" name="go" value="" />
			</div>
			</form>
		</div>
		
		<!-- Wrapp 3 columns for Text -->
		<div id ="wrap_text">	
			<div id="hp_text">
				HP
			</div>
			<div id="mp_text">
				MP
			</div>
			
			<div id="st_text">
				ST
			</div>
		</div>
		
		<!-- Wrapp 3 columns for graphs -->
		<div id="graphs">

			<div class="gray_bar">
				<div id="hp">
				&nbsp;
				</div>
			</div>

			<div class="gray_bar">
				<div id="mp">
				&nbsp;
				</div>
			</div>
			
			<div class="gray_bar">
				<div id="st">
					&nbsp;
				</div>
			</div>
		</div>
		
		<!-- Humilation Meter -->
		<div id="header_meter">
			<img src="<?php echo PATH; ?>images/assets/meter.png" width="36" height="36" title="humiltion meter"/>
		</div>

		<!-- Profile Image -->
		<div id="profile_image">
			<a href="<?php echo PATH . $this->session->user_nick(); ?>"><img src="<?php echo PATH; ?>images/assets/profile_image.png" width="34" height="34" title="Profile" border="0"/></a>
		</div>
				
		<div id="header_separate">
		
		</div>
		<!-- Settings -->
		<div id="settings">
			<ul id="navigation_settings">
				<li id="settings1"><a class="settingsButton"  title="Settings">Settings</a>
					<ul class="naviagtion_tab_settings">
						<li>
							<div id="option_settings">
								<form name ="logOut_form" id="logOut_form" method="post" action ="<?php echo $this->currentPage; ?>">
									<input type="submit" class="logoutButton" name="submitted_login" value="Log Out" />
								</form>
							</div>
						</li>
					</ul>
				</li>
			</ul>
			
		</div>
		
		<?php
		} //end if
		//Login
		else{
			
		?>

		<div id="header_right">

			<div id="header_login">
			
				<div class="header_buttons">
					<a href="<?php echo PATH; ?>join/" class="headerButtons" >Sign up</a>
					<a id="loginHeaderButton" class="headerButtons" >Login</a>
				</div>
				
				<div class="header_login_input">
					<form name ="header_form" id="header_form" method="post" action ="<?php echo $this->currentPage; ?>">
						Email: <input type="email" name="header_email" class="input_login_header" id="email_login" /> &nbsp;
						Password: <input type="password" name="header_password" class="input_login_header" id="password_login" />
						<input type="submit" name="header_submit" class="button_header" value ="Log In" />
					</form>
					
					
					<div class="bellowButtons">
						<div id="forgot_pass_header2">
							<a  href="<?php echo PATH; ?>forgot/">Forgot your password?</a>
						</div>
						
						<div id="signUp_header2">
							<a href="<?php echo PATH; ?>join/">Sign Up for Free</a>
						</div>
					</div>
					
					
					
				</div>
				<div class="clear"></div>
				
			</div> <!-- header_login DIV END -->
		
		
			<div id="bellowButtonsID" class="bellowButtons">
				<div id="forgot_pass_header">
					<a id="show_popup"  href="<?php echo PATH; ?>forgot/">Forgot your password?</a>
				</div>
				
				<div id="signUp_header">
					<a href="<?php echo PATH; ?>join/">Sign Up for Free</a>
				</div>
			</div>
			
		</div>
		
		<div class="clear"></div>
		<?php
		
		} //end else
		?>

	</div> <!-- DIV ENDS Header1 -->

</div> <!-- DIV ENDS Header2 -->

<div id="container">

