<?php require_once("application/views/snippets/layout/header.php"); ?>

<div id="content">
<div id="header_profile">

	<!-- wrap_image_profile -->
	<div id = "wrap_image_profile">
		<div id="profile_image_84"><img src="<?php echo PATH ?>images/assets/image_profile_84_84.jpg" title="name goes here" /></div>
		
		<div id="emblem_profile">
			<img id="emblem_profile_image" src="<?php echo PATH; ?>images/assets/emblem.png" title = "emblem's name goes here"/>
		</div>
	</div>
	
	
	<!-- Profile -->
	<div id="wrap_msg_profile">
		<div id="msg">
			<form>
				<textarea id ="msg_post"><?php echo $this->share; ?></textarea>
				<div id="profile_button"><input type="submit" value="Shout!" class="button" /></div>
			</form>
		</div>
		
		<div id="stats_profile">
			Level: <span style="font-size: 25px">1</span>  Points: <span style="font-size: 25px">50</span>
		</div>
	</div>
	
	<!-- Humilation Meter -->
	<div id="wrap_humilation_profile">
		<div id="humilation_profile">
			<img src="<?php echo PATH; ?>images/assets/humiliation_profile.png" title = "humilation meter"/>
		</div>
		
		<div id="humilation_text">
			Humilation: <span style="font-size: 25px">30%</span>
		</div>
	</div>
	
	
	
	<!-- Wrapp 3 columns for Text -->
	<div id ="wrap_text_profile">	
		<div id="hp_text_profile">
			HP
		</div>
		<div id="mp_text_profile">
			MP
		</div>
		
		<div id="st_text_profile">
			ST
		</div>
	</div>
	
	
	
	<!-- Graphs Meter -->
	
	<div id="graphs_profile">
		<div class="gray_bar_profile">
			<div id="hp_profile">
			&nbsp;
			</div>
		</div>

		<div class="gray_bar_profile">
			<div id="mp_profile">
			&nbsp;
			</div>
		</div>
		
		<div class="gray_bar_profile">
			<div id="st_profile">
				&nbsp;
			</div>
		</div>
	</div>
	
	
	<div class="clear"> </div>

	
</div><!-- div header_profile END -->
<div class="user_content">
	<div class="content_profile_left">
		
		<ul class ="profile_menu">
			<li><h1>GAMES PLAYED</h1></li>
	
			<li><h1>GAME DEVELOPER</h1>
				<ul>
					<?php
					while($userGameRow = $this->userGameQuery->fetch()){
					?>
					<li>
						<a href="<?php echo PATH . "games/" . $userGameRow['game_id'] . "/"; ?>" title = "<?php echo $userGameRow['game_name']; ?>">
						<?php 
								$subtitle = $userGameRow['game_name'];
								echo substr($subtitle, 0, 20);
								
								if(strlen($subtitle) >= 20){
									echo "...";
								}
						?>
						</a>
					</li>
					<?php
					}
					?>
					<li><a href="<?php echo PATH; ?>games/upload-a-game/" >Upload a Game</a></li>
				</ul>
			</li>
		</ul>
	</div>

	<div class="content_profile_center">
	
	
	
		<div id="games_comments_container">
			<div class="game_comment_wrapp">
				<div class="game_comment_img offline">
					<img src="<?php echo PATH; ?>images/assets/image_profile_62_62.jpg" />
				</div>
				<div class="game_comment_content">
					<h3>Luis Vazquez</h3>
					This games is awesome!! wwerf wewe we we bwf lwekf f web wf w we fheiowhfoweh hewohee herewrw wehruwer werwe rwe rwerwqr werwe rwe rewr wer werwe rwe\ew
					rwerewr e rewr er ere rer erwrwerwert rtetr ret rettwe ret ew er 
				</div>
				<div class="clear"></div>
			</div>
			
			<div class="game_comment_wrapp">
				<div class="game_comment_img online">
					<img src="<?php echo PATH; ?>images/assets/image_profile_62_62.jpg" />
				</div>
				<div class="game_comment_content">
					<h3>Luis Vazquez</h3>
					This games is awesome!!
				</div>
				<div class="clear"></div>
			</div>
			
			<div class="game_comment_wrapp">
				<div class="game_comment_img onGame">
					<img src="<?php echo PATH; ?>images/assets/image_profile_62_62.jpg" />
				</div>
				<div class="game_comment_content">
					<h3>Luis Vazquez</h3>
					This games is awesome!!
				</div>
				<div class="clear"></div>
			</div>
			
			<div class="game_comment_wrapp">
				<div class="game_comment_img away">
					<img src="<?php echo PATH; ?>images/assets/image_profile_62_62.jpg" />
				</div>
				<div class="game_comment_content">
					<h3>Luis Vazquez</h3>
					This games is awesome!!
				</div>
				<div class="clear"></div>
			</div>
		</div>
	
	
	</div>


	<div class="content_profile_right">
	Hello world3
	</div>
	<div class="clear"></div>
</div>


</div>

<?php require_once("application/views/snippets/layout/footer.php"); ?>