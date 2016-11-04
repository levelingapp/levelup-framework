<?php 
//require header
require_once("application/views/snippets/layout/header.php"); 
?>

<div id="content">

<div id="uploadGame01Wrap">
	<div id="gameUploadHeader">
		<div id="gameUploadHeaderImage">
			<img src="<?php echo PATH; ?>images/assets/game_icon2.png" />
		</div>
		
		<div id="gameUploadHeaderInfo">
			<h1><?php  echo $this->name;?></h1>
				
			<form action="<?php echo PATH;?>games/edit-a-game/" method="post" enctype="multipart/form-data">
			<div class="fm-item">
				<input type="file" name="icon" id="upload-file" />
			</div>
			<div class="fm-item">
				<button type="submit" id="upload-button">(edit Icon)</button><br />
				<span id="file-name"></span>
			</div>

		</div>
		<div class="clear"></div>
	</div>

		<div id="uploadGame01">
			<div id = "upload_game_wrap">
			
				<?php
				if(isset($this->msg)){
				?>
					<div id="error_message_upload">
						<p><?php echo $this->msg; ?></p>
					</div>
				<?php
				}
				?>
			
				<div class="uploadGame01Header">
					Game Information
				</div>
			<!-- here form -->
				<div class= "uploadGameFormContent">
			
						<input type="hidden" name="typeUpload" value="<?php echo $this->uploadType; ?>" />

						<div class="spaceHeight">
							<div class="spaceWidth">Game display name:</div> 
							<div class="floatLeft">
								<input type="text" name="name" class="inputUploadGame" value="<?php echo $this->name;?>" />
								<input type="hidden" name="uploadType" value="<?php echo $this->uploadType;?>" />
							</div>
						</div>
						
						<div class="spaceHeightTextArea">
							<div class="spaceWidth">Game description:</div> 
							<div class="floatLeft"> 
								<textarea class="uploadGameText" name="description"><?php if (isset($this->description)) { echo $this->description; }?></textarea>
							</div>
						</div>
						
						<div class="spaceHeightTextArea">
							<div class="spaceWidth">Game Instructions:</div> 
							<div class="floatLeft"> 
								<textarea class="uploadGameText" name="instructions" ><?php if (isset($this->instructions)) { echo $this->instructions; } ?></textarea>
							</div>
						</div>
						
						
						<div class="spaceHeight">
							<div class="spaceWidth">Game category:</div> 
							<div class="floatLeft"> 			
								<select class ="input" name="category">
									<option value="">Select Category</option>
									<?php
										while($game_row_categories  = mysql_fetch_assoc($this->game_query_categories)){
												if($_POST['category'] == $game_row_categories['game_category_id']) {
												$selected = 'selected = "selected"';
											}
											else{
												$selected = "";
											}
									?>
									<option value="<?php echo $game_row_categories['game_category_id']; ?>" <?php echo $selected; ?>><?php echo $game_row_categories['game_category_title']; ?></option>
									<?php
										}
									?>
								</select>
							</div>
						</div>
								
						<div class="spaceHeight2">
							<div class="spaceWidth">Game tags:</div> 
							<div class="floatLeft"> 
								<input type="text" name="tags" class="inputUploadGame" value="<?php if (isset($this->tags)) { echo $this->tags; }?>" /><br />
								<span class="side_comment">*Separate tags by commas</span>
							</div>
						</div>

						
						<?php
							if($this->uploadType == "1"){
						?>
						
						
							<div class="spaceHeight">
								<div class="spaceWidth">Game type:</div> 
								<div class="floatLeft"> 
									<select class ="input" name="type">
										<option value="">Select Type</option>
										<?php
											while($row_type = mysql_fetch_assoc($this->query_type)){
												if($_POST['type'] == $row_type['game_type_id']) {
													$typeSelected = 'selected = "selected"';
												}
												else{
													$typeSelected = "";
												}
										?>
										<option value="<?php echo $row_type['game_type_id']; ?>" <?php echo $typeSelected; ?>><?php  echo $row_type['game_type_title'];  ?></option>
										<?php
											}
										?>
									</select>
								</div>
							</div>
						
							<div class="spaceHeight">
								<div class="spaceWidth">Upload game:</div> 
								<div class="floatLeft"> 
									<input type="file" name="gameFile" class="inputUploadGame" />
								</div>
							</div>
							
							<div class="spaceHeight">
								<div class="spaceWidth">Game height:</div> 
								<div class="floatLeft"> 
									<input type="text" name="height" class="inputUploadGameSize" value="<?php if (isset($this->height)) { echo $this->height; } ?>" maxlength="3" />
								</div>
							</div>
							
							<div class="spaceHeight">
								<div class="spaceWidth">Game width:</div> 
								<div class="floatLeft"> 
									<input type="text" name="width" class="inputUploadGameSize" value="<?php if (isset($this->width)) { echo $this->width; } ?>" maxlength="3" />
									<span class="side_comment">*maximum Width 800px</span>
								</div>
							</div>
						<?php
							}
							else if($this->uploadType == "2"){
						?>
							<div class="spaceHeightTextArea">
								<div class="spaceWidth">Paste your embeded code:</div> 
								<div class="floatLeft"> 
									<textarea class="uploadGameText" name="embededCode"><?php if (isset($_POST['embededCode'])) { echo $_POST['embededCode']; } ?></textarea>
								</div>
							</div>
						<?php
							}else if($this->uploadType == "3"){
						?>
							<div class="spaceHeight">
								<div class="spaceWidth">Paste your URL canvas site:</div> 
								<div class="floatLeft"> 
									<input type="url" name="canvasUrl" class="inputUploadGame"  value="<?php if (isset($_POST['canvasUrl'])) { echo $_POST['canvasUrl']; } ?>" />
								</div>
							</div>
							
							<div class="spaceHeight">
								<div class="spaceWidth">Game height:</div> 
								<div class="floatLeft"> 
									<input type="text" name="height" class="inputUploadGameSize" maxlength="3" value="<?php if (isset($this->height)) { echo $this->height; } ?>" />
								</div>
							</div>
							
							<div class="spaceHeight">
								<div class="spaceWidth">Game width:</div> 
								<div class="floatLeft"> 
									<input type="text" name="width" class="inputUploadGameSize" maxlength="3" value="<?php if (isset($this->width)) { echo $this->width; } ?>" />
								</div>
							</div>
						<?php
							}
						?>			
						
						<div class="spaceHeight">
							<div class="spaceWidth">Is it visible?</div> 
							<div class="floatLeft">
								<input type="checkbox" name="isVisible" id="checkboxEmbedVisible" class="imageCheckBox" checked="checked"/>
								<img id = "isVisible" class="checkboximg" src= "../../images/assets/yes.png"/>
							</div>
						</div>
						
						<div class="clear"></div>
					
				
				</div>
				
				<div class="uploadGame01Header">
					Company Information
				</div>
				
				<div class= "uploadGameFormContent">
				
					<div class="spaceHeight">
						<div class="spaceWidth">Name of your company:</div>
						<div class="floatLeft"> 
							<input type="text" name="company" class="inputUploadGame" value="<?php if (isset($_POST['company'])) { echo $_POST['company']; } ?>" />
						</div>
					</div>
					
					<div class="spaceHeight">
						<div class="spaceWidth">Web site URL:</div>
						<div class="floatLeft"> 
							<input type="url" name="companyUrl" class="inputUploadGame" value="<?php if (isset($_POST['companyUrl'])) { echo $_POST['companyUrl']; } ?>" />
						</div>
					</div>
					
					<div class="spaceHeight">
						<div class="spaceWidth">&nbsp;</div>
						<div class="floatLeft"> 
							<input type="submit" name="submitted_02" class="button" value ="Upload Your Game"/>
						</div>
					</div>
					
						
				
				</div>
				</form>	
				<div class="clear"> </div>

			</div><!--upload_game_wrap END --> 
		</div> <!--uploadGame01 END -->
	</div> <!-- uploadGame01Wrap END -->
</div> <!-- DIV ENDS Content -->

<?php
//require footer
require_once("application/views/snippets/layout/footer.php");
?>