@extends('layouts.default')
@section('content')

<div class="qa-main">
	<h1> Administration center - Categories  </h1>
	<div class="qa-part-form">
		@if(isset($categories_opt))
		{{ Form::model($categories_opt, ['url' => 'admin/doCategories', 'method' => 'post']) }}
			<table class="qa-form-tall-table">
				<tbody><tr>
					<td class="qa-form-tall-label">
						Top level categories:
					</td>
				</tr>
				<tr>
					<td class="qa-form-tall-data">
						<span class="qa-form-tall-static">
						@foreach ($categories as $key => $categorie)
							<a href="#">{{$categorie->title}}</a> - 0 questions<br>							
						@endforeach
						</span>
					</td>
				</tr>
				<tr>
					<td class="qa-form-tall-label">
						<label>
							<!--<input type="checkbox" class="qa-form-tall-checkbox" checked="" value="1" name="option_allow_no_category">-->
							{{ Form::checkbox('option_allow_no_category', 1, null, ['class' => 'qa-form-tall-checkbox']) }}
							Allow questions with no category
						</label>
					</td>
				</tr>
				<tr>
					<td class="qa-form-tall-label">
						<label>
							<!--<input type="checkbox" class="qa-form-tall-checkbox" value="1" name="option_allow_no_sub_category">-->
							{{ Form::checkbox('option_allow_no_sub_category', 1, null, ['class' => 'qa-form-tall-checkbox']) }}
							Allow questions with a category but no sub-category
						</label>
					</td>
				</tr>
				<tr>
					<td class="qa-form-tall-buttons" colspan="1">
						<!--<input type="submit" class="qa-form-tall-button qa-form-tall-button-save" title="" value="Save Changes" id="dosaveoptions" name="dosaveoptions">
						<input type="submit" class="qa-form-tall-button qa-form-tall-button-add" title="" value="Add Category" name="doaddcategory">-->
						{{ Form::submit('Save Changes', array('class' => 'qa-form-tall-button qa-form-tall-button-save','id' => 'dosaveoptions')) }}
						{{ Form::submit('Add Category', array('class' => 'qa-form-tall-button qa-form-tall-button-add','name'=>'doresetoptions')) }}
					</td>
				</tr>
			</tbody>
		</table>			
	{{ Form::close() }}
	@endif
	</div>
</div>
@stop
