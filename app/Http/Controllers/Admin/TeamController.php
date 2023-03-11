<?php

namespace App\Http\Controllers\Admin;

use App\Models\Team;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use DataTables;

class TeamController extends Controller
{
    private $imagePath;

    public function __construct()
    {
        $this->imagePath = 'admin/images/teams/';
        $this->defaultImage = 'admin/images/default-image.png';
        $this->notFoundImage = 'admin/images/image-not-found.png';
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        if (\request()->ajax()) {
            $team = Team::withTrashed()->latest();

            return DataTables::of($team)
                ->addIndexColumn()
                ->editColumn('picture', function (Team $team) {
                    if (is_null($team->picture)) {
                        return "<img class='img-responsive' width='100px' src='" . asset($this->defaultImage) . "' alt='" . $team->name . "' />";
                    } else if (file_exists($this->imagePath . $team->picture)) {
                        return "<img class='img-responsive' width='100px' src='" . asset($this->imagePath . $team->picture) . "' alt='" . $team->name . "' />";
                    } else {
                        return "<img class='img-responsive' width='100px' src='" . asset($this->notFoundImage) . "' alt='" . $team->name . "' />";
                    }
                })
                ->editColumn('status', function (Team $team) {
                    return view('admin.teams.status', compact('team'))->render();
                })
                ->addColumn('actions', function (Team $team) {
                    return view('admin.teams.actions', compact('team'))->render();
                })
                ->rawColumns(['status', 'actions', 'picture'])
                ->toJson();
        }
        return view('admin.teams.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'role' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $data = $request->only('name', 'role','facebook_url','twitter_url','linkedin_url','Instagram_url');
        $data['user_id'] = auth()->user()->id;
        if ($request->file('image')) {
            $product_image = $request->file('image');
            $extension = $product_image->getClientOriginalExtension();
            $fileName = uniqid() . '.' . $extension;
            $product_image->move('admin/images/teams/', $fileName);
            $data['picture'] = $fileName;
        }
        Team::create($data);
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param Team $team
     * @return void
     */
    public function show(Team $team)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Team $team
     * @return Response
     */
    public function edit(Team $team)
    {
        return view('admin.teams.index', compact('team'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Team $team
     * @return RedirectResponse
     */
    public function update(Request $request, Team $team)
    {
        $data = $request->only('name', 'role','facebook_url','twitter_url','linkedin_url','Instagram_url');
        $data['user_id'] = auth()->user()->id;
        if ($request->file('picture')) {
            $product_image = $request->file('picture');
            $extension = $product_image->getClientOriginalExtension();
            $fileName = uniqid() . '.' . $extension;
            $product_image->move('admin/images/teams', $fileName);
            $data['picture'] = $fileName;
        }
        $team->update($data);


        return \redirect()->route("teams.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Team $team
     * @return Response
     */
    public function deleteTeam($id)
    {
        $team = Team::where('id', '=', $id);
        if ($team->delete()) {
            return response()->json(['success' => true, 'message' => 'Team deleted successfully!']);
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong!']);
    }


    public function restore(Request $request, $id)
    {
        if (request()->ajax()) {
            $team = Team::withTrashed()->where('id', $id)->first();
            if (isset($team) && !empty($team)) {
                if ($team->restore()) {
                    return response()->json(['success' => true, 'message' => 'Team restored successfully!']);
                }
            }
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong!']);
    }

    public function permanentDelete(Request $request, $id)
    {
        $team = Team::onlyTrashed()->whereId($id)->first();
        if (request()->ajax()) {
            if ($team->forceDelete()) {
                return response()->json(['success' => true, 'message' => 'Team deleted permanently successfully!']);
            }
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong!']);
    }
}
