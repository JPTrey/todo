<?php

class TaskController extends BaseController {

	public function showTasks($list_id = 0) {
		$tasks = $this->getUserTasks();
		$myLists = $this->getUserLists();
		
		// if: user request specific list, check if user has access
		if ($list_id != 0) {
			$hasAccess = false;
			foreach ($myLists as $list) {
				
				// if: requested list has same user_id as user, grant access
				if ($list->id == $list_id && $list->user_id == Auth::user()->id) {
					$hasAccess = true;
					break;
				}
			}

			if ($hasAccess == false) {
				$list_id = 0;
			}
		}

		if (isset($tasks)) {
			$hasTasks = true;

			if ($list_id != 0) {
				$list_selected = $list_id;
			} else {
				$list_selected = 0;
			}

			// organize tasks by priority
			$today 			= [];
			$tomorrow 		= [];
			$week 			= [];
			$twoweeks 		= [];
			$month 			= [];
			$year 			= [];
			$someday 		= [];
			$complete 		= [];

			foreach ($tasks as $task) {
				if ($task->complete) {
					if ($list_id == 0 || $list_id == $task->list_id) {
						$complete[] = $task;
					}
				
				} else {
					switch ($task->priority) {
						case 'today':
							if ($list_id == 0 || $list_id == $task->list_id) {
								$today[] = $task;
							}
							break;
						case 'tomorrow':
							if ($list_id == 0 || $list_id == $task->list_id) {
								$tomorrow[] = $task;
							}
							break;
						case 'week':
							if ($list_id == 0 || $list_id == $task->list_id) {
								$week[] = $task;
							}
							break;
						case 'twoweeks':
							if ($list_id == 0 || $list_id == $task->list_id) {
								$twoweeks[] = $task;
							}
							break;
						case 'month':
							if ($list_id == 0 || $list_id == $task->list_id) {
								$month[] = $task;
							} 
							break;
						case 'year':
							if ($list_id == 0 || $list_id == $task->list_id) {
								$year[] = $task;
							}
							break;
						case 'someday':
							if ($list_id == 0 || $list_id == $task->list_id) {
								$someday[] = $task;
							}
							break;
						default:
							// ignore
							break;
					}
				}
			}
		}

		if (isset($myLists)) {
			$hasLists = true;
		}

		return View::make('show_tasks')->with(
		array(
			'hasTasks' => $hasTasks,
			'hasLists' => $hasLists,
			'list_selected' => $list_selected,
			'today' => $today,
			'tomorrow' => $tomorrow,
			'week' => $week,
			'twoweeks' => $twoweeks,
			'month' => $month,
			'year' => $year,
			'someday' => $someday,
			'complete' => $complete,
			'lists' => $myLists,
			'hide_empty' => Auth::user()->hide_empty
		));
	}

	// GET: /task/add/{section?}
	public function showForm($list_id = 0, $section = 'today') {
		$myLists = $this->getUserLists();

		// edge cases
		$marked = false;
		if ($section == 'twoweeks') {
			$section = 'two weeks';
		}
		else if ($section == 'complete') {
			$marked = true;
			$section = 'today';
		}

		return View::make('add_task')->with(
			array(
				'section' => $section, 
				'marked' => $marked,
				'list_id' => $list_id,
				'lists' => $myLists
			)
		);
	}

	// POST: /task/add/
	public function processForm($list_id = 0) {
		$task = new Task;
		$task->user_id = Auth::user()->id;
		$task->name = Input::get('name');
		$task->list_id = Input::get('list');
		
		$priority = Input::get('priority');
		if ($priority == 'two weeks') {
			$priority = 'twoweeks';
		}
		$task->priority = $priority;
		
		if (Input::get('complete') != null) {
			$task->complete = Input::get('complete');
			$now = new DateTime(null, new DateTimeZone('America/New_York'));
			$task->date_complete = $now->format('Y-m-d H:i:s'); 
		} 
		else {
			$task->date_complete = mktime(0,0,0);
		}

		$task->save();		

		return Redirect::to('task/list/'.$list_id)->with('message', '\'' . $task->name . '\' added to Task list');
	}

	public function editTask($id, $list_id = 0) {
		$task = Task::findOrFail($id);
		$myLists = $this->getUserLists();
		if ($task->user_id != Auth::user()->id) {
			return Redirect::to('task/list');
		}

		return View::make('edit_task')->with(
			array(
				'task' => $task,
				'list_id' => $list_id,
				'lists' => $myLists
			)
		);
	}

	public function processEdit($id, $list_id) {
		$task = Task::findOrFail($id);
		if ($task->user_id != Auth::user()->id) {
			return Redirect::to('task/list');
		}

		$task->name = Input::get('name');
		$task->list_id = Input::get('list');
		$task->priority = Input::get('priority');
		$task->complete = Input::get('complete');
		$task->save();		

		return View::make('edit_task')->with(
			array(
				'task' => $task, 
				'message' => 'Changes to \'' . Input::get('name') . '\' were saved.',
				'list_id' => $list_id,
				'lists' => $this->getUserLists()
			)
		);
	}

	
	// GET: /task/up/{id}
	public function pushUp($id, $list_id = 0) {
		$task = Task::findOrFail($id);
		if ($task->user_id != Auth::user()->id) {
			return Redirect::to('task/list/'.$list_id);
		}

		switch ($task->priority) {
			case 'tomorrow':
				$task->priority = 'today';
				break;
			
			case 'week':
				$task->priority = 'tomorrow';
				break;
				
			case 'twoweeks':
				$task->priority = 'week';
				break;
			
			case 'month':
				$task->priority = 'twoweeks';
				break;

			case 'year':
				$task->priority = 'month';
				break;
				
			case 'someday':
				$task->priority = 'year';
				break;					

			default:
				// do nothing
				break;
		}

		$task->save();
		return Redirect::to('task/list/'.$list_id);
	}

	// GET: /task/down/{id}
	public function pushDown($id, $list_id = 0) {
		$task = Task::findOrFail($id);
		if ($task->user_id != Auth::user()->id) {
			return Redirect::to('task/list/'.$list_id);
		}

		switch ($task->priority) {
			case 'today':
				$task->priority = 'tomorrow';
				break;		

			case 'tomorrow':
				$task->priority = 'week';
				break;
			
			case 'week':
				$task->priority = 'twoweeks';
				break;
				
			case 'twoweeks':
				$task->priority = 'month';
				break;
			
			case 'month':
				$task->priority = 'year';
				break;

			case 'year':
				$task->priority = 'someday';
				break;			

			default:
				// do nothing
				break;
		}

		$task->save();
		return Redirect::to('task/list/'.$list_id);
	}

	// GET: task/mark/{id}
	public function markComplete($id, $list_id = 0) {
		$task = Task::findOrFail($id);
		if ($task->user_id == Auth::user()->id) {
			$task->complete = true;
			$now = new DateTime(null, new DateTimeZone('America/New_York'));
			$task->date_complete = $now->format('Y-m-d H:i:s'); 
			$task->save();
		}

		return Redirect::to('task/list/'.$list_id);
	}

	// GET: task/unmark/{id}
	public function unmarkComplete($id, $list_id = 0) {
		$task = Task::findOrFail($id);
			if ($task->user_id == Auth::user()->id) {
			$task->complete = false;
			$task->date_complete = mktime(0,0,0);
			$task->save();
		}

		return Redirect::to('task/list/'.$list_id);
	}

	// GET: task/remove/{id}
	public function removeConfirm($id, $list_id = 0) {
		$task = Task::findOrFail($id);
		if ($task->user_id != Auth::user()->id) {
			return Redirect::to('task/list');
		}
		else if (Auth::user()->fast_remove) {
			$this->processRemoval($id);
			return Redirect::to('task/list/'.$list_id)->with('message', '\'' . $task->name . '\' deleted');
		} 
		else {
			return View::make('remove_task')->with(
				array(
					'task' => $task,
					'list_id' => $list_id
				)
			);
		}
	}

	// POST: task/remove/{id}
	public function processRemoval($id, $list_id = 0) {
		$task = Task::findOrFail($id);
		if ($task->user_id != Auth::user()->id) {
			return Redirect::to('task/list/'.$list_id);
		}
		$task->delete();

		return Redirect::to('task/list/'.$list_id)->with('message', '\'' . $task->name . '\' deleted');
	}

	// helper functions

	private function getUserTasks() {
		// get all user tasks
		$all_tasks = Task::all();
		$tasks = [];

		foreach ($all_tasks as $task) {
			if ($task->user_id == Auth::user()->id) {
				$tasks[] = $task;
			}
		}

		return $tasks;
	}

	private function getUserLists() {
		$all_lists = TaskList::all();
		$myLists = [];

		foreach ($all_lists as $list) {
			if ($list->user_id == Auth::user()->id) {
				$myLists[] = $list;
			}
		}

		return $myLists;
	}
}
