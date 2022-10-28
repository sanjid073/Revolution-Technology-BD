<?php

//action.php

session_start();

if(isset($_POST["action"]))
{
	if($_POST["action"] == "add")
	{
		if(isset($_SESSION["shopping_cart"]))
		{
			$is_available = 0;
			foreach($_SESSION["shopping_cart"] as $keys => $values)
			{
				if($_SESSION["shopping_cart"][$keys]['product_id'] == $_POST["product_id"])
				{
					$is_available++;
					$_SESSION["shopping_cart"][$keys]['product_quantity'] = $_SESSION["shopping_cart"][$keys]['product_quantity'] + $_POST["product_quantity"];
				}
			}
			if($is_available == 0)
			{
				$item_array = array(
					'product_id'               =>     $_POST["product_id"],
					'shop_id'          		   =>     $_POST["shop_id"],
					'product_name'             =>     $_POST["product_name"],
					'product_img'              =>     $_POST["product_img"],
					'product_price'            =>     $_POST["product_price"],
					'd_quantity'               =>     $_POST["d_quantity"],
					'shipping_charge'          =>     $_POST["shipping_charge"],
					'regular'                  =>     $_POST["regular"],
					'ptype'                    =>     $_POST["ptype"],
					'product_quantity'         =>     $_POST["product_quantity"]
				);
				$_SESSION["shopping_cart"][] = $item_array;
			}
		}
		else
		{
			$item_array = array(
				'product_id'               =>     $_POST["product_id"],  
				'shop_id'      		       =>     $_POST["shop_id"],
				'product_name'             =>     $_POST["product_name"],
				'product_img'              =>     $_POST["product_img"],				
				'product_price'            =>     $_POST["product_price"],
				'd_quantity'               =>     $_POST["d_quantity"],
				'shipping_charge'          =>     $_POST["shipping_charge"],
				'regular'                  =>     $_POST["regular"],
				'ptype'                    =>     $_POST["ptype"],
				'product_quantity'         =>     $_POST["product_quantity"]
			);
			$_SESSION["shopping_cart"][] = $item_array;
		}
	}

	
	if($_POST["action"] == 'update_qty')
	{
	
		foreach($_SESSION["shopping_cart"] as $keys => $values)
		{
		
			if($values["product_id"] == $_POST["product_id"])
			{
				$_SESSION["shopping_cart"][$keys]['product_quantity'] = $_SESSION["shopping_cart"][$keys]['product_quantity'] + $_POST["product_quantity"];
			}
		}
			
	}
	
	if($_POST["action"] == 'less_qty')
	{
	
		foreach($_SESSION["shopping_cart"] as $keys => $values)
		{
		
			if($values["product_id"] == $_POST["product_id"])
			{
				$_SESSION["shopping_cart"][$keys]['product_quantity'] = $_SESSION["shopping_cart"][$keys]['product_quantity'] + $_POST["product_quantity"];
			}
		}
			
	}
	
	
	if($_POST["action"] == 'remove')
	{
		foreach($_SESSION["shopping_cart"] as $keys => $values)
		{
			if($values["product_id"] == $_POST["product_id"])
			{
				unset($_SESSION["shopping_cart"][$keys]);
			}
		}
	}
	
	
	if($_POST["action"] == 'empty')
	{
		unset($_SESSION["shopping_cart"]);
	}
}

?>