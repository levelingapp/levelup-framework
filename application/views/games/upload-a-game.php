<?php require_once("application/views/snippets/layout/header.php"); ?>


<div id="content">
	<div id="uploadGame01Wrap">
		<div class="uploadGame01Header">
			Add a Game
		</div>
		
		<div id="uploadGame01">
			<form action="<?php echo PATH;?>games/upload-a-game/" method="post" enctype="multipart/form-data">

				<div class="spaceHeightUploadGame">
					<div class="spaceWidth">Game display name:</div> 
					<div class="floatLeft">
						<input type="text" name="name" class="inputUploadGame" />
					</div>
				</div>
				<div class="clear"> </div>
				<div class="spaceHeightUploadGame">
					<div class="spaceWidth">Type of Upload:</div> 
					<div class="floatLeft"> 
						<input type="radio" name="uploadType" value="1" checked="checked" id="uploadType1" /> <label for="uploadType1">Upload a Game</label><br /><br />
						<input type="radio" name="uploadType" value="2"  id="uploadType2" /> <label for="uploadType2"> Embed a Game </label><br /><br />
						<input type="radio" name="uploadType" value="3"  id="uploadType3" /> <label for="uploadType3"> Canvas Page (IFrame)</label>
					</div>
				</div>
				
				<div class="clear"> </div>
				
				<div class="spaceHeightUploadGame">
					<div class="floatRight"> 
						<input type = "submit" value ="Next Step >" class="nextButton" name="submitted" />
					</div>
				</div>
			</form>
			<div class="clear"> </div>
		</div>
		
	</div>
	<div class="clear"> </div>

</div> <!-- END DIV CONTENT -->

<?php require_once("application/views/snippets/layout/footer.php"); ?>