<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teams= Team::orderBy('created_at', 'desc')->get();
        if ($teams) {
            return response()->json(['status' => true, 'teams' => $teams], 200);
        } else {
            return response()->json(['status' => false, 'teams' => "Record not found"], 402);
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
        $data = $request->only('name','role','facebook_url','twitter_url','linkedin_url','Instagram_url');
        if ($request->hasFile('picture')) {
            $user_image = $request->file('picture');
            $extension = $user_image->getClientOriginalExtension();
            $fileName = uniqid() . '.' . $extension;
            $user_image->move('admin/images/teams', $fileName);
            $data['picture'] = $fileName;
        }
        $service = Team::create($data);
        if ($service) {
            return response()->json(['status' => true, 'service' => $service], 201);
        } else {
            return response()->json(['status' => false, 'service' => 'Something went wrong'], 500);
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $team = Team::find($id);
        if ($team) {
            return response()->json(['status' => true, 'team' => $team], 200);
        } else {
            return response()->json(['status' => false, 'team' => "Record not found"], 402);
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
        $data = $request->only('name','role','facebook_url','twitter_url','linkedin_url','instagram_url');
        if ($request->hasFile('picture')) {
            $user_image = $request->file('picture');
            $extension = $user_image->getClientOriginalExtension();
            $fileName = uniqid() . '.' . $extension;
            $user_image->move('admin/images/teams', $fileName);
            $data['picture'] = $fileName;
        }
        $team = Team::where('id',$request->id)->update($data);
        if ($team) {
            return response()->json(['status' => true, 'team' => $team], 201);
        } else {
            return response()->json(['status' => false, 'team' => 'Something went wrong'], 500);
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
        $team = Team::find($id);
        $team->delete();
        if ($team) {
            return response()->json(['status' => true, 'team' => "Team delete successfully"], 200);
        } else {
            return response()->json(['status' => false, 'team' => "Record not found"], 402);
        }
    }
}
