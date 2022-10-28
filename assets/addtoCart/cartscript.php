<script>  
$(document).ready(function(){

	load_cart_data();
   
	function load_cart_data()
	{
		$.ajax({
			url:"assets/addtoCart/fetch_cart.php",
			method:"POST",
			dataType:"json",
			success:function(data)
			{
				$('#cart_details').html(data.cart_details);
				$('.total_price').text(data.total_price);
				$('.badge').text(data.total_item);
			}
		});
	}

	$('#cart-popover').popover({
		html : true,
        container: 'body',
        content:function(){
        	return $('#popover_content_wrapper').html();
        }
	});

	$(document).on('click', '.add_to_cart', function(){
		var product_id = $(this).attr("id");
		var shipping_charge = $('#shipping_charge'+product_id+'').val();
		var product_name = $('#name'+product_id+'').val();

		var shop_id = $('#shop_id'+product_id+'').val();
		var product_img = $('#pimg'+product_id+'').val();
		var product_price = $('#price'+product_id+'').val();
		var d_quantity = $('#d_quantity'+product_id+'').val();
		
		var regular = $('#regular'+product_id+'').val();
		var ptype = $('#ptype'+product_id+'').val();
		var product_quantity = $('#quantity'+product_id).val();
		var action = "add";
		if(product_quantity > 0)
		{
			$.ajax({
				url:"assets/addtoCart/action.php",
				method:"POST",
				data:{product_id:product_id, shop_id:shop_id, product_name:product_name, shipping_charge:shipping_charge, product_img:product_img, product_price:product_price, d_quantity:d_quantity, regular:regular, ptype:ptype, product_quantity:product_quantity, action:action},
				success:function(data)
				{
					load_cart_data();
					
				}
			});
		}
		else
		{
			alert("lease Enter Number of Quantity");
		}
	});

	$(document).on('click', '.delete', function(){
		var product_id = $(this).attr("id");
		var action = 'remove';
		if(confirm("Are you sure you want to remove this product?"))
		{
			$.ajax({
				url:"assets/addtoCart/action.php",
				method:"POST",
				data:{product_id:product_id, action:action},
				success:function()
				{
					load_cart_data();
					$('#cart-popover').popover('hide');
					location.reload(); 
					
				}
			})
		}
		else
		{
			return false;
		}
	});
	
	$(document).on('click', '.update_qty', function(){
		var product_id = $(this).attr("id");
		var product_quantity = 1;
		var action = 'update_qty';
		
		$.ajax({
			url:"assets/addtoCart/action.php",
			method:"POST",
			data:{product_id:product_id, product_quantity:product_quantity, action:action},
			success:function()
			{
				load_cart_data();
				$('#cart-popover').popover('hide');
				location.reload(); 
			}
		})
		
	});
	
	$(document).on('click', '.less_qty', function(){
		var product_id = $(this).attr("id");
		var product_quantity = -1;
		var action = 'less_qty';
		
		$.ajax({
			url:"assets/addtoCart/action.php",
			method:"POST",
			data:{product_id:product_id, product_quantity:product_quantity, action:action},
			success:function()
			{
				load_cart_data();
				$('#cart-popover').popover('hide');
				location.reload(); 
			}
		})
		
	});
	

	$(document).on('click', '#clear_cart', function(){
		var action = 'empty';
		$.ajax({
			url:"assets/addtoCart/action.php",
			method:"POST",
			data:{action:action},
			success:function()
			{
				load_cart_data();
				$('#cart-popover').popover('hide');
				alert("Your Cart has been clear");
			}
		});
	});
    
});

</script>