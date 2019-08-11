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

// end istiyak amin


var history;
var ctlr;
var isDragStarted = false;
var el;
var clipboard = {};
var lastContextMenuEventTarget;
var currentContextMenuEventTarget;

class ParticleStudio{

}

class ParticleStudioModel{


}

class ParticleStudioView{

}

class ParticleStudioTemplate{

}

class ParticleStudioController {
	constructor() {
	}
	/*

	// Adding a method to the constructor
	greet() {
		return `${this.name} says hello.`;
	}
	*/
	init(){
		$('.visual-editor')[0].style.visibility = 'visible';
		$('.editor-container').height($('.editor-container').height()-28);

	}


	onDragExit(e) {
		e.preventDefault(); // ?
		$(e.target).removeClass("selectElement");
	}

	onDragLeave(e) {
		e.preventDefault(); // ?
		$(e.target).removeClass("selectElement");
	}

	onDragOver(e) {
		e.preventDefault(); // ?
		$(e.target).addClass("selectElement");
	}

	onDragEnter(e) {
		e.preventDefault(); // ?
		$(e.target).addClass("selectElement");
	}

	onDragStart(e) {
		//e.preventDefault(); //DON'T use e.preventDefault()!!!
		//ev.dataTransfer.setData("text", e.target.id);
		if(e.eventPhase != Event.AT_TARGET){
			return;
		}

		$(e.target).removeClass("highlightElement");
		e.dataTransfer.setData("html", e.target.outerHTML);
		//e.dataTransfer.setData("sourceElement", e.target);
		el = e.target; // SAVE to delete through onDrop
		//e.stopPropagation();

		console.log(e.target.toString());
	}

	onDrop(e) {
		e.preventDefault(); //OKAY
		if (e.target === el){
			$(e.target).removeClass('selectElement');
			return;
		}
		e.stopPropagation();

		$(e.target).removeClass('selectElement')
		
		// delete first, so that element IDs (if any) are's duplicated.
		$(el).remove();

		var data = e.dataTransfer.getData("html");
		var any = document.createElement('template'); // is a node
		any.innerHTML = data;
		e.target.appendChild(any.content);

		history.save();

		console.log(e.target.toString());

	}
	
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

	/*
	$('#undo').click(function() {
		history.undo(setEditorContents);
	});
	$('#redo').click(function() {
		history.redo(setEditorContents);
	});
	$('#editor').keypress(function() {
		history.save();
	});
	*/
	contextMenuItemHandler(e){
		switch (e.target.innerText){
			case "Undo":
				//history.undo(setEditorContents);
				document.execCommand('undo',false,'');
				break;
			case "Redo":
				//history.redo(setEditorContents);
				document.execCommand('redo',false,'');
				break;
			case "Cut":
				clipboard.action = "Cut";
				clipboard.target = currentContextMenuEventTarget;
				break;
			case "Copy":
				clipboard.action = "Copy";
				clipboard.target = currentContextMenuEventTarget;
				break;
			case "Paste (Append)":
				var any = document.createElement('template'); // is a node
				any.innerHTML = clipboard.target.outerHTML;
				currentContextMenuEventTarget.appendChild(any.content);

				switch(clipboard.action){
					case "Cut":
						$(clipboard.target).remove();
						break;
					case "Copy":	
						break;
				}
				//history.save();
				clipboard.action = null;
				clipboard.target = null;
				break;
			case "Paste (Replace)":
				var any = document.createElement('template'); // is a node
				any.innerHTML = clipboard.target.outerHTML;
				$(currentContextMenuEventTarget).html(any.content);

				switch(clipboard.action){
					case "Cut":
						$(clipboard.target).remove();
						break;
					case "Copy":	
						break;
				}
				//history.save();
				clipboard.action = null;
				clipboard.target = null;
				break;
			case "Remove":
				$(currentContextMenuEventTarget).remove();
				//history.save();
				break;
			default:
				break;
		}

	}

	
	rebindEvents(){
		var element = document.querySelector('.visual-editor');
		element.addEventListener('dragenter', this.onDragEnter, false);
		element.addEventListener('dragleave', this.onDragLeave, false);
		element.addEventListener('dragover', this.onDragOver, false);
		element.addEventListener('dragexit', this.onDragExit, false);
		element.addEventListener('dragstart', this.onDragStart, false);
		element.addEventListener('drop', this.onDrop, false);

		var elements = document.querySelectorAll('.visual-editor *');
		for (var i = 0; i < elements.length; i++) {
			$(elements[i]).attr('draggable', "true");

			elements[i].addEventListener('dragenter', this.onDragEnter, false);
			elements[i].addEventListener('dragleave', this.onDragLeave, false);
			elements[i].addEventListener('dragover', this.onDragOver, false);
			elements[i].addEventListener('dragexit', this.onDragExit, false);
			elements[i].addEventListener('dragstart', this.onDragStart, false);
			elements[i].addEventListener('drop', this.onDrop, false);

			$(elements[i]).on('contextmenu', function(e) {
				//e.preventDefault();
				//e.stopPropagation();
				var top = e.pageY - 10;
				var left = e.pageX - 90;
				$("#context-menu").css({
					display: "block",
					top: top,
					left: left
				}).addClass("show");
				lastContextMenuEventTarget = currentContextMenuEventTarget;
				currentContextMenuEventTarget = e.target;
				return false; //blocks default Webbrowser right click menu
			}).on("click", function(e) {
				//e.preventDefault();
				//e.stopPropagation();
				$("#context-menu").removeClass("show").hide();
			});
		}
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

		$(".visual-editor").on("mouseover", function(e){
			var el = $(e.target);
			el.addClass("highlightElement");
		});
		
		$(".visual-editor").on("mouseout", function(e){
			var el = $(e.target);
			el.removeClass("highlightElement");
		});
		
		$(".visual-editor *").on("mouseover", function(e){
			var el = $(e.target);
			el.addClass("highlightElement");
		});
		
		$(".visual-editor *").on("mouseout", function(e){
			var el = $(e.target);
			el.removeClass("highlightElement");
		});
		
		
		$(".visual-editor *").on("click", function(e){

		});
		
		$(".visual-editor *").on("mousedown", function(e){
			//e.traget.parentNode.removeChild(e.target);
			//document.removeElement(e.target);
			//var el = $(e.target);
			//el.attr('draggable="true"');
			//var h = el.height(), w = el.width();
			//el.height(h-2); el.width(w-2);
			//el.style.marginLeft -= 1px;
			//el.style.marginRight -= 1px;
			//el.style.marginTop -= 1px;
			//el.style.marginBottom -= 1px;
		});
		
		$(".visual-editor *").on("mouseup", function(e){
			//var el = $(e.target);
			//el.attr('draggable="false"');
			//var h = el.height(), w = el.width();
			//el.height(h+2); el.width(w+2);
			//el.style.marginLeft += 1px;
			//el.style.marginRight += 1px;
			//el.style.marginTop += 1px;
			//el.style.marginBottom += 1px;
		});



		$("#context-menu a").on("click", function(e) {
			//e.preventDefault();
			//e.stopPropagation();
			$(this).parent().removeClass("show").hide();
			//alert(e.target);
			ctlr.contextMenuItemHandler(e);
			console.log(e.target.toString());
		});
		
		this.rebindEvents();				
	}
}		


/**
* SimpleUndo is a very basic javascript undo/redo stack for managing histories of basically anything.
*
* options are: {
* 	* `provider` : required. a function to call on `save`, which should provide the current state of the historized object through the given "done" callback
* 	* `maxLength` : the maximum number of items in history
* 	* `onUpdate` : a function to call to notify of changes in history. Will be called on `save`, `undo`, `redo` and `clear`
* }
*
*/
(function() {

	'use strict';

	var SimpleUndo = function(options) {

		var settings = options ? options : {};
		var defaultOptions = {
			provider: function() {
				throw new Error("No provider!");
			},
			maxLength: 30,
			onUpdate: function() {}
		};

		this.provider = (typeof settings.provider != 'undefined') ? settings.provider : defaultOptions.provider;
		this.maxLength = (typeof settings.maxLength != 'undefined') ? settings.maxLength : defaultOptions.maxLength;
		this.onUpdate = (typeof settings.onUpdate != 'undefined') ? settings.onUpdate : defaultOptions.onUpdate;

		this.initialItem = null;
		this.clear();
	};

	function truncate (stack, limit) {
		while (stack.length > limit) {
			stack.shift();
		}
	}

	/*

	SimpleUndo.prototype.initialize = function(initialItem) {
		this.stack[0] = initialItem;
		this.initialItem = initialItem;
	};


	SimpleUndo.prototype.clear = function() {
		this.stack = [this.initialItem];
		this.position = 0;
		this.onUpdate();
	};

	SimpleUndo.prototype.save = function() {
		this.provider(function(current) {
			if (this.position >= this.maxLength) truncate(this.stack, this.maxLength);
			this.position = Math.min(this.position,this.stack.length - 1);

			this.stack = this.stack.slice(0, this.position + 1);
			this.stack.push(current);
			this.position++;
			this.onUpdate();
		}.bind(this));
	};

	SimpleUndo.prototype.undo = function(callback) {
		if (this.canUndo()) {
			var item =  this.stack[--this.position];
			this.onUpdate();

			if (callback) {
				callback(item);
			}
		}
	};

	SimpleUndo.prototype.redo = function(callback) {
		if (this.canRedo()) {
			var item = this.stack[++this.position];
			this.onUpdate();

			if (callback) {
				callback(item);
			}
		}
	};

	SimpleUndo.prototype.canUndo = function() {
		return this.position > 0;
	};

	SimpleUndo.prototype.canRedo = function() {
		return this.position < this.count();
	};

	SimpleUndo.prototype.count = function() {
		return this.stack.length - 1; // -1 because of initial item
	};

	*/



	//exports
	// node module
	if (typeof module != 'undefined') {
		module.exports = SimpleUndo;
	}

	// browser global
	if (typeof window != 'undefined') {
		window.SimpleUndo = SimpleUndo;
	}

})();

/*****************************************/

function updateButtons() {
	if(ctlr) 
		ctlr.rebindEvents();

	if (!history)
		return; 
	
	/*
	if(history.canUndo()){
		$('#historyUndo').removeClass("disabled");
	}
	else{
		$('#historyUndo').addClass("disabled");
	}
	if(history.canRedo()){
		$('#historyRedo').removeClass("disabled");
	}
	else{
		$('#historyRedo').addClass("disabled");
	}
	*/

}

function setEditorContents(contents) {
	//$('#editor').val(contents);
	$('.visual-editor').html(contents);
}



$(document).ready(function() {
	/*
	history = new SimpleUndo({
		maxLength: 200,
		provider: function(done) {
			done($('.visual-editor').html());
		},
		onUpdate: function() {
			//onUpdate is called in constructor, making history undefined
			
			updateButtons();
		}
	});
	*/

	/*			
	$('#undo').click(function() {
		history.undo(setEditorContents);
	});
	$('#redo').click(function() {
		history.redo(setEditorContents);
	});
	$('#editor').keypress(function() {
		history.save();
	});
	*/
	

	ctlr = new ParticleStudioController();
	ctlr.init();
	ctlr.setup();

	updateButtons();
	/*
	history.save();
	*/
});



// Drag and Drop start
dragula([document.getElementById('leftSidebar'), document.getElementById('postContent')], {
	copy: function (el, source) {
	  return source === document.getElementById('leftSidebar')
	},
	accepts: function (el, target) {
	  return target !== document.getElementById('leftSidebar')
	}
  }); 
// Drag and Drop end


