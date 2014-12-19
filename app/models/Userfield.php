<?php

use Carbon\Carbon;

class Userfield extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'userfields';
	protected $primaryKey = 'fieldid';
	
	//Get all userfields..
	public static function get_userfields(){
		return DB::table('userfields')->select(array('fieldid',DB::raw('COALESCE(content, title) AS label')))->get();	
	}

	//Get userfield by id..
	public static function get_userfield_by_id($fieldId){
		return DB::table('userfields')->select('fieldid',DB::raw('COALESCE(content, title) AS name'),'position','flags','permit')->where('fieldid', $fieldId)->get();
	}

	//update userfields.....
	public static function update_userfields(){
		$inonregister=(int)Input::get('onregister');
		$intype = (int)Input::get('type');
		$inflags = $intype | ($inonregister ? Config::get('constants.QA_FIELD_FLAGS_ON_REGISTER'): 0);		
		$inposition =  Input::get('position');
		DB::table('userfields')
            ->where('fieldid',Input::get('fieldid'))
            ->update(array('content' => Input::get('name'),
            				'permit' => Input::get('permit'),
            				'position' => $inposition ,
            				'flags' => $inflags));
	}

	//Add userfields....
	public static function add_userfields(){
		$inonregister=(int)Input::get('onregister');
		$intype = (int)Input::get('type');
		$inflags = $intype | ($inonregister ? Config::get('constants.QA_FIELD_FLAGS_ON_REGISTER'): 0);		
		$inposition =  Input::get('position');
		DB::table('userfields')->insert(
	    	array('content' => Input::get('name'), 'permit' => Input::get('permit') , 'position' => $inposition ,'flags' => $inflags)
		);
	}
}