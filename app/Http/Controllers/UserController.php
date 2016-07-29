<?php

namespace App\Http\Controllers;

use App\Entities\User;
use App\Http\Requests;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $users;
    public function __construct(User $users)
    {
        config(['site.menu' => 'users', 'site.submenu' => 'all-users']);
        $this->users = $users;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.main');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create.main');
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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        $row = $this->users->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'status' => $request->get('status', 0),
        ]);

        return redirect()->route('user.index')->with('message', 'data berhasil di tambahkan');
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
        $row = $this->users->find($id);
        return view('users.edit.quick', compact('row'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $row = $this->users->find($id);
        return view('users.edit.main', compact('row'));
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
            'id' => 'exists:users',
        ]);

        $row = $this->users->find($id);
        $row->fill($request->all());
        $row->status = $request->get('status', 0);

        if ($request->has('password') && !empty($request->password)) {
            $row->password = bcrypt($request->password);
        }

        $row->save();


        if ($request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'data berhasil di ubah',
            ], 200);
        }

        return redirect()->route('user.index')->with('message', 'data berhasil di ubah');
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
            $this->users->whereIn('id', $request->ids)->delete();
            return [
                'status' => 'success',
                'message' => 'delete successed',
                'code' => 200,
            ];
        }

        $row = $this->users->find($id);
        $row->delete();

        return redirect()->route('user.index');
    }

    /**
     * [lists description]
     * @return [type] [description]
     */
    public function lists(Request $request)
    {
        $return['draw'] = $request->get('draw', 0);
        $users = $this->users;

        if ($request->has('order') && !empty($request->order[0]['column'])) {

            $field = $request->columns[$request->order[0]['column']]['data'];
            $ordered = $request->order[0]['dir'];
            $arrayFields = ['name', 'email', 'status'];
            if(in_array($field, $arrayFields)){
                $users = $users->orderBy($field, $ordered);
            }
        }

        if ($request->has('search') && !empty($request->search['value'])) {
            $keyword = $request->search['value'];
            $users = $users->where('name', 'LIKE', '%' . $keyword . '%');
        }
        $count = $users->count();

        $return['recordsTotal'] = $count;
        $return['recordsFiltered'] = $count;

        $users = $users->orderBy('name')->skip($request->start)->take($request->length)->get();
        $records = [];
        foreach ($users as $row) {
            $records[] = [
                'DT_RowId' => $row->id,
                'marker' => '',
                'name' => '<a data-href="' . route('user.quick', [$row->id]) . '">' . str_limit($row->name, 50) . '</a>',
                'email' => $row->email,
                'status' => ($row->status) ? '<i class="fa fa-toggle-on"></i>' : '<i class="fa fa-toggle-off"></i>',
                'edit' => '<a href="' . route('user.edit', [$row->id]) . '" data-bjax><i class=" icon-pencil"></i></a>',
            ];
        }
        $return['data'] = $records;

        return response()->json($return, 200);
    }

}
