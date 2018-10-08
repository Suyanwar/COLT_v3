$(document).ready(function(){
	if(window.addEventListener){
		window.addEventListener("load", loaded, false);
	}else if(window.attachEvent){
		window.attachEvent("onload", loaded);
	}else if(document.getElementById){
		window.onload = loaded;
	}
	
	$(window).resize(setup);
});
function iFresponse(st, id){
	setTimeout(function(){
		window.location.reload();
	}, 1500);
}
function base_url(id){
	return base_urls + id;
}
function site_url(id){
	return site_urls + id;
}
function loaded(){
	setup();
	$("#page-container").css({"display":"block"});
	$("#uname").focus();
}
function setup(){
	$("#login").css({"margin-top": ($(window).height() - 321) / 2 +"px", "margin-bottom":"10px"});
}
function iFlogin_s(){
	$("#iflogin_r").html('<div style="padding:4px 0 5px"><img src="'+ base_url('static/i/login.gif') +'" alt="Please wait.." title="Please wait.."></div>').fadeIn(function(){ $("#iflogin_s").attr("disabled", "disabled") });
	$("#iflogin_f").ajaxSubmit({
		success:function(response){
			$("#iflogin_r").html(response);
			$("#iflogin_s").removeAttr("disabled");
		},
		timeout:(60 * 1000),
		error:function(response){
			$("#iflogin_r").html('<div class="error-box">'+ response.status +' - '+ response.statusText +'</div>');
			$("#iflogin_s").removeAttr("disabled");
		}
	});
	return false;
}