@extends('layouts.main')

@section('header')
@section('title') My List @stop
@stop

<?php $list_names = ['today', 'tomorrow', 'week', 'twoweeks', 'month', 'year', 'someday'] ?>

@section('body')

@if (isset($message))
<h4 style="color: green">{{ $message }}</h4>
@endif

@if (isset($hasTasks))
	<div id="content">
		<!-- LIST selector (triggers reload) -->
		<div class="row col-sm-offset-1">
			<select class="center" id="task-list">
				@if (isset($list_selected) == false || $list_selected == 0)
					<option value="0" selected="selected">All Tasks</option>
				@else
					<option value="0">All Tasks</option>
				@endif

				@if (isset($hasLists))
					@foreach ($lists as $list)
						@if (isset($list_selected) && $list_selected == $list->id)
							<option value="{{ $list->id }}" selected="selected">{{ $list->name }}</option>
						@else	
							<option value="{{ $list->id }}">{{ $list->name }}</option>
						@endif
					@endforeach
				@endif
				<option value="new">Create New List...</option>
			</select>
		</div>

		<!-- TODAY row -->
		<div class="row task-row" id="today-row">
			<div class="col-sm-10">
				@if (sizeof($today))
					<h1>Today <a class="btn btn-primary btn-add pull-right" href="{{ URL::to('task/add/'.$list_selected) }}">+ Task</a></h1>
					<ul class="task-list" class="task-list">
						@foreach ($today as $task)
							<div class="task-item">	
								<li class="task-entry">
									<p class="no-indent">{{ $task->name }}</p>
									<div class="task-actions hidden">
										<p class="pull-right"> <a style="color: red" href="{{ URL::to('task/remove/'.$task->id.'/'.$list_selected) }}"><span class="glyphicon glyphicon-remove"></span>	</a></p>
										<p class="pull-right"> <a style="color: gray" href="{{ URL::to('task/edit/'.$task->id.'/'.$list_selected) }}"><span class="glyphicon glyphicon-wrench"></span></a> |</p>
										<p class="pull-right"> <a href="{{ URL::to('task/down/'.$task->id.'/'.$list_selected) }}"><span class="glyphicon glyphicon-chevron-down"></span></a> |</p>
										<p class="pull-right"> <a style="color: orange" href="{{ URL::to('task/up/'.$task->id.'/'.$list_selected) }}"><span class="glyphicon glyphicon-chevron-up"></span></a> |</p>
										<p class="pull-right"> <a style="color: green" href="{{ URL::to('task/mark/'.$task->id.'/'.$list_selected) }}"><span class="glyphicon glyphicon-ok"></span></a> |</p>
									</div>
								</li>
							</div>	
						<br>
						@endforeach
					</ul>
					<div class="drop-zone">	<!-- handles dropped tasks -->
						<p class="drag-message text-center"></p>
					</div>	

		
				@elseif ($hide_empty == false)
				<h1 style="color: #999">Today <a class="btn btn-primary btn-add pull-right"" href="{{ URL::to('task/add/'.$list_selected) }}">+ Task</a></h1>
				<ul class="task-list"></ul>
				<p class="drag-message text-center">Drag here to add.</p>
				<hr/>
				@endif
			</div>
		</div>
		<hr/>

		<!-- TOMORROW row -->
		<div class="row task-row" id="tomorrow-row">
			<div class="col-sm-10">
				@if (sizeof($tomorrow))
					<h1>Tomorrow <a class="btn btn-primary btn-add pull-right"" href="{{ URL::to('task/add/'.$list_selected.'/tomorrow') }}">+ Task</a></h1>
					<ul class="task-list" class="task-list">
						@foreach ($tomorrow as $task)
							<div class="task-item">	
								<li class="task-entry">
									<p class="no-indent">{{ $task->name }}</p>
									<div class="task-actions hidden">
										<p class="pull-right"> <a style="color: red" href="{{ URL::to('task/remove/'.$task->id.'/'.$list_selected) }}"><span class="glyphicon glyphicon-remove"></span>	</a></p>
										<p class="pull-right"> <a style="color: gray" href="{{ URL::to('task/edit/'.$task->id.'/'.$list_selected) }}"><span class="glyphicon glyphicon-wrench"></span></a> |</p>
										<p class="pull-right"> <a href="{{ URL::to('task/down/'.$task->id.'/'.$list_selected) }}"><span class="glyphicon glyphicon-chevron-down"></span></a> |</p>
										<p class="pull-right"> <a style="color: orange" href="{{ URL::to('task/up/'.$task->id.'/'.$list_selected) }}"><span class="glyphicon glyphicon-chevron-up"></span></a> |</p>
										<p class="pull-right"> <a style="color: green" href="{{ URL::to('task/mark/'.$task->id.'/'.$list_selected) }}"><span class="glyphicon glyphicon-ok"></span></a> |</p>
									</div>
								</li>
							</div>	
						<br>
						@endforeach
					</ul>
			<hr/>

		
				@elseif ($hide_empty == false)
				<h1 style="color: #999">Tomorrow <a class="btn btn-primary btn-add pull-right"" href="{{ URL::to('task/add/'.$list_selected.'/tomorrow') }}">+ Task</a></h1>
				<ul class="task-list"></ul>
				<p class="drag-message text-center">Drag here to add.</p>
				<hr/>
				@endif
			</div>
		</div>

		<!-- WEEK row -->
		<div class="row task-row" id="week-row">
			<div class="col-sm-10">
				@if (sizeof($week))
					<h1>This Week <a class="btn btn-primary btn-add pull-right"" href="{{ URL::to('task/add/'.$list_selected.'/week') }}">+ Task</a></h1>
					<ul class="task-list">
						@foreach ($week as $task)
							<div class="task-item">	
								<li class="task-entry">
									<p class="no-indent">{{ $task->name }}</p>
									<div class="task-actions hidden">
										<p class="pull-right"> <a style="color: red" href="{{ URL::to('task/remove/'.$task->id.'/'.$list_selected) }}"><span class="glyphicon glyphicon-remove"></span>	</a></p>
										<p class="pull-right"> <a style="color: gray" href="{{ URL::to('task/edit/'.$task->id.'/'.$list_selected) }}"><span class="glyphicon glyphicon-wrench"></span></a> |</p>
										<p class="pull-right"> <a href="{{ URL::to('task/down/'.$task->id.'/'.$list_selected) }}"><span class="glyphicon glyphicon-chevron-down"></span></a> |</p>
										<p class="pull-right"> <a style="color: orange" href="{{ URL::to('task/up/'.$task->id.'/'.$list_selected) }}"><span class="glyphicon glyphicon-chevron-up"></span></a> |</p>
										<p class="pull-right"> <a style="color: green" href="{{ URL::to('task/mark/'.$task->id.'/'.$list_selected) }}"><span class="glyphicon glyphicon-ok"></span></a> |</p>
									</div>
								</li>
							</div>	
						<br>
						@endforeach
					</ul>
			<hr/>

		
				@elseif ($hide_empty == false)
				<h1 style="color: #999">This Week <a class="btn btn-primary btn-add pull-right"" href="{{ URL::to('task/add/'.$list_selected.'/week') }}">+ Task</a></h1>
				<ul class="task-list"></ul>
				<p class="drag-message text-center">Drag here to add.</p>
				<hr/>
				@endif
			</div>
		</div>

		<!-- TWO WEEKS row -->
		<div class="row task-row" id="twoweeks-row">
			<div class="col-sm-10">
				@if (sizeof($twoweeks))
					<h1>Next Two Weeks <a class="btn btn-primary btn-add pull-right"" href="{{ URL::to('task/add/'.$list_selected.'/twoweeks') }}">+ Task</a></h1>
					<ul class="task-list">
						@foreach ($twoweeks as $task)
							<div class="task-item">	
								<li class="task-entry">
									<p class="no-indent">{{ $task->name }}</p>
									<div class="task-actions hidden">
										<p class="pull-right"> <a style="color: red" href="{{ URL::to('task/remove/'.$task->id.'/'.$list_selected) }}"><span class="glyphicon glyphicon-remove"></span>	</a></p>
										<p class="pull-right"> <a style="color: gray" href="{{ URL::to('task/edit/'.$task->id.'/'.$list_selected) }}"><span class="glyphicon glyphicon-wrench"></span></a> |</p>
										<p class="pull-right"> <a href="{{ URL::to('task/down/'.$task->id.'/'.$list_selected) }}"><span class="glyphicon glyphicon-chevron-down"></span></a> |</p>
										<p class="pull-right"> <a style="color: orange" href="{{ URL::to('task/up/'.$task->id.'/'.$list_selected) }}"><span class="glyphicon glyphicon-chevron-up"></span></a> |</p>
										<p class="pull-right"> <a style="color: green" href="{{ URL::to('task/mark/'.$task->id.'/'.$list_selected) }}"><span class="glyphicon glyphicon-ok"></span></a> |</p>
									</div>
								</li>
							</div>	
						<br>
						@endforeach
					</ul>
			<hr/>

		
				@elseif ($hide_empty == false)
				<h1 style="color: #999">Next Two Weeks <a class="btn btn-primary btn-add pull-right"" href="{{ URL::to('task/add/'.$list_selected.'/twoweeks') }}">+ Task</a></h1>
				<ul class="task-list"></ul>
				<p class="drag-message text-center">Drag here to add.</p>
				<hr/>
				@endif
			</div>
		</div>

		<!-- MONTH row -->
		<div class="row task-row" id="month-row">
			<div class="col-sm-10">
				@if (sizeof($month))
					<h1>This Month <a class="btn btn-primary btn-add pull-right"" href="{{ URL::to('task/add/'.$list_selected.'/month') }}">+ Task</a></h1>
					<ul class="task-list">
						@foreach ($month as $task)
							<div class="task-item">	
								<li class="task-entry">
									<p class="no-indent">{{ $task->name }}</p>
									<div class="task-actions hidden">
										<p class="pull-right"> <a style="color: red" href="{{ URL::to('task/remove/'.$task->id.'/'.$list_selected) }}"><span class="glyphicon glyphicon-remove"></span>	</a></p>
										<p class="pull-right"> <a style="color: gray" href="{{ URL::to('task/edit/'.$task->id.'/'.$list_selected) }}"><span class="glyphicon glyphicon-wrench"></span></a> |</p>
										<p class="pull-right"> <a href="{{ URL::to('task/down/'.$task->id.'/'.$list_selected) }}"><span class="glyphicon glyphicon-chevron-down"></span></a> |</p>
										<p class="pull-right"> <a style="color: orange" href="{{ URL::to('task/up/'.$task->id.'/'.$list_selected) }}"><span class="glyphicon glyphicon-chevron-up"></span></a> |</p>
										<p class="pull-right"> <a style="color: green" href="{{ URL::to('task/mark/'.$task->id.'/'.$list_selected) }}"><span class="glyphicon glyphicon-ok"></span></a> |</p>
									</div>
								</li>
							</div>	
						<br>
						@endforeach
					</ul>
			<hr/>

		
				@elseif ($hide_empty == false)
				<h1 style="color: #999">This Month <a class="btn btn-primary btn-add pull-right"" href="{{ URL::to('task/add/'.$list_selected.'/month') }}">+ Task</a></h1>
				<ul class="task-list"></ul>
				<p class="drag-message text-center">Drag here to add.</p>
				<hr/>
				@endif
			</div>
		</div>

		<!-- YEAR row -->
		<div class="row task-row" id="year-row">
			<div class="col-sm-10">
				@if (sizeof($year))
					<h1>This Year <a class="btn btn-primary btn-add pull-right"" href="{{ URL::to('task/add/'.$list_selected.'/year') }}">+ Task</a></h1>
					<ul class="task-list">
						@foreach ($year as $task)
							<div class="task-item">	
								<li class="task-entry">
									<p class="no-indent">{{ $task->name }}</p>
									<div class="task-actions hidden">
										<p class="pull-right"> <a style="color: red" href="{{ URL::to('task/remove/'.$task->id.'/'.$list_selected) }}"><span class="glyphicon glyphicon-remove"></span>	</a></p>
										<p class="pull-right"> <a style="color: gray" href="{{ URL::to('task/edit/'.$task->id.'/'.$list_selected) }}"><span class="glyphicon glyphicon-wrench"></span></a> |</p>
										<p class="pull-right"> <a href="{{ URL::to('task/down/'.$task->id.'/'.$list_selected) }}"><span class="glyphicon glyphicon-chevron-down"></span></a> |</p>
										<p class="pull-right"> <a style="color: orange" href="{{ URL::to('task/up/'.$task->id.'/'.$list_selected) }}"><span class="glyphicon glyphicon-chevron-up"></span></a> |</p>
										<p class="pull-right"> <a style="color: green" href="{{ URL::to('task/mark/'.$task->id.'/'.$list_selected) }}"><span class="glyphicon glyphicon-ok"></span></a> |</p>
									</div>
								</li>
							</div>	
						<br>
						@endforeach
					</ul>
			<hr/>

		
				@elseif ($hide_empty == false)
				<h1 style="color: #999">This Year <a class="btn btn-primary btn-add pull-right"" href="{{ URL::to('task/add/'.$list_selected.'/year') }}">+ Task</a></h1>
				<ul class="task-list"></ul>
				<p class="drag-message text-center">Drag here to add.</p>
				<hr/>
				@endif
			</div>
		</div>

		<!-- SOMEDAY row -->
		<div class="row task-row" id="someday-row">
			<div class="col-sm-10">
				@if (sizeof($someday))
					<h1>Someday <a class="btn btn-primary btn-add pull-right"" href="{{ URL::to('task/add/'.$list_selected.'/someday') }}">+ Task</a></h1>
					<ul class="task-list">
						@foreach ($someday as $task)
							<div class="task-item">	
								<li class="task-entry">
									<p class="no-indent">{{ $task->name }}</p>
									<div class="task-actions hidden">
										<p class="pull-right"> <a style="color: red" href="{{ URL::to('task/remove/'.$task->id.'/'.$list_selected) }}"><span class="glyphicon glyphicon-remove"></span>	</a></p>
										<p class="pull-right"> <a style="color: gray" href="{{ URL::to('task/edit/'.$task->id.'/'.$list_selected) }}"><span class="glyphicon glyphicon-wrench"></span></a> |</p>
										<p class="pull-right"> <a href="{{ URL::to('task/down/'.$task->id.'/'.$list_selected) }}"><span class="glyphicon glyphicon-chevron-down"></span></a> |</p>
										<p class="pull-right"> <a style="color: orange" href="{{ URL::to('task/up/'.$task->id.'/'.$list_selected) }}"><span class="glyphicon glyphicon-chevron-up"></span></a> |</p>
										<p class="pull-right"> <a style="color: green" href="{{ URL::to('task/mark/'.$task->id.'/'.$list_selected) }}"><span class="glyphicon glyphicon-ok"></span></a> |</p>
									</div>
								</li>
							</div>	
						<br>
						@endforeach
					</ul>
			<hr/>

		
				@elseif ($hide_empty == false)
				<h1 style="color: #999">Someday <a class="btn btn-primary btn-add pull-right"" href="{{ URL::to('task/add/'.$list_selected.'/someday') }}">+ Task</a></h1>
				<ul class="task-list"></ul>
				<p class="drag-message text-center">Drag here to add.</p>
				<hr/>
				@endif
			</div>
		</div>
		
		<!-- COMPLETE row -->
		<div class="row task-row">
			<div class="col-sm-10">
				@if (sizeof($complete))
					<h1>Completed <a class="btn btn-default pull-right" href="{{ URL::to('task/add/'.$list_selected.'/complete') }}">+ Task</a></h1>
					<ul class="task-list">
						@foreach ($complete as $task)
							<div class="task-item">
								<li class="task-entry">
									<p class="no-indent">{{ $task->name }}</p>
									<div class="task-actions hidden">
										<p class="pull-right"> <a style="color: red" href="{{ URL::to('task/remove/'.$task->id.'/'.$list_selected) }}"><span class="glyphicon glyphicon-remove"></span>	</a></p>
										<p class="pull-right"> <a style="color: purple" href="{{ URL::to('task/unmark/'.$task->id.'/'.$list_selected) }}"><span class="glyphicon glyphicon-erase"></span></a> |</p>
										<br>
									</div>
										<p style="color: #999">(Completed on {{$task->date_complete }}) </p>
								</li>
							</div>	
							<br>
						@endforeach
					</ul>
			<hr/>

		
				@elseif ($hide_empty == false)
				<h1 style="color: #999">Completed <a class="btn btn-default pull-right" href="{{ URL::to('task/add/'.$list_selected.'/complete') }}">+ Task</a></h1>
				<ul class="task-list"></ul>
				<p class="drag-message text-center"></p>
				<hr/>
				@endif
			</div>
		</div>
		
		@else
		<h1>You don't have any tasks scheduled.</h1>

		@endif
	</div>
	</div>
	</div> <!-- END Content -->

@stop