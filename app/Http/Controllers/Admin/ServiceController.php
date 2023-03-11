<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DataTables;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{
    private $imagePath;
    public function __construct()
    {
        $this->imagePath = 'admin/images/services/';
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
            $service =Service::withTrashed()->latest();

            return DataTables::of($service)
                ->addIndexColumn()
                ->editColumn('picture', function (Service $service) {
                    if (is_null($service->picture)) {
                        return "<img class='img-responsive' width='100px' src='" . asset($this->defaultImage) . "' alt='" . $service->name . "' />";
                    } else if (file_exists($this->imagePath . $service->picture)) {
                        return "<img class='img-responsive' width='100px' src='" . asset($this->imagePath . $service->picture) . "' alt='" . $service->name . "' />";
                    } else {
                        return "<img class='img-responsive' width='100px' src='" . asset($this->notFoundImage) . "' alt='" . $service->name . "' />";
                    }
                })
                ->editColumn('status', function (Service $service) {
                    return view('admin.services.status', compact('service'))->render();
                })
                ->addColumn('actions', function (Service $service) {
                    return view('admin.services.actions', compact('service'))->render();
                })
                ->rawColumns(['status','actions','picture'])
                ->toJson();
        }
        return view('admin.services.index');
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
        $validator=Validator::make($request->all(),[
            'name'=>'required',
            'content'=>'required',
        ]);
        if ($validator->fails()){
            return  back()->withErrors($validator)->withInput();
        }
        $data= $request->only('name','content');
        $data['user_id']=auth()->user()->id;
        if ($request->file('image')){
            $product_image=$request->file('image');
            $extension = $product_image->getClientOriginalExtension();
            $fileName = uniqid() . '.' . $extension;
            $product_image->move('admin/images/services/', $fileName);
            $data['picture']=$fileName;
        }
        Service::create($data);
        return  back();
    }

    /**
     * Display the specified resource.
     *
     * @param Service $service
     * @return void
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Service $service
     * @return Response
     */
    public function edit(Service $service)
    {
        return  view('admin.services.index',compact('service'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Service $service
     * @return RedirectResponse
     */
    public function update(Request $request, Service $service)
    {
        $data= $request->only('name','content');
        $data['user_id']=auth()->user()->id;
        if ($request->file('picture')){
            $product_image=$request->file('picture');
            $extension = $product_image->getClientOriginalExtension();
            $fileName = uniqid() . '.' . $extension;
            $product_image->move('admin/images/services', $fileName);
            $data['picture']=$fileName;
        }
        $service->update($data);


        return \redirect()->route("services.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return Response
     */
    public function deleteService($id)
    {
        $service = Service::where('id', '=', $id);
        if ($service->delete()) {
            return response()->json(['success' => true, 'message' => 'Service deleted successfully!']);
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong!']);
    }


    public function restore(Request $request, $id)
    {
        if (request()->ajax()) {
            $service = Service::withTrashed()->where('id', $id)->first();
            if (isset($service) && !empty($service)) {
                if ($service->restore()) {
                    return response()->json(['success' => true, 'message' => 'Service restored successfully!']);
                }
            }
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong!']);
    }

    public function permanentDelete(Request $request, $id)
    {
        $service = Service::onlyTrashed()->whereId($id)->first();
        if (request()->ajax()) {
            if ($service->forceDelete()) {
                return response()->json(['success' => true, 'message' => 'Service deleted permanently successfully!']);
            }
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong!']);
    }
}
