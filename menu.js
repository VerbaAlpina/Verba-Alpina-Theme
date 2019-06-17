jQuery(function (){
	
    changeMenuButton();
	addClickBehaviorToNav();
    checkFloatingObjects();

	setTimeout(function() {
	   checkFloatingObjects();
	}, 500);
	
});

var currentURL;

function addClickBehaviorToNav(){

var prevent_click = false;

	jQuery('.menu-toggle').on('click',function(){
		jQuery('.modal.in').modal('hide');
	   performMenuClick(jQuery(this))
	
	  })
	
	jQuery('.tb_lang_menu').on('click',function(e){

	    e.preventDefault();

		if(!prevent_click){

			if(VA_THEME["has_translations"] == "1")
				if(!jQuery('.language_modal_main').hasClass('in')) jQuery('.language_modal_main').modal();
				else  jQuery('.language_modal_main').modal('hide');

				 if(jQuery('#togglebtn').hasClass('toggled-on')){
				 	 		
				    	var button = document.getElementById('togglebtn');
				    	button.click(); //USE JS TO TRIGGER
				 }
		}
	})
	
	jQuery('.tb_share_menu').on('click', function(e){

		  e.preventDefault();

		if(!prevent_click){

			if(ajax_object.page_title == "KARTE" && (ajax_object.db != "xxx" || ajax_object.va_staff == "1")){
				categoryManager.produceMapURL(function (link){
					currentURL = link;
					if(!jQuery('.share_modal_main').hasClass('in')) jQuery('.share_modal_main').modal();
					else  jQuery('.share_modal_main').modal('hide');
				});
			}
			else {
				currentURL = window.location.href;
				if(!jQuery('.share_modal_main').hasClass('in'))  jQuery('.share_modal_main').modal();
				else jQuery('.share_modal_main').modal('hide');

				if(ajax_object.page_title == "KARTE"){
					jQuery('#share_url_text').attr("disabled","disabled");
					jQuery('.non_login_warning').remove();
					jQuery('.share_url_container').append(jQuery('<div class="non_login_warning">Share-Links in der Arbeitsversion nicht möglich. Bitte auf eine Zitierversion wechseln.</div>'));
				}
			}

			 if(jQuery('#togglebtn').hasClass('toggled-on')){
				 	 		
				    	var button = document.getElementById('togglebtn');
				    	button.click(); //USE JS TO TRIGGER
				 }

		}
	});
	
	
	jQuery('.tb_login_menu').on('click',function(e){

			if(!prevent_click){

				if(ajax_object.user != "" && !jQuery('.backend_modal_main').hasClass('in'))
					jQuery('.backend_modal_main').modal();
				 else jQuery('.backend_modal_main').modal('hide');

				 if(jQuery('#togglebtn').hasClass('toggled-on')){
				 	 		
				    	var button = document.getElementById('togglebtn');
				    	button.click(); //USE JS TO TRIGGER
				 }
		 }
	 });
	
	jQuery('.tb_db_menu').on('click',function(e){

		if(!jQuery(this).hasClass("pencil")){
			e.preventDefault();

			if(!prevent_click){
				if(!jQuery('.db_select_main').hasClass('in'))
					jQuery('.db_select_main').modal();
				else 
					jQuery('.db_select_main').modal('hide');

				 if(jQuery('#togglebtn').hasClass('toggled-on')){
				 	 		
				    	var button = document.getElementById('togglebtn');
				    	button.click(); //USE JS TO TRIGGER
				 }
			}
		}
	 });

	jQuery('.version_tag_hover').on('click',function(e){

	     e.preventDefault();

		if(!prevent_click){

			if(!jQuery('.db_select_main').hasClass('in'))
				jQuery('.db_select_main').modal();
			else jQuery('.db_select_main').modal('hide');

		}
	 })		
	 
	 jQuery(".db_select_main").on("shown.bs.modal", function (){
		jQuery("#va_version_select").off();
		jQuery("#va_version_select").change(function (){
			reloadPageWithParam(["db", "tk"], [this.value, undefined]); //Explicitly unset tk since synoptic maps are dependant on the version
		}); 
	 });



   jQuery(".top_menu_modal").on("show.bs.modal", function (){
	   	if(jQuery(".top_menu_modal").hasClass('in')){
	   			jQuery(".top_menu_modal").modal('hide');
	   	}

   	 	if(jQuery('#IM_filter_popup_div').hasClass('in') || jQuery('.im_search_modal').hasClass('in')){
	      	jQuery(".top_menu_modal").css('z-index','1501');
	      	jQuery('.modal-backdrop').css('z-index','1500');
      	}

   });

   jQuery(".top_menu_modal").on("shown.bs.modal", function (){
   		prevent_click = false;
   });

    jQuery(".top_menu_modal").on("hidden.bs.modal", function (){
   		prevent_click = false;
   });

   jQuery(".share_modal_main").on("shown.bs.modal", function (){
	   jQuery(this).find('.fb_link').attr('href','https://www.facebook.com/sharer/sharer.php?u='+currentURL);	
	   jQuery(this).find('.twitter_link').attr('href','https://twitter.com/intent/tweet?url='+currentURL);	
	   jQuery(this).find('.google_link').attr('href','https://plus.google.com/share?url='+currentURL);	
	   jQuery(this).find('.mail_link').attr('href','mailto:?body='+currentURL);
	   jQuery(this).find('#share_url_text').val(currentURL);	


	});

    jQuery(".top_menu_modal").on("hide.bs.modal", function (){
		 prevent_click = true;
    	jQuery('.modal-backdrop').css('z-index','');
    });


}

function performMenuClick(_this){

	var window_width = window.innerWidth;
	var window_height = window.innerHeight;



		if(_this.hasClass('toggled-on')){

		//open

         	var mobile_menu_bg = jQuery('<div class="mobile_menu_bg"></div>');
	    	jQuery('body').append(mobile_menu_bg);

	    	mobile_menu_bg.off().hammer().bind("tap", function(e){

	    		jQuery('.menu-toggle.toggled-on').removeClass('toggled-on');
	    		performMenuClick(_this);
	    	});

		    jQuery('.va-menu-list')
		    .css('visibility','visible')
		    .css('min-width','240px');

			jQuery('.page_item_has_children > ul').hide();

			jQuery('.va-menu-list >ul>li>a').css('line-height','1.42857143');

			jQuery('.va-menu-list >ul li')
			.css('padding-bottom','5px')
			.css('margin-right','0px');

			jQuery('.va-menu-list >ul>li')
			.css('border-bottom','1px solid #efefef')
			.css('padding-top','15px')
			.css('margin-top','0px');

			jQuery('.va-menu-list >ul>li:last-child').css('border-bottom','none');

			jQuery('.va-menu-list .children > li')
			.css('margin-top','10px');

			jQuery('.va-menu-list .children > li > a').css('line-height','1.42857143')

			jQuery('.va-menu-list >ul').css('height','auto');
		

			var caret = jQuery('<i class="res_menu_col_icon fa fa-caret-right" aria-hidden="true"></i>');

			if(jQuery('.page_item_has_children').find('.res_menu_col_icon').length==0){
			  jQuery('.page_item_has_children').prepend(caret);
			}
			jQuery('.page_item_has_children > .children').hide();

	 		jQuery('.page_item_has_children > ul')
	 		.css('position','initial')
	 		.css('overflow','initial')
	 		.css('clip','initial')
	 		.css('height','auto');

	 		jQuery('.page_item_has_children > ul >li').css('display','list-item');


	 	    jQuery('.nav-menu.toggled-on > li > a').off().on('click',function(e){
			   e.preventDefault();
			})




	 		jQuery('.nav-menu.toggled-on > li').off().hammer().bind("tap", function(e){

	 		  if(jQuery(this).hasClass('page_item_has_children')){

		 		  var that = jQuery(this);
				   that.find('.children').slideToggle("fast");
				   that.find('.res_menu_col_icon').toggleClass("fa-caret-right fa-caret-down");
				   jQuery('.page_item_has_children').removeClass('active');
				   jQuery('.page_item_has_children').removeClass('focus');
				   that.addClass('active');
			

				 jQuery('.page_item_has_children').each(function(){
					if(!jQuery(this).hasClass('active')){
						jQuery(this).find('.children').slideUp("fast");
				
						if(jQuery(this).find('.res_menu_col_icon').hasClass('fa-caret-down')){
							jQuery(this).find('.res_menu_col_icon').removeClass('fa-caret-down').addClass('fa-caret-right');
						}
					}
				});

			 }

			 else{
			 	var ref =jQuery(this).find('a').attr('href');
				window.location = ref;
			 }

	 		})


			jQuery('.pipespan').hide();

			jQuery('.va-menu-list > ul')
			.css('padding-left','20px')
			.css('padding-right','20px')
			.css('padding-bottom','20px')
			.css('width','100%');

		    if(window_width<=470){
		    	jQuery('.main-nav').css('height','auto');
		    	jQuery('.toolbar').css('top','initial');
		    	jQuery('.nav-menu.toggled-on >li>a').css('font-size','14px');
		    	jQuery('.logo_area_bar').css('border-bottom','1px solid #efefef');

		    	mobile_menu_bg.fadeIn();

		    }
		    else{
		    	jQuery('.va-menu-list').css('box-shadow','6px 6px 12px rgba(0,0,0,0.15)');
		   		jQuery('.va-menu-list').css('-webkit-box-shadow','6px 6px 12px rgba(0,0,0,0.15)');
		   			jQuery('.nav-menu.toggled-on >li>a').css('font-size','13px');
		   			jQuery('.nav-menu.toggled-on >li>a').css('text-transform','initial');
		    }


			jQuery('.va-menu-list').slideDown(function() {

			    	if(window_width>470){
				    	 if (jQuery(this).is(':visible')){
				        	jQuery(this).css('display','inline-block');
				         }
			        }
			        else{
			        	jQuery(this).css('display','block');
			        }	    
			});


		}

		else{
		
		//close

		jQuery('.page_item_has_children.active .children').hide();

	    jQuery('.mobile_menu_bg').fadeOut(function(){
	    	jQuery(this).remove();
	    })

		jQuery('.va-menu-list').slideUp(function() {
			
		    jQuery('.pipespan').show();
			
			jQuery('.va-menu-list > .nav-menu').removeClass('nav-menu');

		    jQuery('.va-menu-list >ul>li>a')
		    .css('line-height','')
		    .css('text-transform','');

		    jQuery('.va-menu-list >ul li')
		    .css('margin-right','')
		    .css('padding-bottom','');

		    jQuery('.va-menu-list >ul>li')
		    .css('border-bottom','')
		    .css('margin-top','')
		    .css('padding-top','');
	

		    jQuery('.va-menu-list .children > li')
		    .css('margin-top','');

		    jQuery('.va-menu-list .children > li >a').css('line-height','');

		    jQuery('.logo_area_bar').css('border-bottom','1px solid transparent');

		    jQuery('.page_item_has_children > ul')
		    .css('overflow','')
	 		.css('clip','')
	 		.css('height','')
	 		.css('position','');

		    jQuery('.page_item_has_children > ul li').css('display','');

		    jQuery('.va-menu-list >ul')
		    .css('height','45px')
		    .css('width','');

		    jQuery('.main-nav').css('height','45px');

		    jQuery('.va-menu-list li a').css('font-size','12px');

			jQuery('.page_item').find('.res_menu_col_icon').remove();
			jQuery('.page_item_has_children > ul').show();
			jQuery('.page_item_has_children > a').off();

			 jQuery('.va-menu-list')
			 .css('visibility','hidden')
			 .css('display','inline-block');

			jQuery('.va-menu-list > ul')
			.css('padding','0px')
			.css('box-shadow','none');

		    jQuery('.va-menu-list').css('-webkit-box-shadow','none');

		    if(window_width<=470)jQuery('.toolbar').css('top','');

		    jQuery('.va-menu-list').hide();

			});
		
		
		}

	}

function changeMenuButton(){
	jQuery('.menu-toggle').text('');
	jQuery('.menu-toggle').html('<i class="fa fa-bars" aria-hidden="true"></i>');
}

function checkFloatingObjects(){

	checkNavBar();

	 var ww_for_fix = jQuery(window).width();

	jQuery(window).resize(function(){

		 if (jQuery(window).width() != ww_for_fix) {			//fix for IOS resize bug
		 	    ww_for_fix = jQuery(window).width();
				checkNavBar();	
			}

	})
}



function checkNavBar(){


	var window_width = window.innerWidth;
	var center_width = window_width-jQuery('.logo_area_bar').outerWidth()-jQuery('.logo_area_right ').outerWidth();

	// jQuery('.va-menu-list').width(center_width);

	var nav_overflow = false;

	jQuery('.va-menu-list').show();
	jQuery('.logo_area_bar').css('display','inline-block');
	jQuery(".va-menu-list > ul > li").css('display','inline-block');

	var scrollposition = jQuery(window).scrollTop();

	 jQuery(".va-menu-list > ul > li").each(function(){
	     var element_offset = jQuery(this).offset();
	   	
	     if((element_offset.top-scrollposition)>0)nav_overflow = true;    
	 });


	if(nav_overflow){
		jQuery('.va-menu-list').css('visibility','hidden');
		jQuery('.va-menu-list').hide();
		jQuery('#togglebtn').css('display','block');
		jQuery(".va-menu-list > ul > li").css('display','list-item');
		jQuery('.logo_area_bar').css('display','block');
		jQuery('.toolbar').css('top','10px');
		jQuery('.toolbar_center:not(.ver_tb)').css('box-shadow','initial');
		jQuery('.toolbar_center:not(.ver_tb)').css('webkit-box-shadow','initial');

	}
	else{
		jQuery('.va-menu-list').css('visibility','visible');
		jQuery('#togglebtn').hide();
		jQuery(".va-menu-list > ul > li").css('display','inline-block');
	    jQuery('.logo_area_bar').css('display','inline-block');
	    jQuery('.toolbar').css('top','');

	    jQuery('.toolbar_center:not(.ver_tb)')
	    .css('box-shadow','')
	    .css('webkit-box-shadow','');
	}

	var dfglogo = jQuery('.logo_area_right');
		var dfglogo_bottom = jQuery('.bottom_logo_dfg');

	dfglogo.show();

	if(dfglogo.offset().top-scrollposition>0){
		dfglogo.css('visibility','hidden').hide();
		dfglogo_bottom.show();
	}
	else{
		dfglogo.css('visibility','visible');
		dfglogo_bottom.hide();
	}



		 if(window_width<=470){
		 	 var tbleft = window_width/2 - jQuery('.toolbar').width()/2;

		     jQuery('.toolbar')
		     .css('margin-left',tbleft)
		     .css('right','initial')
		     .css('top','');

	    	 jQuery('.toolbar_center:not(.ver_tb)')
	    	 .css('box-shadow','')
	    	 .css('webkit-box-shadow','');
	    }

	    else{
	    	jQuery('.toolbar').css('right','8%');
	    }


	    if(jQuery('.menu-toggle').hasClass('toggled-on')){
	  		
	    	var button = document.getElementById('togglebtn');
	    	button.click(); //USE JS TO TRIGGER
	    }



		if(ajax_object.page_title =="KARTE"){

		    if(window_width<=470){
			    	jQuery('.toolbarcontainer').css('background','white');
			    	jQuery('.upperbg').show();

			    	if(jQuery('#leftTable .menu_grp').first().find('.menu_collapse').is(':visible')){

				    	var otherhelpsymbol = jQuery('.chosen-container-single').next('.helpsymbol').first();
				    	var otherhelpsymbol_offset = otherhelpsymbol.offset();

				    	if(otherhelpsymbol_offset!=null){
				          var i_width = otherhelpsymbol.width();
				    	  var right = window_width - (otherhelpsymbol_offset.left + (i_width/2) + 8);
				    	  jQuery('.map_mode_selection').css('right',right+"px");
				    	}

			    	}

		    	    else{
		    			jQuery('.map_mode_selection').css('right', "9px");
		    		}
			    }



		    else{
		    	 jQuery('.upperbg').hide();
    	  	     jQuery('.map_mode_selection').css('right', "9px");
		    }
		}

	}



	//currently not used

function collision(div1, div2) {
      var x1 = div1.offset().left;
      var y1 = div1.offset().top;
      var h1 = div1.outerHeight(true);
      var w1 = div1.outerWidth(true);
      var b1 = y1 + h1;
      var r1 = x1 + w1;
      var x2 = div2.offset().left;
      var y2 = div2.offset().top;
      var h2 = div2.outerHeight(true);
      var w2 = div2.outerWidth(true);
      var b2 = y2 + h2;
      var r2 = x2 + w2;

      if (b1 < y2 || y1 > b2 || r1 < x2 || x1 > r2) return false;
      return true;
}

