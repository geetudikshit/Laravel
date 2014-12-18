<?php

use Carbon\Carbon;

class Category extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'categories';

	public static function get_categories(){
		return DB::table('categories')->get();	
	}

	public static function add_category(){
		$position_sql = 'SELECT COALESCE(MAX(position), 0) as pos FROM '.DB::getTablePrefix().'categories WHERE parentid<=>NULL';
		$position_result = DB::select($position_sql);
		$position_result = $position_result[0];
		//print_r($position_result[0]['pos']);die;
		/*DB::insert('insert into '.DB::getTablePrefix().'categories (parentid, title,tags,position,content) values (?, ?,?,?,?)', array(NULL, Input::get('name'),Input::get('name'),$position_result->pos,Input::get('content')));*/

		DB::table('categories')->insertGetId(
		    array('parentid' => NULL,
		    	'title' => Input::get('tags'),
		 		'tags' => Input::get('tags'),
		 		'position' => $position_result->pos,
		 		'content' => Input::get('content'))
			);
	}

	public static function getCategoryId($title){
		return DB::table('categories')
			->where('title',$title)
			->get(array('categoryid'));	
	}
}