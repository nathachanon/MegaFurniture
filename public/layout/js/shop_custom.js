/* JS Document */

/******************************

[Table of Contents]

1. Vars and Inits
2. Set Header
3. Init Custom Dropdown
4. Init Page Menu
5. Init Recently Viewed Slider
6. Init Brands Slider
7. Init Isotope
8. Init Price Slider
9. Init Favorites


******************************/

$(document).ready(function()
{
	"use strict";

	/* 

	1. Vars and Inits

	*/

	var menuActive = false;
	var header = $('.header');

	setHeader();



	initIsotope();
	initPriceSlider();



	$(window).on('resize', function()
	{
		setHeader();
	});

	/* 

	2. Set Header

	*/

	function setHeader()
	{
		//To pin main nav to the top of the page when it's reached
		//uncomment the following

		// var controller = new ScrollMagic.Controller(
		// {
		// 	globalSceneOptions:
		// 	{
		// 		triggerHook: 'onLeave'
		// 	}
		// });

		// var pin = new ScrollMagic.Scene(
		// {
		// 	triggerElement: '.main_nav'
		// })
		// .setPin('.main_nav').addTo(controller);

		if(window.innerWidth > 991 && menuActive)
		{
			closeMenu();
		}
	}

	/* 

	3. Init Custom Dropdown

	*/



	

	/* 

	4. Init Page Menu

	*/





	/* 

	5. Init Recently Viewed Slider

	*/


	/* 

	6. Init Brands Slider

	*/



	/* 

	7. Init Isotope

	*/

	function initIsotope()
	{
		var sortingButtons = $('.shop_sorting_button');

		$('.product_grid').isotope({
			itemSelector: '.product_item',
            getSortData: {
            	price: function(itemElement)
            	{
            		var priceEle = $(itemElement).find('.product_price').text().replace( '$', '' );
            		return parseFloat(priceEle);
            	},
            	name: '.product_name div a'
            },
            animationOptions: {
                duration: 750,
                easing: 'linear',
                queue: false
            }
        });

        // Sort based on the value from the sorting_type dropdown
        sortingButtons.each(function()
        {
        	$(this).on('click', function()
        	{
        		$('.sorting_text').text($(this).text());
        		var option = $(this).attr('data-isotope-option');
        		option = JSON.parse(option);
				$('.product_grid').isotope(option);
        	});
        });

	}

	 /* 

	8. Init Price Slider

	*/

    function initPriceSlider()
    {
    	if($("#slider-range").length)
    	{
    		$("#slider-range").slider(
			{
				range: true,
				min: 0,
				max: 1000,
				values: [ 0, 580 ],
				slide: function( event, ui )
				{
					$( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
				}
			});
				
			$( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) + " - $" + $( "#slider-range" ).slider( "values", 1 ) );
			$('.ui-slider-handle').on('mouseup', function()
			{
				$('.product_grid').isotope({
		            filter: function()
		            {
		            	var priceRange = $('#amount').val();
			        	var priceMin = parseFloat(priceRange.split('-')[0].replace('$', ''));
			        	var priceMax = parseFloat(priceRange.split('-')[1].replace('$', ''));
			        	var itemPrice = $(this).find('.product_price').clone().children().remove().end().text().replace( '$', '' );

			        	return (itemPrice > priceMin) && (itemPrice < priceMax);
		            },
		            animationOptions: {
		                duration: 750,
		                easing: 'linear',
		                queue: false
		            }
		        });
			});
    	}	
    }

    /* 

	9. Init Favorites

	*/

});