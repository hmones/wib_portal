function update_cities(e,o,s){let a=$(e).val(),t=app_url+"/country/"+a;console.log(t),$.ajax({method:"GET",url:t}).done(function(e){$(o).dropdown("clear"),$(o).dropdown("setup menu",{values:e.data.cities}),null!=s&&""!=s&&$(o).dropdown("set selected",s)})}function display_flash_msg(e="#flash_message",o="error",s="There are few errors with your data, please revise it and resubmit your form"){var a="positive",t="negative";"error"!==o&&(a="negative",t="positive"),$(e).text(s).removeClass(a).addClass(t).show().delay(1500).fadeOut(400)}$(function(){$(".ui.dropdown").dropdown()}),$(".message .close").on("click",function(){$(this).closest(".message").transition("fade")});
