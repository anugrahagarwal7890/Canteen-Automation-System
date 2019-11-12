<?php

class Home_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_home_user($input)
    {
        $this->db->select('id,name,email,mobile,address,status');
        $this->db->where('id', $input['user_id']);
        $user = $this->db->get('users')->row_array();
        if ($user) {
            if ($user['status'] != 1)
                return_data(FALSE, "User is deactiveted Please Contact to admin", array());
            $query = 'SELECT materials.name as material_name,materials.price,cart.quantity,materials.price * cart.quantity as total_price from cart join users on cart.user_id=users.id JOIN materials on cart.material_id=materials.id';
            $cart = $this->db->query($query)->result_array();

            $return = array(
                'user_data' => $user,
                'cart' => $cart
            );
            return_data(TRUE, "Information Displayed", $return);
        }
        return_data(FALSE, "Invalid User id", array());
    }


    function category($input)
    {
        return $this->db->get('category')->result_array();
    }
	function food($input)
	{
		$this->db->where('category_id',$input['category_id']);
		return $this->db->get('food')->result_array();
	}
	function myorder($input)
	{
		$data=$input['user_id'];
		$query = "SELECT food.name as food_name,food.image as image,cart.total_price as total_price,cart.quantity as quantity,cart.order_number as order_number from cart join food on cart.food_id=food.id where cart.transaction=1 and cart.user_id=".$data;
		$cart = $this->db->query($query)->result_array();
		return $cart;
	}
	function feedback($input)
	{
		$input['id']=0;
		$input['created']=time();
		$input['status']=1;
		unset($input['id']);
		$this->db->insert('feedback',$input);
		return TRUE;
	}
	function today_order($input)
	{
		$id=$input["user_id"];
		$sql = "SELECT food.name as food_name,food.image as image,cart.total_price as total_price,cart.quantity as quantity,cart.order_number as order_number from cart join food on cart.food_id=food.id where cart.transaction=1 and cart.user_id='.$id.' and from_unixtime(cart.modify,'%Y-%d-%m')=".date('Y-d-m');
		$data=$this->db->query($sql)->result_array();
		return_data(TRUE,"TODAY CART",$data);
	}
	function cart($input)
	{
		$input["status"] = 1;
		$input["created"] = time();
		$material=$input["food_id"];
		$sql="select price from food where id='$material'";
		$price=$this->db->query($sql)->result_array();
		$price=$price[0]['price'];
		$quantity=$input["quantity"];
		$input["total_price"]=$price* $quantity;
		$id=$input["cart_id"];

		if ($input["transaction"]==2)
		{
			$input['order_number']=rand(1000,9999);
			unset($input["cart_id"]);
			$this->db->insert('cart',$input);
			$input['cart_id']=$this->db->insert_id();
			$cart_id=$input["cart_id"];
			return_data(TRUE,"PAYMENT LEFT",$input);
		}
		else
		{
			$sql="update food join cart set food.stock=food.stock-cart.quantity where food.id='$material' and cart.id=".$input['cart_id'];
			$this->db->query($sql);
			$sql="update cart join food set cart.transaction=1,cart.modify='".time()."' where cart.id='$id'";
			$this->db->query($sql);
			$sql="select order_number from cart where id=".$id;
			$data=$this->db->query($sql)->result_array();
			$input['order_number']=$data[0]['order_number'];
			return_data(TRUE,"PAYMENT DONE",$input);
		}
	}


    function get_cart_detail($input)
    {
        $data=$input['user_id'];
        $query = "SELECT cart.id as cart_id,materials.id,materials.name as material_name,materials.price,cart.quantity,materials.price * cart.quantity as total_price,cart.transaction from cart join users on cart.user_id=users.id JOIN materials on cart.material_id=materials.id where users.id='$data' and  cart.transaction=0";
        $cart = $this->db->query($query)->result_array();
        return $cart;
    }

    function get_remove_cart($input)
    {
    	$sql="select transaction from cart where id=".$input['cart_id'];
    	$transaction=$this->db->query($sql)->row_array();
        if($transaction['transaction']==2)
		{
			$sql="delete from cart where id=".$input['cart_id'];
			$this->db->query($sql);
			return_data(TRUE,"Cart Removed",[]);
		}
        else
		{
			return_data(FALSE,"Payment Already Done",[]);
		}
    }

}
