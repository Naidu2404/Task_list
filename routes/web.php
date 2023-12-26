<?php

use App\Http\Requests\TaskRequest;
use \App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */

Route::get('/', function () {
    return redirect()->route('tasks.index');
});

Route::get('/tasks',function () {
    return view('index', [
        'tasks' => Task::latest()->paginate(6),
    ]);
})->name('tasks.index');

//route to the create view
//placed above as the below route considers the create word as id
Route::view('/tasks/create', 'create')->name('tasks.create');

Route::get('/tasks/{task}',function (Task $task) {
    return view('show', [ 'task' => $task ]);
})->name('tasks.show');

//edit route
Route::get('/tasks/{task}/edit',function (Task $task) {
    return view('edit', [ 'task' => $task ]);
})->name('tasks.edit');

Route::put('/tasks/{task}/toggle-complete',function (Task $task) {
    $task->toggleComplete();
    return redirect()->back()->with('success','Task updated successfully');
})->name('tasks.toggle-complete');

//the below route is used as post so that it can be used as action in a form
Route::post('/tasks',function(TaskRequest $request) {
    // $data = $request->validated();

    // $task = new Task;

    // $task->title = $data['title'];
    // $task->description = $data['description'];
    // $task->long_description = $data['long_description'];

    // $task->save();

    $task = Task::create($request->validated());

    return redirect()->route('tasks.show',['task'=> $task->id ])
    ->with('success','Task created successfully');
})->name('tasks.store');

//put method for editing tha data
Route::put('/tasks/{task}',function(Task $task, TaskRequest $request) {
    // $data = $request->validated();


    // $task->title = $data['title'];
    // $task->description = $data['description'];
    // $task->long_description = $data['long_description'];

    // $task->save();

    $task->update($request->validated());

    return redirect()->route('tasks.show',['task'=> $task->id ])
    ->with('success','Task updated successfully');
})->name('tasks.update');


//route for deleteting data
Route::delete('/tasks/{task}',function(Task $task){
    $task->delete();
    return redirect()->route('tasks.index')->with('success','Task deleted successfully');
})->name('tasks.destroy');


//fallback route: which handle all the invalid routes
Route::fallback(function () {
    return 'Still here';
});


// //redirecting
// Route::get('/hlo', function () {
//     // return redirect('/hello');  nrml routing
//     return redirect()->route('hello');
// });

// //static route defining
// Route::get('/hello', function () {
//     return 'hello Page';
// })->name('hello'); //named as hello

// //dynamic route defining
// Route::get('/greet/{name}', function ($name) {
//     return 'Hello ' . $name . '!';
// });