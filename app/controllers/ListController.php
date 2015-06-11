<?php

class ListController extends BaseController {

	public function showLists() 
	{
		$myLists = $this->getUserLists();
		return View::make('show_lists')->with('lists', $myLists);
	}

	public function addForm()
	{
		return View::make('add_list');
	}

	public function processAdd() 
	{
		$list = new TaskList;
		$list->user_id = Auth::user()->id;
		$list->name = Input::get('name');
		$list->save();		

		return Redirect::to('list/add')->with('message', '\'' . $list->name . '\' added to list list');
	}

	public function editForm($id) 
	{
		$list = TaskList::findOrFail($id);
		
		if ($list->user_id != Auth::user()->id) {
			return Redirect::to('/list');
		}

		return View::make('edit_list')->with('list', $list);
	}

	public function processEdit($id) 
	{
		$list = TaskList::findOrFail($id);

		if ($list->user_id != Auth::user()->id) {
			return Redirect::to('/list');
		}

		$list->name = Input::get('name');
		$list->save();		

		return View::make('edit_list')->with(
			array(
				'message' => 'Changes to \'' . Input::get('name') . '\' were saved.',
				'list' => $list
			)	
		);
	}

	public function removeForm($id) {
		$list = TaskList::findOrFail($id);

		if ($list->user_id != Auth::user()->id) {
			return Redirect::to('task/list');
		}

		return View::make('remove_list')->with('list', $list);
	}

	public function processRemoval($id) {
		$list = TaskList::findOrFail($id);
		if ($list->user_id != Auth::user()->id) {
			return Redirect::to('/list');
		}
		$list->delete();

		return Redirect::to('/list')->with('message', '\'' . $list->name . '\' deleted');
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
