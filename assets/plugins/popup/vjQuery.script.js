jQuery(document).ready(function(){jQuery(".vtr-menu-icon").click(function(c){c.preventDefault();jQuery(this).toggleClass("active");jQuery(".mobile-menu").slideToggle()})});jQuery(document).ready(function(){jQuery(window).scroll(function(){100<jQuery(this).scrollTop()?jQuery(".keatas").fadeIn():jQuery(".keatas").fadeOut()});jQuery(".keatas").click(function(){jQuery("html, body").animate({scrollTop:0},600);return!1})});jQuery(document).ready(function(){jQuery("img.lazy").show().lazyload({effect:"fadeIn",threshold:400})});jQuery(".photo").each(function(){jQuery(this).magnificPopup({delegate:"a",type:"image",gallery:{enabled:!0}})});jQuery(document).ready(function(){jQuery("#home-slider").lightSlider({adaptiveHeight:!0,auto:!0,loop:!0,keyPress:!1,enableDrag:!1,enableTouch:!1,speed:1E3,pause:4E3,item:1,pager:!1})});jQuery(document).ready(function(){});jQuery(document).ready(function(){jQuery("#widget-slider").lightSlider({auto:!0,loop:!0,keyPress:!0,enableDrag:!1,enableTouch:!1,speed:1E3,pause:3500,item:1,pager:!1})});jQuery(document).ready(function(){jQuery("#small-slider").lightSlider({auto:!0,loop:!0,keyPress:!0,enableDrag:!1,item:4,slideMove:1,easing:"cubic-bezier(0.25, 0, 0.25, 1)",speed:1E3,pause:2500,pager:!1,controls:!1})});jQuery(document).ready(function(){function c(a){return a=(a+"").split(".")[0].replace(/(\d)(?=(\d{3})+\b)/g,"$1,")}jQuery("#hitung").click(function(){var a,b,e,d;a=parseFloat(jQuery("#kreditHarga").val());d=parseFloat(jQuery("#kreditDp").val());e=parseFloat(jQuery("#kreditRate").val())/1200;b=12*parseFloat(jQuery("#kreditJangka").val());a-=d;b=a*e*Math.pow(1+e,b)/(Math.pow(1+e,b)-1);d=b+d;isNaN(b)?(jQuery("#kreditHutang").val("-Salah-"),jQuery("#kreditAngsuran").val("-Salah-"),jQuery("#kreditTotal").val("-Salah-")):(jQuery("#kreditHutang").val(c(a.toFixed(2))),jQuery("#kreditAngsuran").val(c(b.toFixed(2))),jQuery("#kreditTotal").val(c(d.toFixed(2))));return!1})});