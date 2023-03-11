<?php

namespace App\Http\Controllers\Admin;


use App\Models\Portfolio;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class PortfolioController extends Controller
{
    private $imagePath;

    public function __construct()
    {
        $this->imagePath = 'admin/images/portfolios/';
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
            $portfolio = Portfolio::withTrashed()->latest();
            return DataTables::of($portfolio)
                ->addIndexColumn()
                ->editColumn('picture', function (Portfolio $portfolio) {
                    if (is_null($portfolio->picture)) {
                        return "<img class='img-responsive' width='100px' src='" . asset($this->defaultImage) . "' alt='" . $portfolio->name . "' />";
                    } else if (file_exists($this->imagePath . $portfolio->picture)) {
                        return "<img class='img-responsive' width='100px' src='" . asset($this->imagePath . $portfolio->picture) . "' alt='" . $portfolio->name . "' />";
                    } else {
                        return "<img class='img-responsive' width='100px' src='" . asset($this->notFoundImage) . "' alt='" . $portfolio->name . "' />";
                    }
                })
                ->editColumn('status', function (Portfolio $portfolio) {
                    return view('admin.portfolios.status', compact('portfolio'))->render();
                })
                ->addColumn('actions', function (Portfolio $portfolio) {
                    return view('admin.portfolios.actions', compact('portfolio'))->render();
                })
                ->rawColumns(['status', 'actions', 'picture'])
                ->toJson();
        }
        return view('admin.portfolios.index');
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
            'content' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $data = $request->only('name', 'type');
        $data['user_id'] = auth()->user()->id;
        if ($request->file('image')) {
            $product_image = $request->file('image');
            $extension = $product_image->getClientOriginalExtension();
            $fileName = uniqid() . '.' . $extension;
            $product_image->move('admin/images/portfolios/', $fileName);
            $data['picture'] = $fileName;
        }
        Portfolio::create($data);
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Http\Controllers\admin\portfolio $portfolio
     * @return void
     */
    public function show(portfolio $portfolio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Http\Controllers\admin\portfolio $portfolio
     * @return Response
     */
    public function edit(portfolio $portfolio)
    {
        return view('admin.portfolios.index', compact('Portfolio'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param \App\Http\Controllers\admin\portfolio $portfolio
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, portfolio $portfolio)
    {
        $data = $request->only('name', 'type');
        $data['user_id'] = auth()->user()->id;
        if ($request->file('picture')) {
            $product_image = $request->file('picture');
            $extension = $product_image->getClientOriginalExtension();
            $fileName = uniqid() . '.' . $extension;
            $product_image->move('admin/images/portfolios', $fileName);
            $data['picture'] = $fileName;
        }
        $portfolio->update($data);


        return \redirect()->route("portfolios.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return Response
     */
    public function deletePortfolio($id)
    {
        $portfolio = Portfolio::where('id', '=', $id);
        if ($portfolio->delete()) {
            return response()->json(['success' => true, 'message' => 'Portfolio deleted successfully!']);
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong!']);
    }


    public function restore(Request $request, $id)
    {
        if (request()->ajax()) {
            $portfolio = Portfolio::withTrashed()->where('id', $id)->first();
            if (isset($portfolio) && !empty($portfolio)) {
                if ($portfolio->restore()) {
                    return response()->json(['success' => true, 'message' => 'Portfolio restored successfully!']);
                }
            }
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong!']);
    }

    public function permanentDelete(Request $request, $id)
    {
        $portfolio = Portfolio::onlyTrashed()->whereId($id)->first();
        if (request()->ajax()) {
            if ($portfolio->forceDelete()) {
                return response()->json(['success' => true, 'message' => 'Portfolio deleted permanently successfully!']);
            }
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong!']);
    }
}
