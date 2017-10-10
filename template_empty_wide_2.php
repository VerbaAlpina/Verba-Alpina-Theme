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
	display: none;
}


#masthead{
    background: rgba(251, 251, 251, 0.88);
    z-index: 100;
    width: 100%;
    padding: 0;
    position: fixed;
    top: 32px;
}



#wpadminbar{
	 background: rgba(251, 251, 251, 0.88) !important;
}


footer{
	display: none;
}


.main-navigation{
    -webkit-box-shadow: 6px 6px 12px rgba(0,0,0,0.15);
    box-shadow: 6px 6px 12px rgba(0,0,0,0.15);
}

.tablecontainer{
	position: absolute;
    margin-top: 78px;
    border-collapse: collapse;
    border-bottom-right-radius: 5px;
}

#leftTable{
background-color: white;
    -webkit-box-shadow: 6px 6px 12px rgba(0,0,0,0.175);
    box-shadow: 6px 6px 12px rgba(0,0,0,0.175);
}


.menu_heading{
	 color: #515151;
	 padding-left: 10px;
	 padding-top: 10px;
}

.menu_caret{
	width: 8px;
}


.menu_grp > #IM_legend{
	max-height: inherit;
}

.menu_grp > h2{
border-bottom: 1px solid  #efefef;
padding-bottom: 10px;
}

.menu_grp > h2:hover{
	cursor: pointer;
	background: #f5f5f5;
}

.menu_collapse{

	border-bottom: 1px solid #efefef;
}

.collapse_p{
	padding-left: 10px;
    padding-bottom: 10px;
}

.move_menu_container{
	-webkit-user-select: none;
  -moz-user-select: none;    
  -ms-user-select: none;  
  user-select: none; 
}

.move_menu{
	-webkit-box-shadow: inset 0px 10px 27px -13px rgba(0,0,0,0.75);
    -moz-box-shadow: inset 0px 10px 27px -13px rgba(0,0,0,0.75);
    box-shadow: inset 0px 10px 27px -13px rgba(0,0,0,0.75);
    height: 20px;
    padding: 8px 5px 4px 5px;
    width: 220px;
    background: #099dda;
    color: white;
    font-weight: bold;
    margin-left: 60px;
    text-align: center;
}

.move_menu:hover{
	cursor: pointer;
	background: #0577a7;
}

.wrapper{
	margin: 0 !important;
}

body{
	overflow: hidden;
}

</style>



<div id="primary" class="site-content">
	<div id="content" role="main">

	
		<?php echo do_shortcode(get_post()->post_content);?>

	</div><!-- #content -->
</div><!-- #primary -->

<?php //get_sidebar(); ?>
<?php get_footer(); ?>