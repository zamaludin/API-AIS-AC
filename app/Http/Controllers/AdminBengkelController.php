<?php namespace App\Http\Controllers;

	use Session;
	use Request;
	use DB;
	use CRUDBooster;

	class AdminBengkelController extends \crocodicstudio\crudbooster\controllers\CBController {

	    public function __construct() {

			# START CONFIGURATION DO NOT REMOVE THIS LINE
			$this->title_field = "name";
			$this->limit = "20";
			$this->orderby = "id,desc";
			$this->global_privilege = false;
			$this->button_table_action = true;
			$this->button_action_style = "button_icon";
			$this->button_add = true;
			$this->button_edit = true;
			$this->button_delete = true;
			$this->button_detail = true;
			$this->button_show = true;
			$this->button_filter = true;
			$this->button_import = false;
			$this->button_export = false;
			$this->table = "bengkel";
			# END CONFIGURATION DO NOT REMOVE THIS LINE

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"Name","name"=>"name"];
			$this->col[] = ["label"=>"Ref Bengkel Type Id","name"=>"ref_bengkel_type_id"];
			$this->col[] = ["label"=>"Address","name"=>"address"];
			$this->col[] = ["label"=>"Latitude","name"=>"latitude"];
			$this->col[] = ["label"=>"Longitude","name"=>"longitude"];
			$this->col[] = ["label"=>"Ref Area Id","name"=>"ref_area_id"];
			$this->col[] = ["label"=>"Phone","name"=>"phone"];
			# END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
		$this->form = array();
		$this->form[] = array("label"=>"Name","name"=>"name","type"=>"text","required"=>TRUE,"validation"=>"required|string|min:3|max:70","placeholder"=>"You can only enter the letter only");
		$this->form[] = array("label"=>"Ref Bengkel Type Id","name"=>"ref_bengkel_type_id","type"=>"select2","required"=>TRUE,"validation"=>"required|integer|min:0","datatable"=>"ref_bengkel_type,name");
		$this->form[] = array("label"=>"Address","name"=>"address","type"=>"textarea","required"=>TRUE,"validation"=>"required|string|min:5|max:5000");
		$this->form[] = array("label"=>"Latitude","name"=>"latitude","type"=>"hidden","required"=>TRUE,"validation"=>"required|min:3|max:255");
		$this->form[] = array("label"=>"Longitude","name"=>"longitude","type"=>"hidden","required"=>TRUE,"validation"=>"required|min:3|max:255");
		$this->form[] = array("label"=>"Ref Area Id","name"=>"ref_area_id","type"=>"select2","required"=>TRUE,"validation"=>"required|integer|min:0","datatable"=>"ref_area,name");
		$this->form[] = array("label"=>"Phone","name"=>"phone","type"=>"number","required"=>TRUE,"validation"=>"required|numeric","placeholder"=>"You can only enter the number only");
		$this->form[] = array("label"=>"Fax","name"=>"fax","type"=>"text","required"=>TRUE,"validation"=>"required|min:3|max:255");
		$this->form[] = array("label"=>"Email","name"=>"email","type"=>"email","required"=>TRUE,"validation"=>"required|min:3|max:255|email|unique:bengkel","placeholder"=>"Please enter a valid email address");
		$this->form[] = array("label"=>"Contact Person1 Id","name"=>"contact_person1_id","type"=>"select2","required"=>TRUE,"validation"=>"required|integer|min:0","datatable"=>"contact_person1,id");
		$this->form[] = array("label"=>"Contact Person2 Id","name"=>"contact_person2_id","type"=>"select2","required"=>TRUE,"validation"=>"required|integer|min:0","datatable"=>"contact_person2,id");
		$this->form[] = array("label"=>"Owner Id","name"=>"owner_id","type"=>"select2","required"=>TRUE,"validation"=>"required|integer|min:0","datatable"=>"owner,id");
		$this->form[] = array("label"=>"Max Order","name"=>"max_order","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0");
		$this->form[] = array("label"=>"Account Number","name"=>"account_number","type"=>"text","required"=>TRUE,"validation"=>"required|min:3|max:255");
		$this->form[] = array("label"=>"Account Name","name"=>"account_name","type"=>"text","required"=>TRUE,"validation"=>"required|min:3|max:255");
		$this->form[] = array("label"=>"Cek Aki Motor","name"=>"cek_aki_motor","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0");
		$this->form[] = array("label"=>"Cek Aki Mobil","name"=>"cek_aki_mobil","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0");
		$this->form[] = array("label"=>"Ganti Aki","name"=>"ganti_aki","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0");
		$this->form[] = array("label"=>"Stroom Aki","name"=>"stroom_aki","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0");
		$this->form[] = array("label"=>"Jumper","name"=>"jumper","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0");
		$this->form[] = array("label"=>"Tambal Ban Motor","name"=>"tambal_ban_motor","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0");
		$this->form[] = array("label"=>"Ganti Ban Motor","name"=>"ganti_ban_motor","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0");
		$this->form[] = array("label"=>"Kirim Bensin","name"=>"kirim_bensin","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0");
		$this->form[] = array("label"=>"Tambal Ban Mobil","name"=>"tambal_ban_mobil","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0");
		$this->form[] = array("label"=>"Ganti Ban Mobil","name"=>"ganti_ban_mobil","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0");
		$this->form[] = array("label"=>"Cuci Cepat Motor","name"=>"cuci_cepat_motor","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0");
		$this->form[] = array("label"=>"Cuci Mengkilap Motor","name"=>"cuci_mengkilap_motor","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0");
		$this->form[] = array("label"=>"Cuci Luar Mobil","name"=>"cuci_luar_mobil","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0");
		$this->form[] = array("label"=>"Cuci Lengkap Mobil","name"=>"cuci_lengkap_mobil","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0");
		$this->form[] = array("label"=>"Cek Mesin Motor","name"=>"cek_mesin_motor","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0");
		$this->form[] = array("label"=>"Ganti Oli Motor","name"=>"ganti_oli_motor","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0");
		$this->form[] = array("label"=>"Cek Mesin Mobil","name"=>"cek_mesin_mobil","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0");
		$this->form[] = array("label"=>"Ganti Oli Mobil","name"=>"ganti_oli_mobil","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0");
		$this->form[] = array("label"=>"Derek","name"=>"derek","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0");
		$this->form[] = array("label"=>"Ganti Sparepart Mobil","name"=>"ganti_sparepart_mobil","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0");
		$this->form[] = array("label"=>"By Driver","name"=>"by_driver","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0");
		$this->form[] = array("label"=>"No Driver","name"=>"no_driver","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0");

			# END FORM DO NOT REMOVE THIS LINE     

			/* 
	        | ---------------------------------------------------------------------- 
	        | Sub Module
	        | ----------------------------------------------------------------------     
			| @label          = Label of action 
			| @path           = Path of sub module
			| @button_color   = Bootstrap Class (primary,success,warning,danger)
			| @button_icon    = Font Awesome Class  
			| @parent_columns = Sparate with comma, e.g : name,created_at
	        | 
	        */
	        $this->sub_module = array();


	        /* 
	        | ---------------------------------------------------------------------- 
	        | Add More Action Button / Menu
	        | ----------------------------------------------------------------------     
	        | @label       = Label of action 
	        | @url         = Target URL, you can use field alias. e.g : [id], [name], [title], etc
	        | @icon        = Font awesome class icon. e.g : fa fa-bars
	        | @color 	   = Default is primary. (primary, warning, succecss, info)     
	        | @showIf 	   = If condition when action show. Use field alias. e.g : [id] == 1
	        | 
	        */
	        $this->addaction = array();


	        /* 
	        | ---------------------------------------------------------------------- 
	        | Add More Button Selected
	        | ----------------------------------------------------------------------     
	        | @label       = Label of action 
	        | @icon 	   = Icon from fontawesome
	        | @name 	   = Name of button 
	        | Then about the action, you should code at actionButtonSelected method 
	        | 
	        */
	        $this->button_selected = array();

	                
	        /* 
	        | ---------------------------------------------------------------------- 
	        | Add alert message to this module at overheader
	        | ----------------------------------------------------------------------     
	        | @message = Text of message 
	        | @type    = warning,success,danger,info        
	        | 
	        */
	        $this->alert        = array();
	                

	        
	        /* 
	        | ---------------------------------------------------------------------- 
	        | Add more button to header button 
	        | ----------------------------------------------------------------------     
	        | @label = Name of button 
	        | @url   = URL Target
	        | @icon  = Icon from Awesome.
	        | 
	        */
	        $this->index_button = array();



	        /* 
	        | ---------------------------------------------------------------------- 
	        | Customize Table Row Color
	        | ----------------------------------------------------------------------     
	        | @condition = If condition. You may use field alias. E.g : [id] == 1
	        | @color = Default is none. You can use bootstrap success,info,warning,danger,primary.        
	        | 
	        */
	        $this->table_row_color = array();     	          

	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | You may use this bellow array to add statistic at dashboard 
	        | ---------------------------------------------------------------------- 
	        | @label, @count, @icon, @color 
	        |
	        */
	        $this->index_statistic = array();



	        /*
	        | ---------------------------------------------------------------------- 
	        | Add javascript at body 
	        | ---------------------------------------------------------------------- 
	        | javascript code in the variable 
	        | $this->script_js = "function() { ... }";
	        |
	        */
	        $this->script_js = NULL;



	        /*
	        | ---------------------------------------------------------------------- 
	        | Include Javascript File 
	        | ---------------------------------------------------------------------- 
	        | URL of your javascript each array 
	        | $this->load_js[] = asset("myfile.js");
	        |
	        */
	        $this->load_js = array();



	        //No need chanage this constructor
	        $this->constructor();
	    }


	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for button selected
	    | ---------------------------------------------------------------------- 
	    | @id_selected = the id selected
	    | @button_name = the name of button
	    |
	    */
	    public function actionButtonSelected($id_selected,$button_name) {
	        //Your code here
	            
	    }


	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate query of index result 
	    | ---------------------------------------------------------------------- 
	    | @query = current sql query 
	    |
	    */
	    public function hook_query_index(&$query) {
	        //Your code here
	            
	    }

	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate row of index table html 
	    | ---------------------------------------------------------------------- 
	    |
	    */    
	    public function hook_row_index($column_index,&$column_value) {	        
	    	//Your code here
	    }

	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate data input before add data is execute
	    | ---------------------------------------------------------------------- 
	    | @arr
	    |
	    */
	    public function hook_before_add(&$postdata) {        
	        //Your code here

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command after add public static function called 
	    | ---------------------------------------------------------------------- 
	    | @id = last insert id
	    | 
	    */
	    public function hook_after_add($id) {        
	        //Your code here

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate data input before update data is execute
	    | ---------------------------------------------------------------------- 
	    | @postdata = input post data 
	    | @id       = current id 
	    | 
	    */
	    public function hook_before_edit(&$postdata,$id) {        
	        //Your code here

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command after edit public static function called
	    | ----------------------------------------------------------------------     
	    | @id       = current id 
	    | 
	    */
	    public function hook_after_edit($id) {
	        //Your code here 

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command before delete public static function called
	    | ----------------------------------------------------------------------     
	    | @id       = current id 
	    | 
	    */
	    public function hook_before_delete($id) {
	        //Your code here

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command after delete public static function called
	    | ----------------------------------------------------------------------     
	    | @id       = current id 
	    | 
	    */
	    public function hook_after_delete($id) {
	        //Your code here

	    }



	    //By the way, you can still create your own method in here... :) 


	}