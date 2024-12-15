<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StaffRequest;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $userId = Auth::user()->id;
        // $staffs = Staff::where(['user_id' => $userId])->get();
        $staffs = Staff::where('deleted', 0)->orderBy('name', 'asc')->paginate(10);

        // dump($staffs->all());
        // dd($staffs);

        return view('staff.list', ['staffs' => $staffs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('staff.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StaffRequest $request)
    {
        // dump($request->all());
        // dd($request);

        $userId = Auth::user()->id;
        $input = $request->input();
        $input['created_userid'] = $userId;
        $staffStatus = Staff::create($input);

        if ($staffStatus) {
            $message = 'Staff successfully added';
            $type = 'success';
        } else {
            $message = 'Oops, something went wrong. Staff not saved';
            $type = 'error';
        }

        return redirect('staff')->with($type, $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function show(Staff $id)
    {
        //
        $userId = Auth::user()->id;
        $staff = Staff::where(['user_id' => $userId, 'id' => $id])->first();
        if (!$staff) {
            return redirect('staff')->with('error', 'Staff not found');
        }
        return view('staff.view', ['staff' => $staff]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        // $userId = Auth::user()->id;
        $staff = Staff::where(['id' => $id])->first();
        if ($staff) {
            return view('staff.edit', ['staff' => $staff]);
        } else {
            return redirect('staff')->with('error', 'Staff not found');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dump($request);
        // dd($request);
        //
        $userId = Auth::user()->id;
        $staff = Staff::find($id);
        if (!$staff) {
            return redirect('staff')->with('error', 'Staff not found.');
        }
        $input = $request->input();
        $input['updated_userid'] = $userId;
        $staffStatus = $staff->update($input);
        if ($staffStatus) {
            return redirect('staff')->with('success', 'Staff successfully updated.');
        } else {
            return redirect('staff')->with('error', 'Oops something went wrong. Staff not updated');
        }
    }


    public function delete($id)
    {
        $staff = Staff::find($id);

        return view('staff.delete', compact('staff'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $userId = Auth::user()->id;
        // $staff = Staff::find($id);
        // if (!$staff) {
        //     return redirect('staff')->with('error', 'Staff not found.');

        $staffDelStatus = Staff::updateOrCreate(
            ['id' => $id],
            ['deleted' => 1, 'deleted_userid' => $userId]
        );

        // $staff = Staff::where(['id' => $id])->first();
        // $respStatus = $respMsg = '';
        // if (!$staff) {
        //     $respStatus = 'error';
        //     $respMsg = 'Staff not found';
        // }
        // $staffDelStatus = $staff->delete();
        // if ($staffDelStatus) {
        //     $respStatus = 'success';
        //     $respMsg = 'Staff deleted successfully';
        // } else {
        //     $respStatus = 'error';
        //     $respMsg = 'Oops something went wrong. Staff not deleted successfully';
        // }

        if(!$staffDelStatus->wasRecentlyCreated && $staffDelStatus->wasChanged()){
            // updateOrCreate performed an update
            $respStatus = 'success';
            $respMsg = 'Staff deleted successfully';
        } else {
            $respStatus = 'error';
            $respMsg = 'Oops something went wrong. Staff not deleted successfully';
        }

        return redirect('staff')->with($respStatus, $respMsg);
    }

    public function search(Request $request)
    {
        // $staffs = Staff::where('deleted', 0)->orderBy('name', 'asc')->paginate(2);
        // return view('staff.list', ['staffs' => $staffs]);

        $search = $request->input('search');
        $results = Staff::where(function($query) use ($search) {
            $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('staff_no', 'like', '%' . $search . '%');
                    })
                    ->where('deleted', 0)
                    ->orderBy('name', 'asc')
                    ->paginate(10);
        // $results = Staff::where('name', 'like', "%$search%")
        //             ->orWhere('email', 'like', "%{$search}%")
        //             ->orWhere('staff_no', 'like', "%{$search}%")
        //             ->where('deleted', 0)
        //             ->orderBy('name', 'asc')
        //             ->paginate(2);

        return view('staff.list', ['staffs' => $results]);

        // return view('products.index', ['results' => $results]);
    }
}
