<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $testimonials = Testimonial::orderBy('created_at', 'desc')->get();
        if ($testimonials ) {
            return response()->json(['status' => true, 'testimonials' => $testimonials], 200);
        } else {
            return response()->json(['status' => false, 'testimonials' => "Record not found"], 402);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only('name', 'content','role');
        if ($request->hasFile('picture')) {
            $user_image = $request->file('picture');
            $extension = $user_image->getClientOriginalExtension();
            $fileName = uniqid() . '.' . $extension;
            $user_image->move('admin/images/testimonials', $fileName);
            $data['picture'] = $fileName;
        }
        $testimonial = Testimonial::create($data);
        if ($testimonial) {
            return response()->json(['status' => true, 'testimonial' => $testimonial], 201);
        } else {
            return response()->json(['status' => false, 'testimonial' => 'Something went wrong'], 500);
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
        $testimonial = Testimonial::find($id);
        if ($testimonial) {
            return response()->json(['status' => true, 'testimonial' => $testimonial], 200);
        } else {
            return response()->json(['status' => false, 'testimonial' => "Record not found"], 402);
        }
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
    public function update(Request $request, Testimonial $testimonial)
    {

        $data = $request->only('name', 'content','role');
        if ($request->hasFile('picture')) {
            $user_image = $request->file('picture');
            $extension = $user_image->getClientOriginalExtension();
            $fileName = uniqid() . '.' . $extension;
            $user_image->move('admin/images/testimonials', $fileName);
            $data['picture'] = $fileName;
        }
        $testimonial= Testimonial::where('id',$request->id)->update($data);
        if ($testimonial) {
            return response()->json(['status' => true, 'testimonial' => $testimonial], 201);
        } else {
            return response()->json(['status' => false, 'testimonial' => 'Something went wrong'], 500);
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
        $testimonial = Testimonial::find($id);
        $testimonial->delete();
        if ($testimonial) {
            return response()->json(['status' => true, 'testimonial' => "Testimonial delete successfully"], 200);
        } else {
            return response()->json(['status' => false, 'testimonial' => "Record not found"], 402);
        }
    }
}
