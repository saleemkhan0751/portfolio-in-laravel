<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $service = Service::orderBy('created_at', 'desc')->get();
        if ($service) {
            return response()->json(['status' => true, 'services' => $service], 200);
        } else {
            return response()->json(['status' => false, 'services' => "Record not found"], 402);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only('name', 'content');
        if ($request->hasFile('picture')) {
            $user_image = $request->file('picture');
            $extension = $user_image->getClientOriginalExtension();
            $fileName = uniqid() . '.' . $extension;
            $user_image->move('admin/images/services', $fileName);
            $data['picture'] = $fileName;
        }
        $service = Service::create($data);
        if ($service) {
            return response()->json(['status' => true, 'service' => $service], 201);
        } else {
            return response()->json(['status' => false, 'service' => 'Something went wrong'], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $service = Service::find($id);
        if ($service) {
            return response()->json(['status' => true, 'service' => $service], 200);
        } else {
            return response()->json(['status' => false, 'service' => "Record not found"], 402);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {

        $data = $request->only('name', 'content');
        if ($request->hasFile('picture')) {
            $user_image = $request->file('picture');
            $extension = $user_image->getClientOriginalExtension();
            $fileName = uniqid() . '.' . $extension;
            $user_image->move('admin/images/services', $fileName);
            $data['picture'] = $fileName;
        }
        $service = Service::where('id',$request->id)->update($data);
        if ($service) {
            return response()->json(['status' => true, 'service' => $service], 201);
        } else {
            return response()->json(['status' => false, 'service' => 'Something went wrong'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service = Service::find($id);
        if ($service) {
            $service->delete();
            return response()->json(['status' => true, 'service' => "Service delete successfully"], 200);
        } else {
            return response()->json(['status' => false, 'service' => "Record not found"], 402);
        }
    }
}
