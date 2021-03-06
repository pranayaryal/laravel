<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use Illuminate\Database\Eloquent\Model;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\TodoList;
use App\TodoItem;
use Illuminate\Support\Facades\Input;
use Redirect;
use Validator;
use Illuminate\Support\MessageBag;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;


class TodoListController extends Controller
{
    public function _construct()
    {
        $this->middleware('auth');
        $this->beforeFilter('csrf',array('on' => ['post','put']));
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
       
       $todo_lists = TodoList::all();
       return View::make('todos.index') -> with('todo_lists', $todo_lists);

       
       
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        
        return View::make('todos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //define rules for validation
        $rules = array(
                'name' => array('required','unique:todo_lists')
            );
        //pass input to rules using validarot class
        $validator = Validator::make(Input::all(), $rules);

        //test validity
        if ($validator->fails()){
            
            return Redirect::route('todos.create')->withErrors($validator)->withInput();
        }
        $name = Input::get('name');
        $list = new TodoList();
        $list->name = $name;
        $list -> save();
        return Redirect::route('todos.index')->withMessage('List Was Created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $list = TodoList::findOrFail($id);
        $items = $list->listItems()->get();
        //return $items;
        return View::make('todos.show')
            ->withList($list)
            ->withItems($items);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $list = TodoList::findOrFail($id);
        return View::make('todos.edit')->withList($list);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {

        //define rules for validation
        $rules = array(
                'name' => array('required','unique:todo_lists')
            );
        //pass input to rules using validarot class
        $validator = Validator::make(Input::all(), $rules);

        //test validity
        if ($validator->fails()){
            
            return Redirect::route('todos.edit',$id)->withErrors($validator)->withInput();
        }
        $name = Input::get('name');
        $list = TodoList::findOrFail($id);
        $list->name = $name;
        $list -> update();
        return Redirect::route('todos.index')->withMessage('List Was Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $todo_list = TodoList::findOrFail($id)->delete();

        return Redirect::route('todos.index')->withMessage('Item Deleted');
    }
}
