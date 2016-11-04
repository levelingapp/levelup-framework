	//******************************************************************************************************
	//		SLIDER
	//******************************************************************************************************
	//Initialize variables
	var id = 0;
	var newcount = 1;
	var intervalId = "";
	var startDate = new Date().getTime();  
	var diff = 0;
	var rotationTime = 3000;
	var vid = 1;
	var isRotating = true;

//When load javascript
function load(){

	/**************************************************************************************/
	// pop up center
	/**************************************************************************************/
	
	
	(function ( $ ) {
	
		
		$.fn.popup = function(options){
			
			// This is the easiest way to have default options.
			var settings = $.extend({
				// These are the defaults.
				title: "Title goes here",
				description: "The Content of the popup goes here",
				button1: false,
				button1_id: "button1_id",
				button1_legend: "button1_legend",
				button2: false,
				button2_id: "button2_id",
				button2_legend: "button2_legend",
				form_id: "form_id",
			}, options );

			
			
			var htmlButtons = "";
			if(settings.button1){
				htmlButtons = '<button id="' + settings.button1_id + '">' + settings.button1_legend + '</button>';
			}
			
			if(settings.button2){
				htmlButtons += '<button id="' + settings.button2_id + '">' + settings.button2_legend + '</button>';
			}
			
			if( !$(".popup_wrapped_bg").is(":visible") ){
				$("body").prepend('<div class="popup_wrapped_bg">' + 
					'<form class="form_popup" method="POST" action="" id="' + settings.form_id + '">' + 
					'<div class="popup_wrapped">' + 
						'<h3>' + settings.title  + '</h3>' + 
						'<div class="popup_content">' + 
						settings.description  +
						'</div>' + 
						'<div class="popup_wrapped_footer">' + 
						htmlButtons +  '<button id="closePopUp">Cancel</button>' + 
						'</div>' + 
					'</div>' + 
					'</form>' +
				'</div>');
				
				$(".popup_wrapped_bg").show();
				
				$(".popup_wrapped").center4(false);
				
				$(".popup_wrapped_bg").center2(false);
	
			}

			
			$("body").on("click" , "#closePopUp" , function(e){
				$(".popup_wrapped_bg").remove();
			});
			
			$("body").on("click" , ".popup_wrapped_bg" , function(e){
				if( e.target == this ){
					$(".popup_wrapped_bg").remove();
				}
			});
			

		};
		
	}( jQuery ));
	

	
	$("#show_popup").click(function(){
	

			$.fn.popup({
				title: "Are You A Human Or A NPC?",
				description: "<p>Please enter the characters displayed in the image</p><div class='captcha-error'></div><div id='recaptcha_div'></div>",
				button1: true,
				button1_id: "btn_popup_submit",
				button1_legend: "Submit",
				form_id: "popup_form"
			});
			
			
			showRecaptcha('recaptcha_div');

		
		return false;
	});



	$.fn.center = function(parent) {
		if (parent) {
			parent = this.parent();
		} else {
			parent = window;
		}
		this.css({
			"position": "absolute",
			"top": ((($(parent).height() - this.outerHeight()) / 2) + $(parent).scrollTop() + "px"),
			"left": ((($(parent).width() - this.outerWidth()) / 2) + $(parent).scrollLeft() + "px")
		});
		return this;
	}	
	
	
	
	$.fn.center3 = function(parent) {
		if (parent) {
			parent = this.parent();
		} else {
			parent = window;
		}
		this.css({
			"position": "fixed",
			"top": ((($(parent).height() - this.height()) / 2) + $(parent).scrollTop() + "px"),
			"left": ((($(parent).width() - this.width()) / 2) + $(parent).scrollLeft() + "px")
		});
		return this;
	}


	
	$.fn.center2 = function(parent) {
		if (parent) {
			parent = this.parent();
		} else {
			parent = window;
		}
		this.css({
			"position": "fixed",
			"left": ((($(parent).width() - this.outerWidth()) / 2) + $(parent).scrollLeft() + "px")
		});
		return this;
	}
	
	
	$.fn.center4 = function(parent) {
		if (parent) {
			parent = this.parent();
		} else {
			parent = window;
		}
		this.css({
			"position": "fixed",
			"top": ((($(parent).height() - this.height()) / 2) + "px"),
			"left": ((($(parent).width() - this.outerWidth()) / 2) + $(parent).scrollLeft() + "px")
		});
		return this;
	}
	
	
	$( window ).resize(function() {
		$(".popup_wrapped_bg").center3(false);
		$(".popup_wrapped").center3(false);
	});
	
	
	
	$( window ).scroll(function() {
		$(".popup_wrapped_bg").center2(false);
		$(".popup_wrapped").center2(false);
	});
		

	/**************************************************************************************/
		
	
	$("#loginHeaderButton").click(function(){
		$(".header_buttons, #bellowButtonsID").hide();
		$(".header_login_input").show();
	});

	
	


	$('#email_login').focus();
	
	
	
	//recaptcha
	$( "body" ).on( "submit", "#popup_form", function() {

		$.post("../application/controller/ajaxController/a_recaptchaCodeClient.php",$(this).serialize(),function(result){
		
			var obj = jQuery.parseJSON(result);
			
				if(obj.status == "success"){
				
					$.post("../application/controller/ajaxController/a_signup.php",$("#register_form").serialize(),function(result_form){
				
						var obj_form = jQuery.parseJSON(result_form);
						
						if(obj_form.response == "success"){
							
							window.location.href = "http://levelingapp.com/join/step1/";
							
						}else{
							
							alert("Error: " + obj_form.message);
							
						}
						console.log(result_form);
					});

				}else{
					$(".captcha-error").addClass("error_captcha");
					$(".captcha-error").html("Inccorrect captacha please try again.");
				}
				
		});
		
		
		return false;
	});


	//********************************************************************
	// Textarea
	//********************************************************************
	/*$("textarea").keypress(function(){
		var auto_expand = $(this).data("auto_expand");
		
		if(auto_expand){

			
			var rows = $(this).attr("rows");
			var cols = $(this).attr("cols");
			
			rows = parseInt(rows);
			cols = parseInt(cols);
			
			if($(this).data("cols") != undefined){
				console.log("no empty");
				var data_cols = $(this).data( "cols");
				data_cols = parseInt(data_cols);
			}else{
				$(this).data( "cols", cols);
				var data_cols = cols;
				data_cols = parseInt(data_cols);
				console.log(" empty");
			}
			
			
			var value = $(this).val();
			var valueLength = value.length;
			
			
			if(valueLength <= cols){
				$(this).attr("rows", 1);
				$(this).data( "cols", cols);
			}
			
			if(valueLength >= data_cols){
				
				var newHeight = rows + 1;
				
				var new_data_cols = cols * newHeight;
				$(this).attr("rows", newHeight);
				$(this).data( "cols", new_data_cols );
				console.log("data: " + new_data_cols);
			}
			
			
			
			
		}
	});
	*/
	
	$(".textarea_game_comments").focus(function(){
		$(this).css({"height":"60px"});
	});
	

	//********************************************************************
	// SIGN UP SUBMIT FORM
	//********************************************************************
	$( "body" ).on( "submit", "#register_form", function(){

		var error = false;

		
		if($('#email').val() != $('#confirm_email').val()){
			$('#email, #confirm_email').css({'border': '1px solid #e46c6d', 'background-color': '#f8dbdb'});
			error = true;
		}
		
		
		if( !isValidEmail($('#email').val() ) ){
			$('#email').css({'border': '1px solid #e46c6d', 'background-color': '#f8dbdb'});
			error = true;
		}			
		
		
		if(!isValidEmail($('#confirm_email').val()) ){
			$('#confirm_email').css({'border': '1px solid #e46c6d', 'background-color': '#f8dbdb'});
			error = true;
		}

		
		if( !isValidNick($('#nick').val()) ){
			$('#nick').css({'border': '1px solid #e46c6d', 'background-color': '#f8dbdb'});
			error = true;
		}
	
		
		if($("#fname").val().length == ""){
			$("#fname").css({'border': '1px solid #e46c6d', 'background-color': '#f8dbdb'});
			error = true;
		}
		
		if($("#lname").val().length == ""){
			$("#lname").css({'border': '1px solid #e46c6d', 'background-color': '#f8dbdb'});
			error = true;
		}
		
		if($("#password").val().length == ""){
			$("#password").css({'border': '1px solid #e46c6d', 'background-color': '#f8dbdb'});
			error = true;
		}
		
		if($("#day").val().length == ""){
			$("#day").css({'border': '1px solid #e46c6d', 'background-color': '#f8dbdb'});
			error = true;
		}
		
		if($("#month").val().length == ""){
			$("#month").css({'border': '1px solid #e46c6d', 'background-color': '#f8dbdb'});
			error = true;
		}
		
		if($("#year").val().length == ""){
			$("#year").css({'border': '1px solid #e46c6d', 'background-color': '#f8dbdb'});
			error = true;
		}
		
		if($("#sex").val().length == ""){
			$("#sex").css({'border': '1px solid #e46c6d', 'background-color': '#f8dbdb'});
			error = true;
		}
		
	
		if(!checkNick($('#nick').val())){
			error = true;
		}
		
		
		if(!checkEmail($('#email').val())){
			error = true;
		}
		
		if(error){
			return false;
		}else{
			
			
			$.fn.popup({
				title: "Are You A Human Or A NPC?",
				description: "<p>Please enter the characters displayed in the image</p><div class='captcha-error'></div><div id='recaptcha_div'></div>",
				button1: true,
				button1_id: "btn_popup_submit",
				button1_legend: "Submit",
				form_id: "popup_form"
			});
			showRecaptcha('recaptcha_div');
			
			return false;
		}
		
		
		
		
		
	});
	
	
	function isValidEmail(str) {
		str = str.toLowerCase();
		regEmail = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
		var emailPattern=new RegExp(regEmail);
		return emailPattern.test(str);  
	}
	
	
	function isValidNick(str){
		str = str.toLowerCase();
		regNick = /^([a-z0-9_%-]+)$/;
		var emailPattern = new RegExp(regNick);
		return emailPattern.test(str);  
	}
	
	
	

	$('#login_form').submit(function(){
		var error = false;
		$(this).find(":input").each(function() {
			
			if($(this).val().length == 0){
				$(this).css({'border': '1px solid #e46c6d', 'background-color': '#f8dbdb'});
				error = true;
				//$(this).focus();
			}else{
				if($(this).val() != "Submit"){
				$(this).css({'border': '1px solid #abadb3', 'background-color': 'white'});
				}
			}
		});
		if(error){
			return false;
		}
		return true;
		
	});
	
	
	
	
	//**************************************************************************************
	//	GAME SECTION
	//**************************************************************************************
	
	//Share button
	$("#share_button").click(function(){

		$("#game_share").slideToggle();
	});
	
	
	//Game's Description
	var maxheight = $("#game_description").height();
	var height = minHeight = 32;
	$("#game_description").css({'height': minHeight+'px'});
	
	$("#description_button_image").click(function(){

		if(height == minHeight){
			height = maxheight;
			$("#game_description").animate({'height': height+'px'}, 1000, 'swing', function (){
				$("#image_description").attr("src", "../../images/assets/button_description_up.png");
			});
		}
		else{
			height = minHeight;
			$("#game_description").animate({'height': height+'px'}, 1000, 'swing', function(){
				$("#image_description").attr("src", "../../images/assets/button_description_down.png");
			});
			

		}

	});
	//**************************************************************************************
	
	
		
	//**************************************************************************************
	//	PROFILE MSG SECTION
	//**************************************************************************************	
	//$("#msg_post").val("What are you playing?");
	if($("#msg_post").val() != "What are you playing?"){
		$("#msg_post").css({'color' : '#282828' , 'font-size' : '13px'});
	}
	
	
	$("#msg_post").focus( function(){
		$(this).css({'color' : '#282828' , 'font-size' : '13px'});
		if($("#msg_post").val() == "What are you playing?"){
			$(this).val("");
		}
	});
	
	$("#msg_post").blur( function(){
		if($("#msg_post").val() == ""){
			$(this).css({'color' : '#CCCCCC', 'font-size': '20px'});
			$(this).val("What are you playing?");
			
		}
	});
	
	$("#profile_button").click( function(){
		 $('#msg_post').focus();
	});
	//**************************************************************************************
	
	//**************************************************************************************
	// upload a game
	//*************************************************************************************
	
	//Share button
	$("#isEmbededImg").click(function(){

		if($('#checkboxEmbed').is(":checked")){
			$(this).attr('src', "../../images/assets/no.png");
			$("#checkboxEmbed").removeAttr("checked");
			
			$("#uploadGameIsVisible").css({'display': 'block'});
			$("#embededCodeIsVisible").css({'display': 'none'});

		}
		else{
			$(this).attr('src', "../../images/assets/yes.png");
			$("#checkboxEmbed").attr("checked", "checked");
			$("#embededCodeIsVisible").css({'display': 'block'});
			$("#uploadGameIsVisible").css({'display': 'none'});
		}
	});
	
	//Is it visible
	$("#isVisible").click(function(){

		if($('#checkboxEmbedVisible').is(":checked")){
			$(this).attr('src', "../../images/assets/no.png");
			// make checkbox or radio checked
			$("#checkboxEmbedVisible").removeAttr("checked");
			//$("#checkboxEmbedVisible").attr("checked", "");
		}
		else{
			$(this).attr('src', "../../images/assets/yes.png");
			$("#checkboxEmbedVisible").attr("checked", "checked");
		}
	});
	
	
	
	//******************************************************************************************************
	//SHOW WINDOWS 
	//******************************************************************************************************
	
	/*$("#edit_icon_game").click(function(){

		$("#background_pop_up").toggle();
		
		var height = $(window).height();
		var width = $(document).width();
		
		$("#message_pop_up").css({
			'left' : width/2 - ($("#message_pop_up").width() / 2),  // half width - half element width
			'top' : height/2 - ($("#message_pop_up").height() / 2), // similar
			'z-index' : 100,                        // make sure element is on top
		});

		
		
		$("#message_pop_up").toggle();

	});
		
	//close the menu
	$("#close_opacity, #background_pop_up").click( function(){
	
		$("#background_pop_up").toggle();
		$("#message_pop_up").toggle();

	});
		*/
	
	//******************************************************************************************************

	$("#upload-file").addClass('hide-file');
	$("#upload-button").text("(edit icon)");
	$("#upload-button").click(function(){
		/*if($('#upload-file').val()){
			return true;
		}*/
		$("#upload-file").click()
		return false;
	});
	$("#upload-file").change(function(){
		var file = $('#upload-file').val();
		if(file){
			// fix on webkit, and IE
			file = file.substr(file.lastIndexOf("\\")+1);
			$("#file-name").text(file);
			$("#upload-button").text("Upload file");
			
			
			/*
			//ajax store image
			$.ajax({
			  type: "POST",
			  url: "../../../application/controller/ajaxController/test.php",
			  data: {name : value}
			}).done(function( msg ) {
			  alert( "Data Saved: " + msg );
			  $("#file-name2").text(msg);
			});
			*/
		}
	});
	
	//**************************************************************************************

	
	//**************************************************************************************
	//	HEADER SECTION
	//**************************************************************************************	
	$("#main_menu li, #settings li").click(function() {
	
		var select = $(this).children("ul");
		var check = $("#main_menu li, #settings li").children("ul");
		
		select.toggle();
		
		if( check.is(":visible") ){
			//alert("check visible");
			check.hide();
			if(select.is(":visible")){
				select.hide();
			}else{
				select.show();
			}
		}
	});

	
	$("#navigation, #navigation_settings").click(function(e) { //button click class name is myDiv
		e.stopPropagation();
	})

	
	//click something else
	$(document).click(function(){
		var check = $("#main_menu li, #settings li").children("ul");
		if( check.is(":visible") ){
			check.hide();
		}
	});
	
	
	
	
	
	//******************************************************************************************************
	//		SLIDER
	//******************************************************************************************************
		intervalId = setInterval("autoRotate()",rotationTime);


		//On click
		$("#button_slide_1, #button_slide_2, #button_slide_3").click(function () {

			var id = $(this).attr("id");
			vid = id.charAt( id.length-1 );
			
		  
			if(newcount != vid) {
				diff = new Date().getTime() - startDate;
				if(diff >= 1000) {
					clearInterval(intervalId);
					startDate = new Date().getTime();
					setTimeout(function() {
						intervalId = setInterval("autoRotate()", rotationTime);
					}, 0);
				}
				
				//remove old class
				var slideId = newcount;
				
				$("#content_"+slideId).hide();
				$("#button_slide_"+slideId).removeClass("active");
				
				//add new class
				newcount = vid;
				$("#content_"+vid).fadeIn("slow");
				$("#button_slide_"+vid).addClass("active");
			}
	  
		});
		
		$(".content, .button_slide").mouseenter(function(){
			//alert("9enter");
			isRotating = false;
		});
		
		$(".content, .button_slide").mouseleave(function(){
			isRotating = true;
		});
		

	
		
	
	
	
	//******************************************************************************************************
	//		Register check email
	//******************************************************************************************************
	$("#email").blur(function(){
		//alert("helo");
		var email = $("#email").val();
		
		checkEmail(email);
		
	}); 
	
	
	
	//******************************************************************************************************
	//		Register check nick
	//******************************************************************************************************
	$("#nick").blur(function(){
		//alert("helo");
		var nick = $("#nick").val();
		
		checkNick(nick);

	}); 
	
	//******************************************************************************************************
	
	
	
	

	
	$('.textarea_game_comments').keydown(function(e){
	    //alert(e.which);

	    if(e.keyCode == 13 && !e.shiftKey){
	        var value = $('.textarea_game_comments').val();
	        
	        var game_id = $(this).data("game_id");
	        var last_comm = $(this).data("last_comm");
	        
	        var thisTextArea = $(this);
	        
	        value = value.trim();
  		 	//alert(value);
  		 	//Insert comments
  		 	e.preventDefault();
  		 	
  		 	if(value != ""){
  		 		
  		 		$.post("../../application/controller/ajaxController/a_insertGameComment.php",{message:value,game_id:game_id, last_comm:last_comm}, function(result){

		  		 	var obj = jQuery.parseJSON(result);
		  		 	
		  		 	var appendComments = $('#load_more_comm_games');

				    if ( !appendComments.length){

			  		 	var toAppend = '<div class="game_comment_wrapp">' +
											'<div class="game_comment_img offline">' +
												'<img src="' + obj.img + '" />' +
											'</div>' +
											'<div class="game_comment_content">' +
												'<h3>' + obj.user + '</h3>' +
												obj.message +
												'<div class="game_comment_date">' + obj.date + '</div>' +
											'</div>' +
											'<div class="clear"></div>' +
										'</div>';
			  		 	
			  		 	$("#games_comments_container .game_insert_comments").before(toAppend);
		  		 	}
		  		 	//thisTextArea.css({"height": "20px"});
		  		 	thisTextArea.val("");
		  		 	
	  		 });
	  		 
  		 	}
	    }
	    
	});
	
	$("#load_more_comm_games").click(function (){
		var page = $(this).data("page");
		var game_id = $(this).data("game_id");

		var toAppend = "";
		$.post("../../application/controller/ajaxController/a_showGameComment.php",{page:page, game_id:game_id}, function(result){
			var obj = jQuery.parseJSON(result);
			
			console.log(obj[1].comments);
			
			$.each(obj[1].comments, function(key, value) {
				
				toAppend += '<div class="game_comment_wrapp">' +
										'<div class="game_comment_img offline">' +
											'<img src="' + value.img + '" />' +
										'</div>' +
										'<div class="game_comment_content">' +
											'<h3>' + value.user + '</h3>' +
											value.message +
											'<div class="game_comment_date">' + value.date + '</div>' +
										'</div>' +
										'<div class="clear"></div>' +
									'</div>';
			});
			
			
			$("#load_more_comm_games").before(toAppend);
			$("#load_more_comm_games").data("page", obj[0].page);
			
			if(obj[0].more == "false"){
				$("#load_more_comm_games").remove();
			}
			
		});
	});
		
	//upoad picture
	$("#wrapped_upload_profile_pic").click(function() {
	    
		$("#image_type").val('profile');
		$("#upload_profile_pic").trigger('click');
	    
	});
	
	
	//upoad picture
	$("#wrapped_upload_bg_pic").click(function() {
	    $("#image_type").val('cover');
		$("#upload_profile_pic").trigger('click');
	    
	});
	
	$("#upload_profile_pic").change(function(){
		$('#loading_profile').show(); 
		$('#upload_profile_pic_form').submit();
		
	});
	
	//upload a file via jquery using iframes
	$('#upload_profile_pic_form').iframePostForm({
       
        post: function() {
			$("#loading").show();
        },
        json: false,
        complete: function(response) {
			
			
			var obj = jQuery.parseJSON(response);
			
			
			$("#loading_profile").hide();
			
			if(obj.image_type == "profile"){
				$("#wrapped_upload_profile_pic").addClass("success_step");
				
				var image = obj.images[4].thumb_name;
				$("#profile_image img").attr("src", "http://levelingapp.com/images/user_icons/thumbs/" + image);
			}
			
			if(obj.image_type == "cover"){
				$("#wrapped_upload_bg_pic").addClass("success_step");
			}
			
    	}
	    
	});
	
	
	/* Join step1*/
	$("#step1_submit").click(function(){
		
		var bio = $("#small_bio").val();
	
		if(bio != ""){
			$.post("../../application/controller/ajaxController/a_updateSmallBio.php",{bio:bio}, function(result){

			});
			
		}else{
			alert("Please tell us a little about you");
		}
	
	
		return false;
	
	});
	
	
	
}
//********************************************************************************************************************************
//********************************************************************************************************************************
//********************************************************************************************************************************


function checkNick(nick){

	var check = true;

	$.post("../application/controller/ajaxController/a_checkNick.php",{nick:nick}, function(result){
		
		if(result == "true"){
			$('#nick').css({'border': '1px solid #94dc36', 'background-color': '#d0ecab'});
			$("#nick_width_taken, #nick_message").hide();
			check = true;
			
			if( $("#nick").val() == ""){
				$('#nick').css({'border': '1px solid #e46c6d', 'background-color': '#f8dbdb'});
				check = false;
			}
		}
		else{
			$('#nick').css({'border': '1px solid #e46c6d', 'background-color': '#f8dbdb'});
			
			$("#nick_message").html('*This username is already taken');
			$("#nick_width_taken, #nick_message").show();
			check = false;
		}
	});
	
	return check;

}

function checkEmail(email){

	var check = true;

	$.post("../application/controller/ajaxController/a_checkEmail.php",{email:email},function(result){
	
		if(result =="true"){
			$('#email').css({'border': '1px solid #94dc36', 'background-color': '#d0ecab'});
			$("#email_width_taken, #email_message").hide();
			check = true;
			
			if( $("#email").val() ==""){
				$('#email').css({'border': '1px solid #e46c6d', 'background-color': '#f8dbdb'});
				check = false;
			}
		}
		else{
			$('#email').css({'border': '1px solid #e46c6d', 'background-color': '#f8dbdb'});
			$("#email_message").html('*This email is already in our database');
			$("#email_width_taken, #email_message").show();
			check = false;
		}
	
	});
	
	return check;

}

//MAKE SURE TO CHECK BEFORE UPLOADING
function fillNoo(){
	
	var name = $("#fname").val();
	var length = name.length;
	$("#nooJ").val(length);
	
}


//autorotate function
function autoRotate() {

	if(isRotating){
		var lastTab = 3;
		
		if (newcount == lastTab) {
			newcount = 1;
		} else {
			newcount = parseInt(newcount) + 1;
		}
					
		for (var i=1; i <= lastTab; i++) {
			if(i != newcount) {
				$("#content_"+i).fadeOut(500, "swing", function(){
				
					$("#content_"+i).hide();
					
					//alert(i);
				});
				$("#button_slide_"+i).removeClass("active");
			}
			
			$("#button_slide_" + newcount).addClass("active");
			$("#content_" + newcount).fadeIn(500, "swing");
		};
	}
}



//recaptcha
function showRecaptcha(element) {
	Recaptcha.create("6LeuE-sSAAAAAAjZsfJPoxIv9hJRWBImjnvfQY5k", element, {
	theme: "clean",
	callback: Recaptcha.focus_response_field});
}


function displayRecaptcha(){
	$.fn.popup({
				title: "Are You A Human Or A NPC?",
				description: "<p>Please enter the characters displayed in the image</p><div id='recaptcha_div'></div>",
				button1: true,
				button1_id: "btn_popup_submit",
				button1_legend: "Submit",
				form_id: "popup_form"
			});
			
			
	showRecaptcha('recaptcha_div');	
	
}

	