//For ajax request 
jQuery(document).ready(function(){
	//var my_json_str = php_params.plugin_info.replace(/&quot;/g, '"');
	//var my_php_arr = jQuery.parseJSON(my_json_str);

	jQuery(".save-post").click(function(){
		var url_string = window.location.href
		var url = new URL(url_string);
		var post_id = url.searchParams.get("post");
		var post_title = $(".post-title").html();
        var post_content = $(".post-content").html();
		//var data = [post_title, post_content];

		$.ajax({
			url: '../wp-content/plugins/particle-studio/admin/template/post_save.php',
			method: 'POST',
			beforeSend: function(){
				$("#loading").css("display", "block");
			},
			data: {
					'post_id': post_id,
					'post_title': post_title,
					'post_content':post_content
				},
			crossDomain: true,
			success: function() {
                //console.log(post_content);
				message("Post save successfully");
			},
			complete: function(){
				$("#loading").css("display", "none");
			},
			error: function( error ) {
				console.log( error );
			}
		});
	});

	jQuery(".left-sidebar").click(function(){
		var length_check = document.getElementById("leftSidebar").style.width.length;
		if(length_check > 0){
			closeLeftSidebar();
		} else {
			openLeftSidebar();
		}
	});

	
});

function message(msg) {
	var x = document.getElementById("message");
	x.innerHTML = msg;
	x.className = "show";
	setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
}

function openLeftSidebar() {
	document.getElementById("leftSidebar").style.width = "250px";
	document.getElementById("main").style.marginLeft = "250px";
  }
  
  function closeLeftSidebar() {
	document.getElementById("leftSidebar").style.width = null;
	document.getElementById("main").style.marginLeft= null;
  }


$(".para-bar").click(function (e) { 
	e.preventDefault();
	let length_check = document.getElementById("paraArea").style.height.length;
	if(length_check > 0){
		closeParaBar();
	} else {
		openParaBar();
	}
});

function openParaBar() {
	document.getElementById("paraArea").style.height = "28px";
  }
  
function closeParaBar() {
	document.getElementById("paraArea").style.height = null;
}

var tg_fs_value = $(".visual-editor").css("font-size");
var tg_padd_value = $(".visual-editor").css("padding");
var tg_mar_value = $(".visual-editor").css("margin");
var tg_bor_value = $(".visual-editor").css("border");
var tg_al_value = $(".visual-editor").css("text-align");
var tg_col_value = $(".visual-editor").css("color");
var tg_bg_value = $(".visual-editor").css("background");
$(".tg-fs").val(tg_fs_value);
$(".tg-pad").val(tg_padd_value);
$(".tg-mar").val(tg_mar_value);
$(".tg-bor").val(tg_bor_value);
$(".tg-al").val(tg_al_value);
$(".tg-col").val(tg_col_value);
$(".tg-bg").val(tg_bg_value);



$(".tg-fs").on("change", function(){
	var cur_tg_fs_value = $(".tg-fs").val();
	$(".visual-editor").css("font-size", cur_tg_fs_value);
});

$(".tg-pad").on("change", function(){
	var cur_tg_pad_value = $(".tg-fs").val();
	$(".visual-editor").css("padding", cur_tg_pad_value);
});

$(".tg-mar").on("change", function(){
	var cur_tg_mar_value = $(".tg-mar").val();
	$(".visual-editor").css("margin", cur_tg_mar_value);
});

$(".tg-bor").on("change", function(){
	var cur_tg_bor_value = $(".tg-bor").val();
	$(".visual-editor").css("border", cur_tg_bor_value);
});

$(".tg-al").on("change", function(){
	var cur_tg_al_value = $(".tg-al").val();
	$(".visual-editor").css("text-align", cur_tg_al_value);
});

$(".tg-col").on("change", function(){
	var cur_tg_col_value = $(".tg-col").val();
	$(".visual-editor").css("color", cur_tg_col_value);
});

$(".tg-bg").on("change", function(){
	var cur_tg_bg_value = $(".tg-bg").val();
	$(".visual-editor").parent().css("background", cur_tg_bg_value);
});

// hover effect start

$(".visual-editor *").mouseover(function() {
	$(this).css("border","1px dashed blue");
	$(this).click(function(){
		$(this).css("border","1px solid blue");
	});
}).mouseout(function() {
    $(this).css("border","none");
});
// hover effect end


// end istiyak amin

$('.visual-editor')[0].style.visibility = 'visible';
		//$('.editor-container').height($('.editor-container').height()-28);

class ParticleStudioController {
	
	hideAllEditors(){
		$('.visual-editor')[0].style.visibility = 'hidden';
		$('.html-editor')[0].style.visibility = 'hidden';
		$('.css-editor')[0].style.visibility = 'hidden';
		$('.js-editor')[0].style.visibility = 'hidden';
		$('.visual-editor')[0].style.display = 'none';
		$('.html-editor')[0].style.display = 'none';
		$('.css-editor')[0].style.display = 'none';
		$('.js-editor')[0].style.display = 'none';
	}

	
	setup(){
		$('#sidebar-bottom-icon-left-menu').on('click', function(e){
			//alert ("what?");
		});

		$('#sidebar-bottom-icon-visual-editor').on('click', function(e){
			this.hideAllEditors();
			$('.visual-editor')[0].style.display = 'block';
			$('.visual-editor')[0].style.visibility = 'visible';
		});

		$('#sidebar-bottom-icon-html-editor').on('click', function(e){
			this.hideAllEditors();
			$('.html-editor')[0].style.display = 'block';
			$('.html-editor')[0].style.visibility = 'visible';
		});

		$('#sidebar-bottom-icon-css-editor').on('click', function(e){
			this.hideAllEditors();
			$('.css-editor')[0].style.display = 'block';
			$('.css-editor')[0].style.visibility = 'visible';
		});

		$('#sidebar-bottom-icon-js-editor').on('click', function(e){
			this.hideAllEditors();
			$('.js-editor')[0].style.display = 'block';
			$('.js-editor')[0].style.visibility = 'visible';
		});


		$("#context-menu a").on("click", function(e) {
			//e.preventDefault();
			//e.stopPropagation();
			$(this).parent().removeClass("show").hide();
			//alert(e.target);
			ctlr.contextMenuItemHandler(e);
			console.log(e.target.toString());
		});
		
		// this.rebindEvents();				
	}
}		



$(document).ready(function() {
	
	

	ctlr = new ParticleStudioController();
	ctlr.setup();

	/*
	history.save();
	*/
});


