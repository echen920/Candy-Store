<?php

class CandyStore extends CI_Controller {
   
     
    function __construct() {
    		// Call the Controller constructor
	    	parent::__construct();
	    	
	    	
	    	$config['upload_path'] = './images/product/';
	    	$config['allowed_types'] = 'gif|jpg|png';
/*	    	$config['max_size'] = '100';
	    	$config['max_width'] = '1024';
	    	$config['max_height'] = '768';
*/
	    		    	
	    	$this->load->library('upload', $config);
	    	session_start();
	    	
    }

    function index() {
    	/*$this->load->model('product_model');
    	$products = $this->product_model->getAll();
    	$data['products']=$products;*/
    	$this->load->helper(array('form'));
    	$this->load->view('product/login.php');

    }

    function newForm() {
	    	$this->load->view('product/newForm.php');
    }

	function newAccount() {
		$this->load->view('product/newAccount.php');
	}

	function shoppingCart() {
    		
    		$data['order_items'] = $_SESSION['cart'];
    		
    		$a = $_SESSION['cart'];
    		$total = '0';
    		foreach ($a as $i) {
				$total = $total + ($i->price * $i->quantity);
			}
			$data['total'] = $total;
			$_SESSION['total'] = $total;

		$this->load->view('product/shoppingCart.php', $data);
	}

	function viewOrders() {
		$this->load->model('order_model');
    	$orders = $this->order_model->getAll();
    	$data['orders']=$orders;
		$this->load->view('product/viewOrders.php', $data);
	}


	function createAccount() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('first', 'First', 'required|max_length[24]');
		$this->form_validation->set_rules('last', 'Last', 'required|max_length[24]');
		$this->form_validation->set_rules('username', 'Username', 'required|max_length[16]|is_unique[customer.login]');
		$this->form_validation->set_rules('passwd', 'Password', 'required|min_length[6]');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');

		if($this->form_validation->run() == true){
			$this->load->model('user_model');

			$user = new User();
			$user->first = $this->input->get_post('first');
			$user->last = $this->input->get_post('last');
			$user->username = $this->input->get_post('username');
			$user->password = $this->input->get_post('passwd');
			$user->email = $this->input->get_post('email');

			$this->user_model->createAccount($user);

			$this->load->library('email');
			$this->email->from('candystore309@gmail.com', 'CandyStore');
			$this->email->to('joanne.0302@gmail.com');
			$this->email->subject('CandyStore New Account Created');
			$this->email->message('You have successfully created a new account with CandyStore. Thank you!');
			$this->email->send();

			redirect('candystore/index', 'refresh');
		}else{
			$this->load->view('product/newAccount.php');
		}
		
	}

	function toAdminList() {
		redirect('candystore/viewAdminList', 'refresh');
	}

	function viewAdminList() {
    		$this->load->model('product_model');
    		$products = $this->product_model->getAll();
    		$data['products']=$products;
    		$this->load->view('product/adminList.php',$data);
	}
	
	function toList() {
		$this->load->model('product_model');
    	$products = $this->product_model->getAll();
    	$data['products']=$products;
		$this->load->view('product/list.php', $data); 
	}

	function viewList() {

		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if($this->form_validation->run() == true){

	    	$this->load->model('product_model');
    		$products = $this->product_model->getAll();
    		$data['products']=$products;

			$user = $this->input->get_post('username');
			$pass = $this->input->get_post('password');

			if ($user == 'admin' && $pass == 'admin') {
				$this->load->view('product/adminList.php', $data);
			} else {
				
				$this->load->model('user_model');
				if ($this->user_model->login($user, $pass) == true) {
					$_SESSION['cart'] = array();
					$_SESSION['total'] = '0';
					$this->load->view('product/list.php', $data);
				} else {
					redirect('candystore/index', 'refresh');
				}
			}
			
		} else {redirect('candystore/index', 'refresh');}

	}

	function addtoCart($id) {
		

			$this->load->model('product_model');
			$item = new Item();
			$item->product_id = $id;
			$item->quantity = '1';
			$item->name = $this->product_model->get($id)->name;
			$item->description = $this->product_model->get($id)->description;
			$item->price = $this->product_model->get($id)->price;
			$item->photo_url = $this->product_model->get($id)->photo_url;

			$a = $_SESSION['cart'];
			$inList = false;
			foreach ($a as $i) {
				if ($i->product_id == $id) {
					$inList = true;
					$i->quantity = $i->quantity + 1;
					
				}
			}
			if ($inList == false) {
				array_push($a, $item);
			}
			$_SESSION['cart'] = $a;

			redirect('candystore/shoppingCart', 'refresh');

	}
    
	function create() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name','Name','required|is_unique[product.name]');
		$this->form_validation->set_rules('description','Description','required');
		$this->form_validation->set_rules('price','Price','required');
		
		$fileUploadSuccess = $this->upload->do_upload();
		
		if ($this->form_validation->run() == true && $fileUploadSuccess) {
			$this->load->model('product_model');

			$product = new Product();
			$product->name = $this->input->get_post('name');
			$product->description = $this->input->get_post('description');
			$product->price = $this->input->get_post('price');
			
			$data = $this->upload->data();
			$product->photo_url = $data['file_name'];
			
			$this->product_model->insert($product);

			//Then we redirect to the index page again
			redirect('candystore/toadminList', 'refresh');
		}
		else {
			if ( !$fileUploadSuccess) {
				$data['fileerror'] = $this->upload->display_errors();
				$this->load->view('product/newForm.php',$data);
				return;
			}
			
			$this->load->view('product/newForm.php');
		}	
	}
	
	function read($id) {
		$this->load->model('product_model');
		$product = $this->product_model->get($id);
		$data['product']=$product;
		$this->load->view('product/read.php',$data);
	}
	
	function editForm($id) {
		$this->load->model('product_model');
		$product = $this->product_model->get($id);
		$data['product']=$product;
		$this->load->view('product/editForm.php',$data);
	}
	
	function update($id) {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name','Name','required');
		$this->form_validation->set_rules('description','Description','required');
		$this->form_validation->set_rules('price','Price','required');
		
		if ($this->form_validation->run() == true) {
			$product = new Product();
			$product->id = $id;
			$product->name = $this->input->get_post('name');
			$product->description = $this->input->get_post('description');
			$product->price = $this->input->get_post('price');
			
			$this->load->model('product_model');
			$this->product_model->update($product);
			//Then we redirect to the index page again
			redirect('candystore/toadminList', 'refresh');
		}
		else {
			$product = new Product();
			$product->id = $id;
			$product->name = set_value('name');
			$product->description = set_value('description');
			$product->price = set_value('price');
			$data['product']=$product;
			$this->load->view('product/editForm.php',$data);
		}
	}
    	
	function delete($id) {
		$this->load->model('product_model');
		
		if (isset($id)) 
			$this->product_model->delete($id);
		
		//Then we redirect to the index page again
		redirect('candystore/toadminList', 'refresh');
	}
   
	function delete_cart($id) {
		$a = $_SESSION['cart'];
		$c = '0';
		foreach ($a as $i) {
			if ($i->product_id == $id) {
				unset($a[$c]);
				$a = array_values($a);
				$_SESSION['cart'] = $a;
			}
			$c = $c + 1;
		}
				
		redirect('candystore/shoppingCart', 'refresh');
	} 

	function change_quantity() {
		$this->load->model('order_item_model');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('quantity','Quantity','required|is_numeric');

		if ($this->form_validation->run() == true) {
			$num = $this->input->get_post('quantity');
			$id = $this->input->post('id');
			$a = $_SESSION['cart'];
			foreach ($a as $i) {
				if ($i->product_id == $id) {
					$i->quantity = $num;
				}
			}
			$_SESSION['cart'] = $a;
		}
		redirect('candystore/shoppingCart', 'refresh');
	}
	
	function viewAccounts() {
		$this->load->model('user_model');
		$customers = $this->user_model->getAll();
    	$data['customers']=$customers;
    	$this->load->view('product/viewAccounts', $data);
	}

	function checkOut_view(){
		$this->load->view('product/checkOut.php');
	}

	function checkOut(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Username', 'required');	
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('creditNum', 'Creditcard Number', 'required|exact_length[16]|is_numeric');
		$this->form_validation->set_rules('creditMon', 'Creditcard Month', 'required|exact_length[2]|is_numeric|less_than[13]|greater_than[0]');
		$this->form_validation->set_rules('creditYr', 'Creditcard Year', 'required|exact_length[2]|is_numeric');

		if ($this->form_validation->run() == true) {
			$this->load->model('user_model');

			$user= $this->input->get_post('username');
			$userID = $this->user_model->getID($user);

			$order = new Order();

			$order->customer_id = $userID;
			$order->order_date = date("Y-m-d");
			$order->order_time = date("H:i:s");
			$order->total = $_SESSION['total'];
			$order->creditcard_number = $this->input->get_post('creditNum');
			$order->creditcard_month = $this->input->get_post('creditMon');
			$order->creditcard_year = $this->input->get_post('creditYr');
			
			$this->load->model('order_model');
			$this->order_model->insert($order);
			
			$orders = $this->order_model->getAll();
			foreach ($orders as $order) {
				 $o = $order;
			 }
			
			$a = $_SESSION['cart'];
			$this->load->model('order_item_model');
			foreach ($a as $i) {
				$order_item = new Order_item();
				$order_item->order_id = $o->id;
				$order_item->product_id = $i->product_id;
				$order_item->quantity = $i->quantity;
				$this->order_item_model->insert($order_item);
			}
			
			/*$items = $this->order_item_model->getAll();
			$order_items = array();
			foreach($items as  $item){
				array_push($order_items, $this->order_item_model->get($item->id));
			}
			$data['order_items'] = $order_items;*/

			$data['order'] = $o; 

			$items = $this->order_item_model->getAll();

			$order_items = array();
			foreach ($items as $item) {
				if($o->id == $item->order_id){
				array_push($order_items, $this->order_item_model->get($item->id));
				}
			}
			$data['items'] = $order_items;

			$emailAdd = $this->input->get_post('email');
			$this->load->library('email');
			$this->email->set_mailtype('html');
			$this->email->from('candystore309@gmail.com', 'CandyStore');
			$this->email->to($emailAdd);
			$this->email->subject('CandyStore Placed Order Sucessed');
			$receipt = $this->load->view('product/emailReceipt.php', $data, true); //THIS IS WHERE THE PROBLEM IS!!!!
			//$receipt2 = 'testing';
			$this->email->message($receipt);
			$this->email->send();
			
			$_SESSION['cart'] = array();
			$_SESSION['total'] = '0';
			$this->load->view('product/viewReceipt.php', $data);
		} else {
			redirect('candystore/checkOut_view', 'refresh');
		}

	}
	
	function logout(){
    	session_destroy();
    	redirect('candystore/index', 'refresh');
      }
    
    function delete_accounts() {
		$this->load->model('user_model');
		$a = $this->user_model->getAll();
		foreach ($a as $i) {
			$this->user_model->delete($i->id);
		}
		redirect('candystore/viewAccounts', 'refresh');
	}
	
}

