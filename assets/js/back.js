//jquery tab
jQuery(document).ready(function(){

    jQuery('ul.nav-tab-wrapper li').click(function(){
        var tab_id = jQuery(this).attr('data-tab');
        jQuery('ul.nav-tab-wrapper li').removeClass('nav-tab-active');
        jQuery('.tab-content').removeClass('current');
        jQuery(this).addClass('nav-tab-active');
        jQuery("#"+tab_id).addClass('current');
    });

	jQuery('#fgw_select_product').select2({
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

    jQuery('#fgw_select_cats').select2({
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
        var option = jQuery(this).find('option:selected');
        var val = option.val();

        if(val == "") {
            jQuery('.fgw_custom_rule').hide();
            jQuery('.fgw_price_rule').hide(); 
            jQuery('.fgw_qty_rule').hide();
            jQuery('.fgw_category_rule').hide();
        }
        if(val == "custom") {
            jQuery('.min_qnt').text("Minimum Quantity");
            jQuery('.max_qnt').text("Maximum Quantity");
            jQuery('.fgw_custom_rule').show();
            jQuery('.fgw_price_rule').hide(); 
            jQuery('.fgw_qty_rule').hide();
            jQuery('.fgw_category_rule').hide();
        }
        if(val == "price") {

            jQuery('.min_qnt').text("Minimum Cart Total");
            jQuery('.max_qnt').text("Maximum Cart Total");
            jQuery('.fgw_price_rule').show();
            jQuery('.fgw_custom_rule').hide();
            jQuery('.fgw_qty_rule').hide();
            jQuery('.fgw_category_rule').hide();
        }
        if(val == "category") {
            jQuery('.min_qnt').text("Minimum Quantity");
            jQuery('.max_qnt').text("Maximum Quantity");
            jQuery('.fgw_category_rule').show();
            jQuery('.fgw_qty_rule').hide();
            jQuery('.fgw_price_rule').hide(); 
            jQuery('.fgw_custom_rule').hide();
        }  
    });


    var gift_con = jQuery('.fgw_gift_rule').find(":selected").val();
    if(gift_con == "") {
        jQuery('.fgw_custom_rule').hide();
        jQuery('.fgw_price_rule').hide(); 
        jQuery('.fgw_qty_rule').hide();
        jQuery('.fgw_category_rule').hide();
    }
    if(gift_con == "custom") {
        jQuery('.min_qnt').text("Minimum Quantity");
        jQuery('.max_qnt').text("Maximum Quantity");
        jQuery('.fgw_custom_rule').show();
        jQuery('.fgw_price_rule').hide(); 
        jQuery('.fgw_qty_rule').hide();
        jQuery('.fgw_category_rule').hide();
    }
    if(gift_con == "price") {
        jQuery('.min_qnt').text("Minimum Cart Total");
        jQuery('.max_qnt').text("Maximum Cart Total");
        jQuery('.fgw_price_rule').show();
        jQuery('.fgw_custom_rule').hide();
        jQuery('.fgw_qty_rule').hide();
        jQuery('.fgw_category_rule').hide();
    }
    if(gift_con == "category") {
        jQuery('.min_qnt').text("Minimum Quantity");
        jQuery('.max_qnt').text("Maximum Quantity");
        jQuery('.fgw_category_rule').show();
        jQuery('.fgw_qty_rule').hide();
        jQuery('.fgw_price_rule').hide(); 
        jQuery('.fgw_custom_rule').hide();
    }




    jQuery('body').on('click','.addrow',function(){

        var total_column = cfway_count_col();
        let row = jQuery('<tr></tr>');
        var column = "";
        for (col = 1; col <= total_column; col++) {
            column += '<td><label class="min_qnt">Minimum Quantity</label><input   type="number" name="minimum[]"></td>';
            column += '<td><label class="max_qnt">Maximum Quantity</label><input  type="number" name="maximum[]"></td>';
            column += '<td><label>Number Of Allowed Gift </label><input type="text" name="allowed[]"></td>';
            column += '<td><label>Choose Gift Product</label><input type="hidden" name="fgw_gift_multiple[]" value=""><select class="fgw_gift_multiple" name="" multiple="multiple" style="width:100%;"></select></td>';
        }
        column += '<td><a class="addrow button-primary">Add</a><a class="deleterow button-primary">Remove</a></td>';
        row.append(column);
        jQuery(this).closest('tr').after(row);

        setTimeout(function(){ multiple_gift_ajax(); }, 100);
        //jQuery(".ocscw_chart_tbl").append(jQuery(".ocscw_chart_tbl tr:nth-child(2)").clone());
        var total_row = cfway_count_row();
        var total_column = cfway_count_col();
        jQuery('input[name="totalrow"]').val(total_row);
        jQuery('input[name="totalcol"]').val(total_column);

        var gift_con = jQuery('.fgw_gift_rule').val();

        if(gift_con == "") {
            jQuery('.fgw_custom_rule').hide();
            jQuery('.fgw_price_rule').hide(); 
            jQuery('.fgw_qty_rule').hide();
            jQuery('.fgw_category_rule').hide();
        }
        if(gift_con == "custom") {
            jQuery('.min_qnt').text("Minimum Quantity");
            jQuery('.max_qnt').text("Maximum Quantity");
            jQuery('.fgw_custom_rule').show();
            jQuery('.fgw_price_rule').hide(); 
            jQuery('.fgw_qty_rule').hide();
            jQuery('.fgw_category_rule').hide();
        }
        if(gift_con == "price") {
            jQuery('.min_qnt').text("Minimum Cart Total");
            jQuery('.max_qnt').text("Maximum Cart Total");
            jQuery('.fgw_price_rule').show();
            jQuery('.fgw_custom_rule').hide();
            jQuery('.fgw_qty_rule').hide();
            jQuery('.fgw_category_rule').hide();
        }
        if(gift_con == "category") {
            jQuery('.min_qnt').text("Minimum Quantity");
            jQuery('.max_qnt').text("Maximum Quantity");
            jQuery('.fgw_category_rule').show();
            jQuery('.fgw_qty_rule').hide();
            jQuery('.fgw_price_rule').hide(); 
            jQuery('.fgw_custom_rule').hide();
        }
    });

    multiple_gift_ajax();
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
    jQuery('.fgw_gift_multiple').select2({
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
    });
}