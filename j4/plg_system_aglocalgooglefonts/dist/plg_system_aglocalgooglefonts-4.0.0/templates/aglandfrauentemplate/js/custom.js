/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


jQuery(function ($) {
	/* Main Nav takes all space not only left*/
	$(function () {
		$('#main-menu').smartmenus({
			mainMenuSubOffsetX: -1,
			subMenusSubOffsetX: 10,
			subMenusSubOffsetY: 0
		});
	});


	/* Main Nav not scolling out - over css if min-width: 544px*/
	$(document).ready(function () {
		$(window).scroll(function () {
			if ($(window).scrollTop() > 85) {
				$('#main-nav-fixed').addClass('navbar-fixed-top');
				$('#landfrauenlogo').hide("slow");
				
			}
			if ($(window).scrollTop() < 75) {
				$('#main-nav-fixed').removeClass('navbar-fixed-top');
				$('#landfrauenlogo').show("slow");
			}
		});
	});
});