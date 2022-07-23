<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use App\Http\Requests\TaskStoreRequest;
use App\Models\Task as Task;

/**
 * @OA\Info(title="My First API", version="0.1")
 */
/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="Laravel Test OpenApi",
 *      description="L5 Swagger OpenApi description",
 *      @OA\Contact(
 *          email="aleinfo19@gmail.com"
 *      ),
 *     @OA\License(
 *         name="Apache 2.0",
 *         url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *     )
 * )
 */
/**
 *  @OA\Server(
 *      url=L5_SWAGGER_CONST_HOST,
 *      description="L5 Swagger OpenApi dynamic host server"
 *  )
 *
 *  @OA\Server(
*      url="http://localhost:8000/api/",
 *      description="L5 Swagger OpenApi Server"
 * )
 */

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Get(
     *      path="/tasks",
     *      operationId="getTasksList",
     *      tags={"tooks"},
     *      summary="Get list of TASKS",
     *      description="Returns list of tasks",
     *      @OA\Response(
     *          response=200,
     *          description="successful operation"
     *       ),
     *       @OA\Response(response=400, description="Bad request"),
     *     )
     *
     * Returns list of books
     */
    public function index()
    {
    // All Tasks
    $tasks = Task::all();

    // Return Json Response
    return response()->json([
        'tasks' => $tasks
    ],200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskStoreRequest $request)
    {
        try {

            // Create Task
            Task::create([
                'title' => $request->title,
                'done' => false,
                'user' => $request->user
            ]);

            // Return Json Response
            return response()->json([
                'message' => "Task successfully created."
            ],200);
        } catch (\Exception $e) {
            // Return Json Response
            return response()->json([
                'message' => "Something went wrong"
            ],500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       // Task Detail 
       $task = Task::find($id);
       if(!$task){
         return response()->json([
            'message'=>'Task Not Found.'
         ],404);
       }
    
       // Return Json Response
       return response()->json([
          'task' => $task
       ],200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
 * Update the specified resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
public function update(TaskStoreRequest $request, $id)
{
    try {
        // Find Task
        $task = Task::find($id);
        if(!$task){
          return response()->json([
            'message'=>'Task Not Found.'
          ],404);
        }

        $task->title = $request->title;
        $task->done = $request->done;
        $task->user = $request->user;

        // Update Task
        $task->save();

        // Return Json Response
        return response()->json([
            'message' => "Task successfully updated."
        ],200);
    } catch (\Exception $e) {
        // Return Json Response
        return response()->json([
            'message' => "Something went wrong! "
        ],500);
    }
}

    /**
 * Remove the specified resource from storage.
 *
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
    public function destroy($id)
    {
        // Task Detail 
        $task = Task::find($id);
        if(!$task){
        return response()->json([
            'message'=>'Task Not Found.'
        ],404);
        }

        // Delete Task
        $task->delete();

        // Return Json Response
        return response()->json([
            'message' => "Task successfully deleted."
        ],200);
    }

        /**
 * Remove all the resources from storage.
 *
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
public function clear()
{
    // Task Detail 
    // $task = Task::find($id);
    // if(!$task){
    // return response()->json([
    //     'message'=>'Task Not Found.'
    // ],404);
    // }

    $task = Task::all();

    foreach($task as $value){
        $value->delete();
    }

    // Return Json Response
    return response()->json([
        'message' => "Task successfully deleted."
    ],200);
}
}
