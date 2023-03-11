<?php

namespace App\Http\Controllers;

use App\Models\FAQ;
use Illuminate\Http\Request;

class FAQController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faq = FAQ::orderBy('created_at', 'desc')->get();
        if ($faq) {
            return response()->json(['status' => true, 'faq' => $faq], 200);
        } else {
            return response()->json(['status' => false, 'faq' => 'Record not found'], 402);
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
        $faq = FAQ::create([
            'heading' => $request->heading,
            'description' => $request->description,
        ]);
        if ($faq) {
            return response()->json(['status' => false, 'faq' => 'Faq create successfully'], 201);
        } else {
            return response()->json(['status' => false, 'faq' => 'Something went wrong'], 500);
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
        $faq = FAQ::where('id', $id)->first();
        if ($faq) {
            return response()->json(['status' => true, 'faq' => $faq], 200);
        } else {
            return response()->json(['status' => false, 'faq' => 'Record not found'], 402);
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
        $data = $request->only('heading', 'description');
        $faq = FAQ::where('id', $request->id)->update($data);
        $faq_data = FAQ::where('id', $request->id)->first();
        if ($faq) {
            return response()->json(['status' => true, 'faq' => $faq_data], 200);
        } else {
            return response()->json(['status' => false, 'faq' => 'Something went wrong'], 500);
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
        $faq = FAQ::where('id', $id)->delete();
        if ($faq) {
            return response()->json(['status' => true, 'faq' => 'Faq delete successfully'], 200);
        } else {
            return response()->json(['status' => false, 'faq' => 'Something went wrong'], 500);
        }
    }
}
