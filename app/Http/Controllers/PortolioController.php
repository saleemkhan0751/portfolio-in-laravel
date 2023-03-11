<?php

namespace App\Http\Controllers;

use App\Models\Portfolios;
    use Illuminate\Http\Request;

    class PortolioController extends Controller
    {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $portfolio = Portfolios::orderBy('created_at', 'desc')->get();
        if ($portfolio) {
            return response()->json(['status' => true, 'portfolio' => $portfolio], 200);
        } else {
            return response()->json(['status' => false, 'portfolio' => "Record not found"], 402);
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
        $data = $request->only( 'type');
        if ($request->hasFile('picture')) {
            $user_image = $request->file('picture');
            $extension = $user_image->getClientOriginalExtension();
            $fileName = uniqid() . '.' . $extension;
            $user_image->move('admin/images/portfolios', $fileName);
            $data['picture'] = $fileName;
        }
        $portfolio = Portfolios::create($data);
        if ($portfolio) {
            return response()->json(['status' => true, 'portfolio' => $portfolio], 201);
        } else {
            return response()->json(['status' => false, 'portfolio' => 'Something went wrong'], 500);
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $portfolio = Portfolios::find($id);
        if ($portfolio) {
            return response()->json(['status' => true, 'portfolio' => $portfolio], 200);
        } else {
            return response()->json(['status' => false, 'portfolio' => "Record not found"], 402);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $data = $request->only( 'type');
        if ($request->hasFile('picture')) {
            $user_image = $request->file('picture');
            $extension = $user_image->getClientOriginalExtension();
            $fileName = uniqid() . '.' . $extension;
            $user_image->move('admin/images/portfolios', $fileName);
            $data['picture'] = $fileName;
        }
        $portfolio = Portfolios::where('id',$request->id)->update($data);
        if ($portfolio) {
            return response()->json(['status' => true, 'portfolio' => $portfolio], 201);
        } else {
            return response()->json(['status' => false, 'portfolio' => 'Something went wrong'], 500);
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
        $portfolio = Portfolios::find($id);
        $portfolio->delete();
        if ($portfolio) {
            return response()->json(['status' => true, 'portfolio' => "Portfolio delete successfully"], 200);
        } else {
            return response()->json(['status' => false, 'portfolio' => "Record not found"], 402);
        }
    }
}
