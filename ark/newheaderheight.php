<?php
	//newheaderheight
    header("Content-type: text/css; charset: UTF-8");

return;

	/* SYSTEM VARIABLES */

	$headerPillsHeight = 30;
	$mobileNavToggleBtnHeight = 25;
	$headerFullScreenNavToggleBtnHeight = 30;
	$mobileTopbarToggleBtnHeight = 20;

	/* VARIABLES THAT CAN BE CHANGED BY USER - BELOW ARE RANDOM VALUES, NOT DEFAULT VALUES ! */

	$desktopLogoJumpOut = true; // Only for desktop. Logo height needs to be bigger than header height in order to look properly. You can add ADVTOGGLEBOX for ".navbar-logo-wrap" but keep in mind that it can apply styles to ALL breakpoints and LogoJump works only on Desktop, also several properties such as padding etc cannot be changed on ".navbar-logo-wrap" or it will break the header.

/**********************************************************************************************************************/
/* CHANGE THIS
/**********************************************************************************************************************/
/*----------------------------------------------------------*/
/* CHANGE THIS
/*----------------------------------------------------------*/
    $mobileBefScrHeadHeight = 91;       // mobile before scroll - header
	$mobileBefScrLogoHeight = 45;       // mobile before scroll - logo

    $desktopBefScrHeadHeight = 91; // *****     // desktop before scroll - header
	$desktopBefScrLogoHeight = 45; // *****     // desktop before scroll - logo

    $desktopAftScrHeadHeight = 71; // *****     // desktop after scroll - header
	$desktopAftScrLogoHeight = 45; // *****     // desktop after scroll - logo
/*----------------------------------------------------------*/
/* CHANGE THIS
/*----------------------------------------------------------*/
/**********************************************************************************************************************/
/* CHANGE THIS
/**********************************************************************************************************************/

	// "*****" = hide this option for VERTICAL headers, because users can already change existing padding options to resize logo in VERTICAL headers



	

		/* DEFAULT (OLD VERSION) VALUES - UNCOMMENT THIS FOR TESTING ONLY */

	    /*

	    $mobileBefScrHeadHeight = 90;
		$mobileBefScrLogoHeight = 45;

		$desktopBefScrHeadHeight = 90;
	    $desktopBefScrLogoHeight = 45;

	    $desktopAftScrHeadHeight = 70;
		$desktopAftScrLogoHeight = 45;

		*/





?>

/* RESETS - DO NOT CHANGE DYNAMICALLY */

header .navbar-logo,
header.header-shrink .navbar-logo {
	line-height: 0 !important;
}

header .navbar-logo-wrap img {
	max-height: none !important;
}

header .navbar-logo .navbar-logo-wrap 	{
	transition-duration: 400ms;
	transition-property: all;
	transition-timing-function: cubic-bezier(0.7, 1, 0.7, 1);
}

@media (max-width: 991px){
	header .navbar-logo .navbar-logo-img {
	    max-width: none !important; 
	}
}

@media (max-width: 991px){
	.header .navbar-actions .navbar-actions-shrink 	{
		max-height: none;
	}
}

@media (min-width: 992px){
	.header .navbar-actions .navbar-actions-shrink 	{
		max-height: none;
	}
}

@media (min-width: 992px) {
	.header-shrink.ark-header .navbar-actions .navbar-actions-shrink {
	    max-height: none;
	}
}

@media (max-width: 991px){
	.header-fullscreen .header-fullscreen-col 	{
		width: calc(100% - 60px);
	}

	.header-fullscreen .header-fullscreen-col.header-fullscreen-nav-actions-left 	{
		width: 30px;
	}
}

.ark-header .topbar-toggle-trigger 	{
	padding: 0;
}

/* DYNAMIC OVERWRITES */


@media (min-width: 992px) {
	.wrapper>.wrapper-top-space {
	height: <?php echo $desktopBefScrHeadHeight; ?>px;
	}
}

.ark-header .navbar-logo .navbar-logo-wrap {
    padding-top: <?php echo max(($desktopBefScrHeadHeight-$desktopBefScrLogoHeight)/2,0); ?>px;
	padding-bottom: <?php echo max(($desktopBefScrHeadHeight-$desktopBefScrLogoHeight)/2,0); ?>px;
}

@media (min-width: 992px) {
	.header-shrink.ark-header .navbar-logo .navbar-logo-wrap {
	    padding-top: <?php echo max(($desktopAftScrHeadHeight-$desktopAftScrLogoHeight)/2,0); ?>px;
		padding-bottom: <?php echo max(($desktopAftScrHeadHeight-$desktopAftScrLogoHeight)/2,0); ?>px;
	}
}

@media (min-width: 992px) {
	.ark-header .navbar-nav .nav-item {
	    line-height: <?php echo $desktopBefScrHeadHeight; ?>px;
	}
}

@media (min-width: 992px) {
	header .navbar-logo-wrap img {
	    height: <?php echo $desktopBefScrLogoHeight; ?>px !important;
	}
}

@media (min-width: 992px) {
	header.header-shrink .navbar-logo-wrap img {
	    height: <?php echo $desktopAftScrLogoHeight; ?>px !important;
	}
}

.ark-header .navbar-actions .navbar-actions-shrink {
	line-height: <?php echo $desktopBefScrHeadHeight-1; ?>px;	
}

@media (min-width: 992px){
	.header-shrink.ark-header .navbar-actions .navbar-actions-shrink {
	    line-height: <?php echo $desktopAftScrHeadHeight-1; ?>px;
	}
}

@media (min-width: 992px) {
	.ark-header.header-no-pills .navbar-nav .nav-item-child {
	    line-height: <?php echo $desktopBefScrHeadHeight; ?>px;
	}
}

@media (min-width: 992px) {
	.ark-header.header-no-pills.header-shrink .navbar-nav .nav-item-child {
		line-height: <?php echo $desktopAftScrHeadHeight; ?>px;
	}
}

@media (min-width: 992px) {
	.ark-header.header-pills .navbar-nav .nav-item-child {
	    margin-top: <?php echo ($desktopBefScrHeadHeight-$headerPillsHeight)/2; ?>px;
	    margin-bottom: <?php echo ($desktopBefScrHeadHeight-$headerPillsHeight)/2; ?>px;
	}
}

@media (min-width: 992px) {
	.ark-header.header-pills.header-shrink .navbar-nav .nav-item-child {
	    margin-top: <?php echo ($desktopAftScrHeadHeight-$headerPillsHeight)/2; ?>px;
	    margin-bottom: <?php echo ($desktopAftScrHeadHeight-$headerPillsHeight)/2; ?>px;
	}
}

@media (max-width: 991px) {
	.header-fullscreen .header-fullscreen-nav-actions-left,
	.header-fullscreen .header-fullscreen-nav-actions-right 	{
	    padding-top: <?php echo ($mobileBefScrHeadHeight-$headerFullScreenNavToggleBtnHeight)/2; ?>px;
	    padding-bottom: <?php echo ($mobileBefScrHeadHeight-$headerFullScreenNavToggleBtnHeight)/2; ?>px;
	}
}

@media (min-width: 992px) {
	.header-fullscreen .header-fullscreen-nav-actions-left,
	.header-fullscreen .header-fullscreen-nav-actions-right 	{
	    padding-top: <?php echo ($desktopBefScrHeadHeight-$headerFullScreenNavToggleBtnHeight)/2; ?>px;
	    padding-bottom: <?php echo ($desktopBefScrHeadHeight-$headerFullScreenNavToggleBtnHeight)/2; ?>px;
	}
}

@media (min-width: 992px) {
	.header-shrink.header-fullscreen .header-fullscreen-nav-actions-left,
	.header-shrink.header-fullscreen .header-fullscreen-nav-actions-right {
	    padding-top: <?php echo ($desktopAftScrHeadHeight-$headerFullScreenNavToggleBtnHeight)/2; ?>px;
	    padding-bottom: <?php echo ($desktopAftScrHeadHeight-$headerFullScreenNavToggleBtnHeight)/2; ?>px;
	}
}

.header.auto-hiding-navbar.nav-up {
	top: -<?php echo $desktopAftScrHeadHeight+10; ?>px;
}

.header-transparent.auto-hiding-navbar.nav-up {
	top: -<?php echo $desktopAftScrHeadHeight+10; ?>px;
}

.header-center-aligned.auto-hiding-navbar.nav-up {
	top: -<?php echo $desktopAftScrHeadHeight+10; ?>px;
}

.header-center-aligned-transparent.auto-hiding-navbar.nav-up {
	top: -<?php echo $desktopAftScrHeadHeight+10; ?>px;
}

.search-on-header-field .search-on-header-input 	{
	height: <?php echo $desktopBefScrHeadHeight-2; ?>px;
}

.header-shrink .search-on-header-field .search-on-header-input 	{
	height: <?php echo $desktopAftScrHeadHeight-2; ?>px;
}

@media (max-width: 991px) {
	.search-on-header-field .search-on-header-input 	{
		height: <?php echo $mobileBefScrHeadHeight; ?>px;
	}
}

.ark-header .topbar-toggle-trigger 	{
	height: <?php echo $mobileTopbarToggleBtnHeight; ?>px;
	margin-top: <?php echo ($mobileBefScrHeadHeight-$mobileTopbarToggleBtnHeight)/2; ?>px;
	margin-bottom: <?php echo ($mobileBefScrHeadHeight-$mobileTopbarToggleBtnHeight)/2; ?>px;
}

/* HORIZONTAL - MOBILE */

@media (max-width: 991px) {
	.ark-header .navbar-toggle{
		margin-top: <?php echo ($mobileBefScrHeadHeight-$mobileNavToggleBtnHeight)/2; ?>px;
		margin-bottom: <?php echo ($mobileBefScrHeadHeight-$mobileNavToggleBtnHeight)/2; ?>px;
	}
}

@media (max-width: 991px) {
	.ark-header .navbar-actions .navbar-actions-shrink {
		line-height: <?php echo $mobileBefScrHeadHeight; ?>px;
	}
}

@media (max-width: 991px) {
	header .navbar-logo-wrap img {
    	height: <?php echo $mobileBefScrLogoHeight; ?>px !important;		
	}
}

@media (max-width: 991px) {
	.ark-header .navbar-logo .navbar-logo-wrap 	{
	    padding-top: <?php echo ($mobileBefScrHeadHeight-$mobileBefScrLogoHeight)/2; ?>px;
		padding-bottom: <?php echo ($mobileBefScrHeadHeight-$mobileBefScrLogoHeight)/2; ?>px;
	}
}

/* VERTICAL */

@media (max-width: 991px) {
	.header-vertical .navbar-toggle {
		margin-top: <?php echo ($mobileBefScrHeadHeight-$mobileNavToggleBtnHeight)/2; ?>px;
		margin-bottom: <?php echo ($mobileBefScrHeadHeight-$mobileNavToggleBtnHeight)/2; ?>px;
	}
}

@media (max-width: 991px) {
	.header-section-scroll .navbar-toggle {
		margin-top: <?php echo ($mobileBefScrHeadHeight-$mobileNavToggleBtnHeight)/2; ?>px;
		margin-bottom: <?php echo ($mobileBefScrHeadHeight-$mobileNavToggleBtnHeight)/2; ?>px;
	}
}

@media (max-width: 991px) {
	header.ark-header-vertical .navbar-logo .navbar-logo-wrap 	{
	    padding-top: <?php echo ($mobileBefScrHeadHeight-$mobileBefScrLogoHeight)/2; ?>px !important;
		padding-bottom: <?php echo ($mobileBefScrHeadHeight-$mobileBefScrLogoHeight)/2; ?>px !important;		
	}
}

/* LOGO JUMP OUT */

<?php if ($desktopLogoJumpOut){ ?>

	@media (min-width: 992px) {
		.ark-header .navbar-logo {
			position: relative;
		}
		.ark-header .navbar-logo-wrap {
			position: absolute;
		}
	}

<?php } ?>
















