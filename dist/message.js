/**
 * Message.js
 *
 * Free jquery plugin to display a message at the top of the browser
 *
 * @package Message.js
 * @author Muhamad Nauval Azhar
 * @link www.nauvalazhar.net
 * @license MIT License
 *
 * Copyright (C) 2016 Muhamad Nauval Azhar
 */

/**
 * @param  array	 content 	information message to be displayed
 * @return html
 *
 * Example:
 * ========
 * message({
 * 	id: "my_message",
 *  text: "i am message",
 *  type: "error", // error, success, warning, info
 *  autohide: false, //false or true
 *  hide: function(){
 * 		alert('the message is closed')
 *  }
 * })
 */
function message(content) {
		switch(content.type) {
			case 'error':
				type = "error";
				icon = "fa fa-exclamation-circle";
			break;
			case 'warning':
				type = "warning";
				icon = "fa fa-warning";
			break;
			case 'success':
				type = "success";
				icon = "fa fa-check";
			break;
			case 'info':
				type = "info";
				icon = "fa fa-info-circle";
			break;
			default:
				type = "info";
				icon = "fa fa-info-circle";
			break;
		}

		var element = "";
		element += '<div class="message '+ type +'">';
		element += '<div class="message-content">';
		element += '<div class="message-icon">';
		element += '<i class="'+ icon +'"></i>';
		element += '</div>';
		element += '<div class="message-title">'+content.text+'</div>';
		element += '<div class="message-dismiss"><i class="fa fa-close"></i></div>';
		element += '</div>';
		element += '</div>';

		var ID = content.id;
		if(!content.id) {
			ID = "message-box";
		}

		$("#"+ID).remove();
		$("body").append($("<div/>", {
			id: ID
		})
		.html(element));			

		if(content.autohide !== false) {
			setTimeout(function(){
				close_dialog();
				content.hide.call();
			},5000);
		}

		$("#"+ID+" .message-dismiss").click(function(){
			close_dialog();
		})

		var close_dialog = function() {
			$("#"+ID).fadeOut(function(){
				$("#"+ID).remove();
			});
		}
}
