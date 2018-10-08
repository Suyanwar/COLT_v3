$(document).ready(function(){
	if(window.addEventListener){
		window.addEventListener("load", loaded, false);
	}else if(window.attachEvent){
		window.attachEvent("onload", loaded);
	}else if(document.getElementById){
		window.onload = loaded;
	}
	
	$("#acc").hover(function(){
		$("#accounts").slideDown("fast");
	});
	
	$("#accounts").mouseleave(function(){
		$("#accounts").slideUp("slow");
	});
	
	$(window).resize(loaded);
});
$(document).keyup(function(e){
	if(e.keyCode == 27){
		if($(".close").length){
			report_close();
		}
	}
});
function iFresponse(st, id){
	if(st == 1){
		setTimeout(iFtimeout, 1000);
		$("#"+ id).fadeOut();
	}else if(st == 2){
		setTimeout(iFtimereload, 1000);
		$("#"+ id).fadeOut();
	}else if(st == 3){
		setTimeout(iFreferrer, 2000);
	}else if(st == 4){
		$("#"+ id).get(0).reset();
		$("#"+ id).slideDown();
	}
}
function iFtimeout(){
	setTimeout(function(){
		$(".ifclose").click();
	}, 2500);
}
function iFtimereload(){
	setTimeout(function(){
		window.location.reload();
	}, 1000);
}
function iFreferrer(){
	window.location.href = $("#reff").attr("href");
}
function iFtoggle(id){
	$("#"+ id).toggle();
}
function obj2json(obj){
	return JSON.stringify(obj);
}
function json2obj(json){
	return JSON.parse(json);
}
function is_chrome(){
	return /chrome/i.test(navigator.userAgent.toLowerCase());
}
function base_url(id){
	return base_urls + id;
}
function site_url(id){
	return site_urls + id;
}
function loaded(){
	$("body").attr("report_content", 1);
	$("#page-container").css({"display":"block"});
	$("#header").css({"width": ($(window).width() -30) +"px"});
	$("#body .left").css({"height": ($(window).height() -55) +"px"});
	$("#body .right").css({"width": ($(window).width() -280) +"px"});
	
	if($("#tab_facebook").length){
		tab_home('facebook');
	}
	
	if($("#load_content").length){
		setup_load_content();
	}
}
function setup_load_content(){
	$("#load_content").css({"height": $(window).height() +"px", "display":"block"});
	$("#load_content .body").css({"height": $(window).height() - parseInt(($(window).height() * 8) / 100) +"px"});
	$("#load_content .content").height($("#load_content .body").height() - $("#load_content .header").height() - 65);
}
function setup_ca_menu_circle(id){
	var ww = $(window).width() - 280;
	
	var w = 1870;
	if(id < 9){
		var arr = [50, 255, 455, 660, 860, 1060, 1265, 1465, 1670];
		w = arr[id];
	}
	
	if(w > ww){
		if(ww >= 1870){
			w = 1870;
		}else if(ww >= 1670){
			w = 1670;
		}else if(ww >= 1465){
			w = 1465;
		}else if(ww >= 1265){
			w = 1265;
		}else if(ww >= 1060){
			w = 1060;
		}else if(ww >= 860){
			w = 860;
		}else if(ww >= 660){
			w = 660;
		}else if(ww >= 455){
			w = 455;
		}else{
			w = 255;
		}
	}
	
	$(".ca-menu-circle").width(w - 50);
}
function setup_ca_menu_bar(id){
	var ww = ($(window).width() - 30) / 210;
	var w = parseInt(ww) * 210;
	var wc = id * 210;
	if(wc < w){
		w = wc;
	}
	$(".ca-menu-bar").width(w);
}
function report_close(){
	$("#content").html("");
	$("#load_holder").find('li').filter(function() {
		return $(this).find('ul').length === 0;
	}).map(function(i, e) {
		return window[$(this).text()].abort();
	});
	$("#load_holder").html("");
}
function popup(tp, url, width){
	$("#ifpopcontent").html('<center><img class="ifloading" src="'+ base_url('static/i/loading.gif') +'" alt="Loading.." title="Loading.."></center>');
	
	if(!width.isNaN){
		width = is_chrome() ? width +85 : width;
	}
	
	if(width == "98%"){
		$("#ifbox").width(width).height("95%");
	}
	else $("#ifbox").width(width).height("auto");
	
	switch(tp){
		case 1:
			$("#ifbox").bPopup({loadUrl:url, contentContainer:"#ifpopcontent"});
			break;
		case 2:
			$("#ifbox").bPopup({loadUrl:url, contentContainer:"#ifpopcontent", follow:false});
			break;
		case 3:
			$("#ifbox").bPopup({loadUrl:url, contentContainer:"#ifpopcontent", modalClose:false});
			break;
		default:
			$("#ifbox").bPopup({loadUrl:url, contentContainer:"#ifpopcontent", follow:false, modalClose:false});
			break;
	}
}
function iForm_s(id){
	$("#iform_r"+ id).html('<div style="text-align:center;padding:9px 0"><img src="'+ base_url('static/i/loading.gif') +'" alt="Please wait.." title="Please wait.." style="width:auto"></div>').fadeIn(function(){ $("#iform_f"+ id).slideUp(); });
	$("#iform_f"+ id).ajaxSubmit({
		success: function(response){
			$("#iform_r"+ id).html(response);
		},
		timeout: (60 * 1000),
		error: function(response){
			$("#iform_r"+ id).html('<div class="error-box">'+ response.status +' - '+ response.statusText +'</div>');
			$("#iform_f"+ id).slideDown();
		}
	});
	return false;
}
function dochange(src, val, sel, dis){
	if($("#"+ src).length){
		if(typeof val === 'undefined') val = '';
		if(typeof sel === 'undefined') sel = '';
		if(typeof dis === 'undefined') dis = '';
		var dataString='source='+ src +'&value='+ val +'&selected='+ sel +'&disabled='+ dis;
		$.ajax({
			type: "GET",
			url: site_url('process/autocomplete'),
			data: dataString,
			cache: false,
			success: function(response){
				$("#"+ src).html(response);
			},
			error: function(response){
				alert(response.status +' - '+ response.statusText);
			}
		});
	}
}
function tab_home(id){
	$(".tab span").removeClass("active");
	$("#tab_"+ id).addClass("active");
	$("#tab").html('<p align="center"><img src="'+ base_url('static/i/loader.gif') +'" alt="Loading.." title="Loading.."></p>');
	$("#tab").load(site_url('loader/tab_home/'+ id));
}
function search_account(){
	var key = $("#search_keyword").val(), ln = key.length;
	if(ln > 2){
		$("#search_result").html(
			'<h1><span class="fa fa-facebook-official"></span> Facebook</h1><div id="facebook_search"><center><img src="'+ base_url('static/i/load.gif') +'" alt="Loading.." title="Loading.." /></center></div>' +
			'<h1><span class="fa fa-twitter"></span> Twitter</h1><div id="twitter_search"><center><img src="'+ base_url('static/i/load.gif') +'" alt="Loading.." title="Loading.." /></center></div>' +
			'<h1><span class="fa fa-instagram"></span> Instagram</h1><div id="instagram_search"><center><img src="'+ base_url('static/i/load.gif') +'" alt="Loading.." title="Loading.." /></center></div>'
		);
		
		search_socmed('facebook', key);
		search_socmed('twitter', key);
		search_socmed('instagram', key);
	}
	if(!ln) $("#search_result").html('');
	return false;
}
function search_socmed(id, key){
	$.ajax({
		type: "POST",
		url: site_url('process/search_account/'+ id),
		data: 'keyword='+ key,
		cache: false,
		success: function(response){
			if($("#"+ id+ "_search").length){
				$("#"+ id+ "_search").html(response);
			}
		},
		error: function(response){
			console(response.status +' - '+ response.statusText);
		}
	});
}
function add_account(tp, id){
	$.ajax({
		type: "POST",
		url: 'http://188.166.246.225/colt/graph/'+ tp +'/submit-account-auto.php',//site_url('process/search_account/'+ id),
		data: 'socmed='+ tp +'&id='+ id,
		cache: false,
		success: function(response){
			$(".ifclose").click();
			tab_home(tp);
		},
		error: function(response){
			console(response.status +' - '+ response.statusText);
		}
	});
}
function report_content(ch, mn, id){
	$("#loading").fadeIn("fast");
	if($("body").attr("report_content") == 1){
		$("body").attr("report_content", 0);
		$.ajax({
			type: "GET",
			url: site_url('loader/'+ ch +'/'+ mn +'/'+ id),
			cache: false,
			success: function(response){
				$("#content").html('<div id="load_content"><div class="body">'+ response +'</div></div>');
				$("body").attr("report_content", 1);
				$("#loading").fadeOut();
				setup_load_content();
			},
			error: function(response){
				$("#loading").fadeOut();
				$("body").attr("report_content", 1);
				alert(response.status +' - '+ response.statusText);
			}
		});
	}
}
function report_load(holder, ch, mn, id, obj){
	$("#"+ holder).html('<p class="loader"><img src="'+ base_url('static/i/loader.gif') +'" alt="Loading.." title="Loading.." /></p>');
	$("#load_holder").append('<li>'+ holder +'</li>');
	window[holder] = $.ajax({
		type: "POST",
		url: site_url('data/'+ ch +'/'+ mn +'/'+ id),
		data: "date="+ $('#dateRangePicker').val() +"&data="+ obj2json(obj),
		cache: false,
		success: function(response){
			$("#"+ holder).html(response);
		},
		error: function(response){
			if(response.statusText != 'abort'){
				alert(response.status +' - '+ response.statusText);
			}
		}
	});
}
function comparison(){
	$("#comparison_Result").html('<div style="text-align:center;padding:9px 0"><img src="'+ base_url('static/i/loader.gif') +'" alt="Please wait.." title="Please wait.." style="width:auto"></div>');
	$("#comparison_Form").ajaxSubmit({
		success: function(response){
			$("#comparison_Result").html(response);
		},
		timeout: (60 * 1000),
		error: function(response){
			$("#comparison_Result").html('<div class="error-box">'+ response.status +' - '+ response.statusText +'</div>');
		}
	});
	return false;
}