<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $about_us = About::orderBy('created_at', 'desc')->get();
        if ($about_us) {
            return response()->json(['status' => true, 'about_us' => $about_us], 200);
        } else {
            return response()->json(['status' => false, 'about_us' => "Record not found"], 402);
        }
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only('title', 'content');
        if ($request->hasFile('icon')) {
            $user_image = $request->file('icon');
            $extension = $user_image->getClientOriginalExtension();
            $fileName = uniqid() . '.' . $extension;
            $user_image->move('admin/images/about_us', $fileName);
            $data['icon'] = $fileName;
        }
        $about_us = About::create($data);
        if ($about_us) {
            return response()->json(['status' => true, 'about_us' => $about_us], 201);
        } else {
            return response()->json(['status' => false, 'about_us' => 'Something went wrong'], 500);
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $about_us = About::find($id);
        if ($about_us) {
            return response()->json(['status' => true, 'about_us' => $about_us], 200);
        } else {
            return response()->json(['status' => false, 'about_us' => "Record not found"], 402);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = $request->only('title', 'content');
        if ($request->hasFile('icon')) {
            $user_image = $request->file('icon');
            $extension = $user_image->getClientOriginalExtension();
            $fileName = uniqid() . '.' . $extension;
            $user_image->move('admin/images/about_us', $fileName);
            $data['icon'] = $fileName;
        }
        $about_us = About::where('id', $request->id)->update($data);
        $about_us_data = About::where('id', $request->id)->first();
        if ($about_us) {
            return response()->json(['status' => true, 'about_us' => $about_us_data], 201);
        } else {
            return response()->json(['status' => false, 'about_us' => 'Something went wrong'], 500);
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
        $about_us = About::find($id);
        $about_us->delete();
        if ($about_us) {
            return response()->json(['status' => true, 'about_us' => "About us delete successfully"], 200);
        } else {
            return response()->json(['status' => false, 'about_us' => "Record not found"], 402);
        }
    }
}
