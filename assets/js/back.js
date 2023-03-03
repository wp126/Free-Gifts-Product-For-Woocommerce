//jquery tab
jQuery(document).ready(function(){

    jQuery('ul.nav-tab-wrapper li').click(function(){
        var tab_id = jQuery(this).attr('data-tab');
        jQuery('ul.nav-tab-wrapper li').removeClass('nav-tab-active');
        jQuery('.tab-content').removeClass('current');
        jQuery(this).addClass('nav-tab-active');
        jQuery("#"+tab_id).addClass('current');
    });

	jQuery('#fgw_select_gift_product').select2({
  	    ajax: {
    			url: ajaxurl,
    			dataType: 'json',
    			allowClear: true,
    			data: function (params) {
    				
      				return {
        				q: params.term,
        				action: 'fgw_product_ajax'
      				};

    			},
    			processResults: function( data ) {
					var options = [];

					if ( data ) {
	 					jQuery.each( data, function( index, text ) { 

							options.push( { id: text[0], text: text[1], 'price': text[2]} );
						});
	 				}
					return {
						results: options
					};
				},
				cache: true
		},
		minimumInputLength: 3
	});

    jQuery('.fgw_ckout_enable_cls').click(function(){
        if (jQuery(this).is(':checked')) {
            jQuery('.fgw_ckout_sec_show').show();
        } else {
            jQuery('.fgw_ckout_sec_show').hide();
        }
    });

    if (jQuery('.fgw_ckout_enable_cls').is(':checked')) {
        jQuery('.fgw_ckout_sec_show').show();
    } else {
        jQuery('.fgw_ckout_sec_show').hide();
    }

    jQuery('.fgw_gift_rule').change(function() {
        showopvalie();
       
    });

    showopvalie();
    

    function showopvalie(){
        var gift_con = jQuery('.fgw_gift_rule').find(":selected").val();
        if(gift_con == "") {
        }
        if(gift_con == "custom") {
            
            jQuery('.fgw_child_div_custom').show();
            jQuery('.fgw_child_div_price').hide();
            jQuery('.fgw_child_div_category').hide();
            
        }
        if(gift_con == "price") {

            jQuery('.fgw_child_div_custom').hide();
            jQuery('.fgw_child_div_price').show();
            jQuery('.fgw_child_div_category').hide();
        }
        if(gift_con == "category") {

            jQuery('.fgw_child_div_custom').hide();
            jQuery('.fgw_child_div_price').hide();
            jQuery('.fgw_child_div_category').show();
        }
    }
    // console.log(jQuery(".fgw_child_div_custom .fgw_tbl1").html().trim());
    if(jQuery(".fgw_child_div_custom .fgw_tbl1").html().trim()==''){
        jQuery('.fgw_child_div_custom .fgw_tbl1').append(jQuery("#fgw_child_div_custom_clone").html());
    }
    if(jQuery(".fgw_child_div_price .fgw_tbl1").html().trim()==''){
        jQuery('.fgw_child_div_price .fgw_tbl1').append(jQuery("#fgw_child_div_price_clone").html());
    }
    if(jQuery(".fgw_child_div_category .fgw_tbl1").html().trim()==''){
        jQuery('.fgw_child_div_category .fgw_tbl1').append(jQuery("#fgw_child_div_category_clone").html());
    }

    jQuery('body').on('click','.addrow',function(){

        setTimeout(function(){ multiple_gift_ajax(); }, 100);
        //jQuery(".ocscw_chart_tbl").append(jQuery(".ocscw_chart_tbl tr:nth-child(2)").clone());
        var total_row = cfway_count_row();
        var total_column = cfway_count_col();
        jQuery('input[name="totalrow"]').val(total_row);
        jQuery('input[name="totalcol"]').val(total_column); 
        showopvalie();
    });

    setTimeout(function(){ multiple_gift_ajax(); }, 100);
    function cfway_count_col(){
        var colCount = 0;
        jQuery('.fgw_tbl1 tr:nth-child(1) td').each(function () {
            colCount++;
        });
        return colCount - 1;
    }

    function cfway_count_row(){
        var rowCount = jQuery('.fgw_tbl1 tr').length;
        return rowCount - 1;
    }

    jQuery("body").on('click', '.deletecolumn', function(){
        var td = jQuery(this).closest('td');
        var indexa = td.index();
        jQuery(this).closest('table').find('tr').each(function() {
            this.removeChild(this.cells[ indexa ]);
        });
        var total_row = cfway_count_row();
        var total_column = cfway_count_col();
        jQuery('input[name="totalrow"]').val(total_row);
        jQuery('input[name="totalcol"]').val(total_column);
        return false;
    });

    jQuery("body").on('click', '.deleterow', function(){
        jQuery(this).parent().parent().remove();
        var total_row = cfway_count_row();
        var total_column = cfway_count_col();
        jQuery('input[name="totalrow"]').val(total_row);
        jQuery('input[name="totalcol"]').val(total_column);
        return false;
    });
});

function fgw_select_id(id) {
	var copyText = id;
	jQuery("#"+copyText).select();
	document.execCommand("copy");
}

function multiple_gift_ajax(){
    /*jQuery('.fgw_gift_multiple').select2({
        ajax: {
                url: ajaxurl,
                dataType: 'json',
                allowClear: true,
                data: function (params) {
                    return {
                        q: params.term,
                        action: 'fgw_product_ajax'
                    };
                },
                
                processResults: function( data ) {
                    var options = [];
                    if ( data ) {
                        jQuery.each( data, function( index, text ) { 
                            // console.log(text);
                            options.push( { id: text[0], text: text[1], 'price': text[2]} );
                            //jQuery(this).closest(input).val(23);

                        });
                    }
                    return {
                        results: options
                    };

                },
                
                cache: true
        },
        minimumInputLength: 3
    });
    
    jQuery('.fgw_gift_multiple').on("select2:select", function(event) {
        var multi_value = jQuery(event.currentTarget).select2("val");
       jQuery(this).closest("td").find("input[name='fgw_gift_multiple[]']").val(multi_value);
    });
     jQuery('.fgw_gift_multiple').on("select2:unselect", function (e) { 
        var valuffe = jQuery(e.currentTarget).select2("val");
        jQuery(this).closest("td").find("input[name='fgw_gift_multiple[]']").val(valuffe);
    });*/
     //for custom product

    jQuery('.fgw_select_product').select2({
        ajax: {
                url: ajaxurl,
                dataType: 'json',
                allowClear: true,
                data: function (params) {
                    return {
                        q: params.term,
                        action: 'fgw_product_ajax'
                    };
                },
                
                processResults: function( data ) {
                    var options = [];
                    if ( data ) {
                        jQuery.each( data, function( index, text ) { 
                            // console.log(text);
                            options.push( { id: text[0], text: text[1], 'price': text[2]} );
                            //jQuery(this).closest(input).val(23);

                        });
                    }
                    return {
                        results: options
                    };

                },
                
                cache: true
        },
        minimumInputLength: 3
    });
    
    jQuery('.fgw_select_product').on("select2:select", function(event) {
        var multi_value = jQuery(event.currentTarget).select2("val");
       jQuery(this).closest("td").find("input[name='fgw_combo_custom[]']").val(multi_value);
    });
     jQuery('.fgw_select_product').on("select2:unselect", function (e) { 
        var valuffe = jQuery(e.currentTarget).select2("val");
        jQuery(this).closest("td").find("input[name='fgw_combo_custom[]']").val(valuffe);
    });

    //for custom product

    jQuery('.fgw_gift_multiple_custom').select2({
        ajax: {
                url: ajaxurl,
                dataType: 'json',
                allowClear: true,
                data: function (params) {
                    return {
                        q: params.term,
                        action: 'fgw_product_ajax'
                    };
                },
                
                processResults: function( data ) {
                    var options = [];
                    if ( data ) {
                        jQuery.each( data, function( index, text ) { 
                            // console.log(text);
                            options.push( { id: text[0], text: text[1], 'price': text[2]} );
                            //jQuery(this).closest(input).val(23);

                        });
                    }
                    return {
                        results: options
                    };

                },
                
                cache: true
        },
        minimumInputLength: 3
    });
    
    jQuery('.fgw_gift_multiple_custom').on("select2:select", function(event) {
        var multi_value = jQuery(event.currentTarget).select2("val");
       jQuery(this).closest("td").find("input[name='fgw_gift_multiple_custom[]']").val(multi_value);
    });
     jQuery('.fgw_gift_multiple_custom').on("select2:unselect", function (e) { 
        var valuffe = jQuery(e.currentTarget).select2("val");
        jQuery(this).closest("td").find("input[name='fgw_gift_multiple_custom[]']").val(valuffe);
    });

    //for category 
    jQuery('.fgw_select_cats_category').select2({
        ajax: {
                url: ajaxurl,
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term,
                        action: 'fgw_cats_ajax'
                    };
                },
                processResults: function( data ) {
                var options = [];
                if ( data ) {
 
                    jQuery.each( data, function( index, text ) {
                        options.push( { id: text[0], text: text[1]  } );
                    });
 
                }
                return {
                    results: options
                };
            },
            cache: true
        },
        minimumInputLength: 3
    });
    jQuery('.fgw_select_cats_category').on("select2:select", function(event) {
        var multi_value = jQuery(event.currentTarget).select2("val");
       jQuery(this).closest("td").find("input[name='fgw_select_cats_category[]']").val(multi_value);
    });
     jQuery('.fgw_select_cats_category').on("select2:unselect", function (e) { 
        var valuffe = jQuery(e.currentTarget).select2("val");
        jQuery(this).closest("td").find("input[name='fgw_select_cats_category[]']").val(valuffe);
    });

     jQuery('.fgw_gift_multiple_category').select2({
        ajax: {
                url: ajaxurl,
                dataType: 'json',
                allowClear: true,
                data: function (params) {
                    return {
                        q: params.term,
                        action: 'fgw_product_ajax'
                    };
                },
                
                processResults: function( data ) {
                    var options = [];
                    if ( data ) {
                        jQuery.each( data, function( index, text ) { 
                            // console.log(text);
                            options.push( { id: text[0], text: text[1], 'price': text[2]} );
                            //jQuery(this).closest(input).val(23);

                        });
                    }
                    return {
                        results: options
                    };

                },
                
                cache: true
        },
        minimumInputLength: 3
    });
    
    jQuery('.fgw_gift_multiple_category').on("select2:select", function(event) {
        var multi_value = jQuery(event.currentTarget).select2("val");
       jQuery(this).closest("td").find("input[name='fgw_gift_multiple_category[]']").val(multi_value);
    });
     jQuery('.fgw_gift_multiple_category').on("select2:unselect", function (e) { 
        var valuffe = jQuery(e.currentTarget).select2("val");
        jQuery(this).closest("td").find("input[name='fgw_gift_multiple_category[]']").val(valuffe);
    });

     //custom price

      jQuery('.fgw_gift_multiple_price').select2({
        ajax: {
                url: ajaxurl,
                dataType: 'json',
                allowClear: true,
                data: function (params) {
                    return {
                        q: params.term,
                        action: 'fgw_product_ajax'
                    };
                },
                
                processResults: function( data ) {
                    var options = [];
                    if ( data ) {
                        jQuery.each( data, function( index, text ) { 
                            // console.log(text);
                            options.push( { id: text[0], text: text[1], 'price': text[2]} );
                            //jQuery(this).closest(input).val(23);

                        });
                    }
                    return {
                        results: options
                    };

                },
                
                cache: true
        },
        minimumInputLength: 3
    });
    
    jQuery('.fgw_gift_multiple_price').on("select2:select", function(event) {
        var multi_value = jQuery(event.currentTarget).select2("val");
       jQuery(this).closest("td").find("input[name='fgw_gift_multiple_price[]']").val(multi_value);
    });
     jQuery('.fgw_gift_multiple_price').on("select2:unselect", function (e) { 
        var valuffe = jQuery(e.currentTarget).select2("val");
        jQuery(this).closest("td").find("input[name='fgw_gift_multiple_price[]']").val(valuffe);
    });
}