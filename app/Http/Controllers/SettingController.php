<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting = Setting::orderBy('created_at', 'desc')->get();
        if ($setting) {
            return response()->json(['status' => true, 'setting' => $setting], 200);
        } else {
            return response()->json(['status' => false, 'setting' => "Record not found"], 401);
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
//        $validator=Validator::make($request->all(),[
//            'service'=>'required',
//            'testimonial'=>'required',
//            'team'=>'required',
//            'portfolio'=>'required',
//            'contact_us'=>'required',
//            'pricing'=>'required',
//            'about_us'=>'required',
//        ]);
//        if ($validator->fails()){
//            return  response()->json([])
//        }

        $setting = Setting::create([
            'service' => $request->service,
            'testimonial' => $request->testimonial,
            'team' => $request->team,
            'portfolio' => $request->portfolio,
            'contact_us' => $request->contact_us,
            'pricing' => $request->pricing,
            'about_us' => $request->about_us,
        ]);
        if ($setting) {
            return response()->json(['status' => true, 'setting' => $setting], 201);
        } else {
            return response()->json(['status' => false, 'setting' => 'Something went wrong'], 500);
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
        $setting = Setting::where('id', $id)->first();
        if ($setting) {
            return response()->json(['status' => true, 'setting' => $setting], 200);
        } else {
            return response()->json(['status' => false, 'setting' => 'Record not found'], 401);
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
        $data = $request->only('service', 'testimonial', 'team', 'portfolio', 'contact_us', 'pricing', 'about_us');
        $setting = Setting::where('id', $request->id)->update($data);
        $setting_data = Setting::where('id', $request->id)->first();
        if ($setting) {
            return response()->json(['status' => true, 'setting' => $setting_data], 200);
        } else {
            return response()->json(['status' => false, 'setting' => 'Something went wrong'], 500);
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
        $setting = Setting::where('id', $id)->delete();
        if ($setting) {
            return response()->json(['status' => true, 'setting' => 'Setting delete successfully'], 200);
        } else {
            return response()->json(['status' => false, 'setting' => 'Something went wrong'], 500);
        }
    }
}
