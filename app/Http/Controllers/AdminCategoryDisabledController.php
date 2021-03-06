<?php namespace App\Http\Controllers;

	use Session;
	use DB;
	use CRUDBooster;
	use Illuminate\Http\Request;

	class AdminCategoryDisabledController extends \crocodicstudio\crudbooster\controllers\CBController {

	    public function cbInit() {

			# START CONFIGURATION DO NOT REMOVE THIS LINE
			$this->title_field = "id";
			$this->limit = "20";
			$this->orderby = "id,desc";
			$this->global_privilege = false;
			$this->button_table_action = true;
			$this->button_bulk_action = true;
			$this->button_action_style = "button_icon";
			$this->button_add = false;
			$this->button_edit = false;
			$this->button_delete = true;
			$this->button_detail = true;
			$this->button_show = true;
			$this->button_filter = true;
			$this->button_import = false;
			$this->button_export = false;
			$this->table = "category_disabled";
			# END CONFIGURATION DO NOT REMOVE THIS LINE

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"Category","name"=>"category_id","join"=>"category,name"];
			$this->col[] = ["label"=>"Event Name", "name"=>"category_id"];
			$this->col[] = ["label"=>"Participant Name","name"=>"participant_id","join"=>"participant,name"];
			# END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
			$this->form[] = ['label'=>'Event Name','name'=>'event_id','type'=>'select2','validation'=>'required|min:1|max:100','width'=>'col-sm-10','datatable'=>'event,name'];
			$this->form[] = ['label'=>'Category','name'=>'category_id','type'=>'select','validation'=>'required|min:1|max:100','width'=>'col-sm-10','datatable'=>'category,name','parent_select'=>'event_id'];
			$this->form[] = ['label'=>'Participant Name','name'=>'participant_id','type'=>'select','validation'=>'required|min:1|max:100','width'=>'col-sm-10','datatable'=>'participant,name','parent_select'=>'event_id'];
			# END FORM DO NOT REMOVE THIS LINE

			# OLD START FORM
			//$this->form = [];
			//$this->form[] = ["label"=>"Category Id","name"=>"category_id","type"=>"select2","required"=>TRUE,"validation"=>"required|min:1|max:255","datatable"=>"category,name"];
			//$this->form[] = ["label"=>"Participant Id","name"=>"participant_id","type"=>"select2","required"=>TRUE,"validation"=>"required|min:1|max:255","datatable"=>"participant,name"];
			# OLD END FORM

			/* 
	        | ---------------------------------------------------------------------- 
	        | Sub Module
	        | ----------------------------------------------------------------------     
			| @label          = Label of action 
			| @path           = Path of sub module
			| @foreign_key 	  = foreign key of sub table/module
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
	        if(Session::get('admin_privileges')==1){
	        	$this->index_button[] = ['label'=>'Add Selected Participant','url'=>CRUDBooster::mainpath("add_selected_participant"),"icon"=>"fa fa-check-square-o", "color"=>"success"];
	        }


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
	        | Include HTML Code before index table 
	        | ---------------------------------------------------------------------- 
	        | html code to display it before index table
	        | $this->pre_index_html = "<p>test</p>";
	        |
	        */
	        $this->pre_index_html = null;
	        
	        
	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | Include HTML Code after index table 
	        | ---------------------------------------------------------------------- 
	        | html code to display it after index table
	        | $this->post_index_html = "<p>test</p>";
	        |
	        */
	        $this->post_index_html = null;
	        
	        
	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | Include Javascript File 
	        | ---------------------------------------------------------------------- 
	        | URL of your javascript each array 
	        | $this->load_js[] = asset("myfile.js");
	        |
	        */
	        $this->load_js = array();
	        
	        
	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | Add css style at body 
	        | ---------------------------------------------------------------------- 
	        | css code in the variable 
	        | $this->style_css = ".style{....}";
	        |
	        */
	        $this->style_css = NULL;
	        
	        
	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | Include css File 
	        | ---------------------------------------------------------------------- 
	        | URL of your css each array 
	        | $this->load_css[] = asset("myfile.css");
	        |
	        */
	        $this->load_css = array();
	        
	        
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
	        $id_selected=$id_selected;
	        $button_name=$button_name;
	            
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
	    	if($column_index == 2) {
				$event = DB::table('category')
							->leftJoin('event', 'event.id', '=', 'category.event_id')
							->select('event.name')
							->where('category.id', $column_value)
							->first();
				$column_value = $event->name;
			}
	    }

	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate data input before add data is execute
	    | ---------------------------------------------------------------------- 
	    | @arr
	    |
	    */
	    public function hook_before_add(&$postdata) {        
	        unset($postdata['event_id']);

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command after add public static function called 
	    | ---------------------------------------------------------------------- 
	    | @id = last insert id
	    | 
	    */
	    public function hook_after_add($id_data) {        
	        //Your code here
	        $id_data=$id_data;

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
	    public function hook_after_edit($id_data) {
	        //Your code here 
	        $id_data=0;

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command before delete public static function called
	    | ----------------------------------------------------------------------     
	    | @id       = current id 
	    | 
	    */
	    public function hook_before_delete($id_data) {
	        //Your code here
	        $id_data=$id_data;

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command after delete public static function called
	    | ----------------------------------------------------------------------     
	    | @id       = current id 
	    | 
	    */
	    public function hook_after_delete($id_data) {
	        //Your code here
	        $id_data=$id_data;

	    }



	    //By the way, you can still create your own method in here... :) 
	    public function getDetail($id_data) {		  
		  $data = [];
		  $data['page_title'] = 'Draw: Detail Category Disabled';
		  $data['row'] = DB::table('category_disabled')
		  	->leftJoin('category', 'category.id', 'category_disabled.category_id')
		  	->leftJoin('participant', 'participant.id', 'category_disabled.participant_id')
		  	->where('category_disabled.id',$id_data)
		  	->select('category.name as category_name', 'participant.name as participant_name', 'category.event_id as event_id')
		  	->first();

		  	$data['event'] = DB::table('event')
		  		->where('id', $data['row']->event_id)
		  		->select('name')
		  		->first();
		  
		  return view('superadmin.detail_category_disabled', $data);
		}

	    public function addSelectedParticipant(){
	    	$data = [];
	    	$data['participant'] = DB::table('participant')
	    							->leftJoin('event','event.id','=','participant.event_id')
	    							->select('participant.*', 'event.id as event_id', 'event.name as event_name')
	    							->orderby('id','desc')
	    							->paginate(10);
	    	$data['event'] = DB::table('event')
	    		->whereNull('deleted_at')
	    		->orderby('name','asc')
	    		->get();
	    	$data['category'] = DB::table('category')->orderby('name','asc')->get();

	    	return view('superadmin.add_selected_participant', $data);
	    }

	    public function getCategory($id_data){
	    	$category = DB::table('category')
	    				->where('event_id', $id_data)
	    				->select('id', 'name')
	    				->get();
	    	return json_encode($category);
	    }

	    public function getParticipant($event, $category){
	    	$participant = DB::table('participant')
	    				->leftJoin('event','event.id','=','participant.event_id')
	    				->select('participant.*', 'event.id as event_id', 'event.name as event_name')
	    				->where('event_id', $event)
	    				->whereNotIn('participant.id', DB::table('category_disabled')->where('category_id', $category)->pluck('participant_id'))
	    				->get();
	    	return json_encode($participant);
	    }

	    public function saveDisabledCategory(Request $request){

	    	foreach ($request->input('selected_id') as $participant_id) {
	    		DB::table('category_disabled')->insert([
	    											'created_at' => date('Y-m-d H:i:s'),
	    											'category_id' => $request->input('category_id'),
	    											'participant_id' => $participant_id
	    										]);
	    	}
			CRUDBooster::redirect(CRUDBooster::mainpath(), "The Participant success add to disabled list !","info");
	    }

	}