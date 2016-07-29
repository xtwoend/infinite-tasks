<?php

namespace App\Http\Controllers;

use App\Entities\Task;
use App\Http\Requests;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    protected $tasks;
    public function __construct(Task $tasks)
    {
        config(['site.menu' => 'tasks', 'site.submenu' => 'all']);
        $this->tasks = $tasks;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('tasks.main');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tasks.create.main');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'date' => 'required',
        ]);

        $row = $this->tasks->create([
            'title' => $request->title,
            'description' => $request->description,
            'date' => $request->date,
            'priority' => $request->get('priority', 0),
            'status' => $request->get('status', 0),
        ]);

        return redirect()->route('tasks.index')->with('message', 'data berhasil di tambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * [quick description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function quick($id)
    {
        $row = $this->tasks->find($id);
        return view('tasks.edit.quick', compact('row'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $row = $this->tasks->find($id);
        return view('tasks.edit.main', compact('row'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'id' => 'exists:tasks',
        ]);

        $row = $this->tasks->find($id);
        $row->fill($request->all());
        $row->priority = $request->get('priority', 0);
        $row->status = $request->get('status', 0);
        $row->save();


        if ($request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'data berhasil di ubah',
            ], 200);
        }

        return redirect()->route('tasks.index')->with('message', 'data berhasil di ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if ($request->has('ids') && $request->ajax()) {
            $this->tasks->whereIn('id', $request->ids)->delete();
            return [
                'status' => 'success',
                'message' => 'delete successed',
                'code' => 200,
            ];
        }

        $row = $this->tasks->find($id);
        $row->delete();

        return redirect()->route('tasks.index');
    }

    /**
     * [lists description]
     * @return [type] [description]
     */
    public function lists(Request $request)
    {
        $return['draw'] = $request->get('draw', 0);
        $tasks = $this->tasks;

        if ($request->has('order') && !empty($request->order[0]['column'])) {

            $field = $request->columns[$request->order[0]['column']]['data'];
            $ordered = $request->order[0]['dir'];
            $arrayFields = ['title', 'description', 'status', 'date', 'priority'];
            if(in_array($field, $arrayFields)){
                $tasks = $tasks->orderBy($field, $ordered);
            }
        }

        if ($request->has('search') && !empty($request->search['value'])) {
            $keyword = $request->search['value'];
            $tasks = $tasks->where('title', 'LIKE', '%' . $keyword . '%')->orWhere('description', 'LIKE', '%'. $keyword . '%');
        }
        $count = $tasks->count();

        $return['recordsTotal'] = $count;
        $return['recordsFiltered'] = $count;

        $tasks = $tasks->orderBy('date', 'desc')->skip($request->start)->take($request->length)->get();
        $records = [];
        $priority = ['0'=>'Low', '1' => 'Normal', '2' => 'High'];
        $bg_colors = ['0'=>'bg-success', '1' => 'bg-info', '2' => 'bg-danger'];
        foreach ($tasks as $row) {
            $records[] = [
                'DT_RowId' => $row->id,
                'marker' => '',
                'title' => '<a data-href="' . route('tasks.quick', [$row->id]) . '">' . str_limit($row->title, 50) . '</a>',
                'date' => $row->date,
                'priority' => '<span class="badge '.$bg_colors[$row->priority].'">'.$priority[$row->priority].'</span>',
                'status' => ($row->status) ? '<i class="fa fa-toggle-on"></i>' : '<i class="fa fa-toggle-off"></i>',
                'edit' => '<a href="' . route('tasks.edit', [$row->id]) . '" data-bjax><i class=" icon-pencil"></i></a>',
            ];
        }
        $return['data'] = $records;

        return response()->json($return, 200);
    }
}
