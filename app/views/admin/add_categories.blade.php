@extends('layouts.default')
@section('content')

<div class="qa-main">
	<h1>Administration center - Categories</h1>
	<div class="qa-part-form">
		<!--<form action="./index.php?qa=admin&amp;qa_1=categories" method="post">-->
		@if(isset($category))
		{{ Form::model($category, ['url' => 'admin/doCategory', 'method' => 'post']) }}
			<table class="qa-form-tall-table">
				<tbody id="name_display">
					<tr>
						<td class="qa-form-tall-label">
							{{ Form::label('Category_name','Category name:') }}	
						</td>
					</tr>
					<tr>
						<td class="qa-form-tall-data">
							<!--<input type="text" class="qa-form-tall-text" value="" id="name" name="name">-->
							{{ Form::text('tags', Input::old('tags'),array('class'=>'qa-form-tall-text','id'=>'tags')) }}
							@if ($errors->has('tags')) <div class="qa-form-tall-error">{{ $errors->first('tags') }}</div> @endif 
						</td>
					</tr>
				</tbody>
				<tbody id="content_display">
					<tr>
						<td class="qa-form-tall-label">
							{{ Form::label('Optional_category_description','Optional category description:') }}	
						</td>
					</tr>
					<tr>
						<td class="qa-form-tall-data">
							<!--<textarea class="qa-form-tall-text" cols="40" rows="2" name="content"></textarea>-->
							{{ Form::textarea('content', null, ['class' => 'qa-form-tall-text','cols'=>40,'rows'=>2]) }}
						</td>
					</tr>
				</tbody>
				<tbody id="parent_display">
					<tr>
						<td class="qa-form-tall-label">
							{{ Form::label('Parent_category','Parent category:') }}	
						</td>
					</tr>
					<tr>
						<td class="qa-form-tall-data">
							<span class="qa-form-tall-static"><a href="/admin/categories">No parent (top level)</a></span>
						</td>
					</tr>
				</tbody>
				<tbody id="position_display">
					<tr>
						<td class="qa-form-tall-label">
							{{ Form::label('Position','Position:') }}	
							&nbsp;
							<!--<select class="qa-form-tall-select" name="position">
								<option value="1">First</option>
								<option value="2">After "Test"</option>
								<option selected="" value="3">After "test1"</option>
							</select>-->
							{{ Form::select('position', $options, null, ['class' => 'qa-form-tall-select']) }}
						</td>
					</tr>
				</tbody>
				<tbody><tr>
					<td class="qa-form-tall-buttons" colspan="1">
						<!--<input type="submit" class="qa-form-tall-button qa-form-tall-button-save" title="" value="Add Category" id="dosaveoptions">
						<input type="submit" class="qa-form-tall-button qa-form-tall-button-cancel" title="" value="Cancel" name="docancel">-->
						{{ Form::submit('Add Category', array('class' => 'qa-form-tall-button qa-form-tall-button-save','id' => 'dosaveoptions')) }}
						{{ Form::submit('Cancel', array('class' => 'qa-form-tall-button qa-form-tall-button-cancel','name'=>'docancel')) }}
					</td>
				</tr>
			</tbody></table>			
		{{ Form::close() }}
	@endif
	</div>
</div>
@stop
