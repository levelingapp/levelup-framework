 <?php require_once("application/views/snippets/layout/header.php"); ?>

<div id="content">

<div class="title_game">
<h1><?php echo $this->name; ?></h1>
</div>


<!-- Flash Object Goes Here -->
<div id ="game_content">
	<?php 
		$this->embededGames->execute($this->type);
	?>
</div> <!-- game_content DIV ENDS -->


<div id="game_wrap">
	<div id="game_information">
	
		<div class="buttons_game_wrap">
			<div id="game_buttons">
				<?php
				/*
				//NOT READY FOR LAUNCH
				<a id="add_button"  title="Add <?php echo $this->name; ?> to your favorite games">Add</a>
				<a id="bug_button"  title="Report a bug or bad behavior">Bug</a>
				<a id="flag_button" title="Flag <?php echo $this->name; ?> game">Flag</a>
				*/
				?>
				<a id="share_button"  title="Share <?php echo $this->name; ?> game">Share</a>
			</div>
			
			<div id= "played">
				<span style="font-size: 14px; font-family: corbel, arial;">Played</span> <?php echo number_format($this->counter); ?>
			</div>
			<div class="clear"> </div>
		</div>

		
		<div id ="game_share">
			<!-- Facebook button-->
			<div class="fb-like" data-href="http://www.levelingapp.com" data-send="true" data-layout="button_count" data-width="100" data-show-faces="false"></div>
			<!-- twitter button -->
			<a href="https://twitter.com/share" class="twitter-share-button" data-url="http://www.levelingapp.com">Tweet</a>
			<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
			<!--google plus button-->
			<!-- Place this tag where you want the +1 button to render -->
			<g:plusone href="http://www.levelingapp.com"></g:plusone>

			<!-- Place this render call where appropriate -->
			<script type="text/javascript">
			  (function() {
				var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
				po.src = 'https://apis.google.com/js/plusone.js';
				var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
			  })();
			</script>
		</div>
		
		<div id="description_wrap">
		
			<div id="image_game_view_wrap">
				<div id="image_game_view">
					<img src ="<?php echo PATH; ?>images/game_icons/thumbs/delete.png" />	
				</div>
			</div>
		
			<div id="game_posted_wrap">
				<div id="profile_image_game">
					<a href="#"><img src="<?php echo PATH; ?>images/assets/profile_image.png" width="34" height="34" title="Profile" border="0" /></a>
				</div>

				<div id="profile_posted_game">
					Posted by <a href="<?php echo PATH; ?><?php echo $this->postedBy; ?>"><?php echo $this->postedBy; ?></a> <br />
					Posted on <?php echo $this->postedOn; ?>
				</div>
				
			</div>
			<div id="game_description">
				<?php 
					echo "<h2> Description </h2>\n";
					
					echo $this->description; 
					echo "<br /><br />";
					echo "<h2> Instructions </h2>\n";
					echo $this->instructions; 
				?>
				<div class="game_tags">
					Category: <?php echo $this->category; ?> <br />
					Tags: <?php echo $this->tags; ?>
				</div><!-- game_tags DIV ENDS -->
			</div><!-- game_description DIV ENDS -->
			
			<div id="description_button">
				<a id="description_button_image"><img id= "image_description" src="<?php echo PATH; ?>images/assets/button_description_down.png" border="0" /></a>
			</div>
		</div><!-- description_wrap DIV ENDS -->
		
		
		
		
		<h3 class="total_comments">Comments (<?php echo $totalOfComments; ?>)</h3>
		<div id="games_comments_container">
	
			<?php
			$last_comm = "";
			while($game_comm_row = $game_comm_query->fetch()){
			?>
			<div class="game_comment_wrapp">
				<div class="game_comment_img offline">
					<img src="<?php echo PATH; ?>images/assets/image_profile_62_62.jpg" />
				</div>
				<div class="game_comment_content">
					<h3><?php echo $game_comm_row['user_fname'] . " " . $game_comm_row['user_lname']; ?></h3>
					<?php echo $game_comm_row['game_comm_message']; ?>
					<div class="game_comment_date">12/31/2009</div>
				</div>
				<div class="clear"></div>
			</div>
			
			<?php
			$last_comm = $game_comm_row['game_comm_id'];
			}
			if($per_page < $total_count){
			?>
				<div id="load_more_comm_games" data-game_id="<?php echo $game_id; ?>" data-page= "2" data-last_comm= "<?php echo $last_comm; ?>" class="game_comment_wrapp load_more_comm_games">
					Show more comments	
				</div>
			<?php
			}
			?>
			
			
			<?php
			//Check if is login to show Navigation menu
			if($this->session->is_loged_in()){
			?>
			
				<div class="game_comment_wrapp game_insert_comments">
					<div class="game_comment_img offline">
						<img src="<?php echo PATH; ?>images/assets/image_profile_62_62.jpg" />
					</div>
					<div class="game_comment_content">
						<h3><?php echo $game_comm_row['user_fname'] . " " . $game_comm_row['user_lname']; ?></h3>
						<textarea  class="textarea_game_comments" placeholder="Write a comment..." data-game_id="<?php echo $game_id; ?>"  data-last_comm= "<?php echo $last_comm; ?>"></textarea>
					</div>
					<div class="clear"></div>
				</div>
			
			<?php
			}
			else{
				//dont show
			?>
				
			<?php
			}
			?>
			
			
			<!--
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
			-->
			
			
		</div>
		 

		
	</div><!-- game_information DIV ENDS -->
	
	
	<div id="game_advertise">
		<?php require_once("application/views/snippets/ads/250x250.php"); ?>
	</div>
</div><!-- game_wrap DIV ENDS -->

<div class="clear"> </div>

</div><!-- Div Content ENDS -->

<?php require_once("application/views/snippets/layout/footer.php"); ?>