/** APP: Ajax Image uploader with progress bar
    Website:packetcode.com
    Author: Krishna TEja G S
    Date: 29th April 2014
***/

$(function(){
	 
	 // function from the jquery form plugin
	 $('#myForm').ajaxForm({
	 	beforeSend:function(){
	 		 $(".progress").show();
	 	},
	 	uploadProgress:function(event,position,total,percentComplete){
	 		$(".progress-bar").width(percentComplete+'%'); //dynamicaly change the progress bar width
	 		$(".sr-only").html(percentComplete+'%'); // show the percentage number
	 	},
	 	success:function(){
	 		$(".progress").hide(); //hide progress bar on success of upload
	 	},
	 	complete:function(response){
	 		if(response.responseText=='0')
	 			$(".image").html("Error"); //display error if response is 0
	 		else
	 			$(".image").html("<img src='../modul/upload/"+response.responseText+"' width='100%'/>");
			$(".info").html("<div class='error-page'><div class='error-content text-center' style='margin-left: 0;'><h3><i class='fa fa-info-circle text-primary'></i> Anda Sudah Login </h3><p>Silahkan Refresh Halaman ini!<br><br><a class='tabReload btn btn-primary' href=''/javascript:refreshTab();'/'>Refresh</a></p></div></div>");
	 			// show the image after success
	 	}
	 });

	 //set the progress bar to be hidden on loading
	 $(".progress").hide();
});