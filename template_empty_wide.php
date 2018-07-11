<?php

/*
 * Template Name: Empty Page Wide
* Description: Shows the page without footer
*/

get_header();
im_create_map(0);
?>

<style type="text/css">

html{
	margin-top: 0!important;
	overflow: hidden;
}

@media screen and (min-width: 600px) {
.site {
    max-width: 2000px
}
}


.site-content {
/*	width: 85%;*/
	margin : 0 0 0;
}

body .site {
	margin-bottom : 0;
}

footer[role="contentinfo"] {
	padding : 0.2rem;
	margin-top : 0.2rem;
	max-width : none;
}


#page{
	margin: 0;
	padding: 0;
}


.main-navigation{
	margin: 0;
}

#content{
   /*padding-left: 20px;*/
}

#masthead >div{
	/*display: none;*/
}


#masthead{
    z-index: 2000;
    width: 100%;
    padding: 0;
    position: fixed;
    top: 0px;
}



#wpadminbar{
	display: none !important;
}


footer{
	display: none;
}


.main-navigation{
    -webkit-box-shadow: 5px 5px 13px rgba(0,0,0,0.15);
    box-shadow: 5px 5px 13px rgba(0,0,0,0.15);
}

.tablecontainer{
	position: absolute;
    margin-top: 45px;
    border-collapse: collapse;
    border-bottom-right-radius: 5px;
    top:0px;
}

#leftTable{
	background-color: rgba(255, 255, 255, 0.96);
	-webkit-box-shadow: 6px 6px 12px rgba(0,0,0,0.175);
	box-shadow: 6px 6px 12px rgba(0,0,0,0.175);
}


.legendtablecontainer{
	width: 100%;
}

.legendtable{
	width: 100%;
}

.l_span_container{

word-break: break-word;
overflow-wrap: break-word;
max-width: 198px;
}

.menu_collapse .chosen-container {
 width: 90% !important;
}

 .menu_collapse .sf-menu {
  float: initial !important;
  width: 100% !important;
}

@media screen and (max-width: 470px) {

	#leftTable {
		width: 100% !important;
	}

	.tablecontainer {
		width: 100%;
	}

	.menu_heading{
	  /*text-align: center;*/
	}

	.move_menu{
    margin-left: auto !important;
	margin: auto;
	}

}


@media screen and (max-width: 400px) {
	.l_span_container{
	max-width: 175px;
	}	
}

@media screen and (max-width: 370px) {

	.menu_heading{
		font-size: 13px !important;
        padding-left: 8px !important;
	}
}


@media screen and (max-width: 350px) {
	.l_span_container{
	max-width: 150px;
	}	
}

@media screen and (max-width: 335px) {
	.map_mode_selection label{
	   max-width: 35px;
	   white-space: nowrap;
	   overflow: hidden;
	   text-overflow: ellipsis;
	}
}

@media screen and (max-width: 320px) {
	.l_span_container{
	max-width: 126px;
	}	
}

.legendtable tr td:last-child{
	width: 1%;
}



.menu_heading{
	 color: #515151;
	 padding: 10px 15px 10px 15px;
	 border-bottom: 1px solid  #efefef;
	 font-weight: initial;
	 font-size: 14px;
	 -webkit-transition: background-color .50s ease;
    -o-transition: background-color .50s ease;
    transition: background-color .50s ease;
    padding-right: 5px;
    position: relative;
}

.menu_heading.l_disabled{
 color:  #d2d2d2;
}

#syn_heading{
	border-bottom: none;
	padding-bottom: 12px;
}

.menu_grp.keep_shadow #legend_heading{
	-webkit-box-shadow: 0px 4px 9px 0px rgba(0,0,0,0.1);
	-moz-box-shadow: 0px 4px 9px 0px rgba(0,0,0,0.1);
	box-shadow: 0px 4px 9px 0px rgba(0,0,0,0.1);
}

.menu_caret{
	width: 8px;
}


.menu_grp > #IM_legend{
	max-height: inherit;
}

.menu_grp > .menu_heading:hover{
	cursor: pointer;
	background: #f5f5f5;
}

.menu_grp > .menu_heading.l_disabled:hover{
	cursor: not-allowed;
	background: white;
}

.menu_collapse{

	border-bottom: 1px solid #efefef;
}

.collapse_p{
    padding-bottom: 10px;
}



.move_menu_container{
	-webkit-user-select: none;
  -moz-user-select: none;    
  -ms-user-select: none;  
  user-select: none; 
}

.move_menu{
    height: 28px;
    width: 220px;
    color: white;
    font-weight: bold;
    font-size: 12px;
    margin-left: 60px;
    text-align: center;
}

.move_menu:hover .move_menu_center span{
	color:black;
}

.move_menu:hover{
   cursor: pointer;
}

.move_menu .move_menu_center{
	display: inline-block;
	background: white;
	padding: 8px;
	width: 134px;
}

.move_menu_center span{
  color: #4b4b4b;
}

.wrapper{
	margin: 0 !important;
}

body{
	overflow: hidden;
}

#move_menu_left{
    background: transparent url(<?php echo get_stylesheet_directory_uri();?>/images/waveborder_white_l.png) no-repeat 0 0;
    margin-right: -8px;
    float: left;
}

#move_menu_right{
    background: transparent url(<?php echo get_stylesheet_directory_uri();?>/images/waveborder_white_r.png) no-repeat 0 0;
    margin-left: -8px;
    float: right;

  }

.move_menu_wave_border{
	display: inline-block;
	width: 44px;
    height: 28px;
}

.move_menu>div{
/*-webkit-box-shadow: inset 0px 20px 19px -17px rgba(0,0,0,0.2);
-moz-box-shadow: inset 0px 20px 19px -17px rgba(0,0,0,0.2);
box-shadow: inset 0px 20px 19px -17px rgba(0,0,0,0.2);*/
}

</style>



<div id="primary" class="site-content">
	<div id="content" role="main">

	
		<?php echo do_shortcode(get_post()->post_content);?>

	</div><!-- #content -->
</div><!-- #primary -->

<?php //get_sidebar(); ?>
<?php get_footer(); ?>