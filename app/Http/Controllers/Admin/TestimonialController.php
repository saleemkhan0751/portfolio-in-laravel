<?php

namespace App\Http\Controllers\Admin;

use App\Models\Testimonial;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use DataTables;

class TestimonialController extends Controller
{
    private $imagePath;
    public function __construct()
    {
        $this->imagePath = 'admin/images/testimonials/';
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
            $testimonial =Testimonial::withTrashed()->latest();

            return DataTables::of($testimonial)
                ->addIndexColumn()
                ->editColumn('picture', function (Testimonial $testimonial) {
                    if (is_null($testimonial->picture)) {
                        return "<img class='img-responsive' width='100px' src='" . asset($this->defaultImage) . "' alt='" . $testimonial->name . "' />";
                    } else if (file_exists($this->imagePath . $testimonial->picture)) {
                        return "<img class='img-responsive' width='100px' src='" . asset($this->imagePath . $testimonial->picture) . "' alt='" . $testimonial->name . "' />";
                    } else {
                        return "<img class='img-responsive' width='100px' src='" . asset($this->notFoundImage) . "' alt='" . $testimonial->name . "' />";
                    }
                })
                ->editColumn('status', function (Testimonial $testimonial) {
                    return view('admin.testimonials.status', compact('testimonial'))->render();
                })
                ->addColumn('actions', function (Testimonial $testimonial) {
                    return view('admin.testimonials.actions', compact('testimonial'))->render();
                })
                ->rawColumns(['status','actions','picture'])
                ->toJson();
        }
        return view('admin.testimonials.index');
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
            'role'=>'required',
        ]);
        if ($validator->fails()){
            return  back()->withErrors($validator)->withInput();
        }
        $data= $request->only('name','content','role');
        $data['user_id']=auth()->user()->id;
        if ($request->file('image')){
            $product_image=$request->file('image');
            $extension = $product_image->getClientOriginalExtension();
            $fileName = uniqid() . '.' . $extension;
            $product_image->move('admin/images/testimonials/', $fileName);
            $data['picture']=$fileName;
        }
        Testimonial::create($data);
        return  back();
    }

    /**
     * Display the specified resource.
     *
     * @param Testimonial $testimonial
     * @return Response
     */
    public function show(Testimonial $testimonial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Testimonial $testimonial
     * @return Response
     */
    public function edit(Testimonial $testimonial)
    {
        return  view('admin.testimonials.index',compact('testimonial'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Testimonial $testimonial
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        return response()->json($request->all());
        $data= $request->only('name','content',"role");
        $data['user_id']=auth()->user()->id;
        if ($request->file('picture')){
            $product_image=$request->file('picture');
            $extension = $product_image->getClientOriginalExtension();
            $fileName = uniqid() . '.' . $extension;
            $product_image->move('admin/images/testimonials', $fileName);
            $data['picture']=$fileName;
        }
        $testimonial= Testimonial::where('id',$request->id)->update($data);
        return \redirect()->route("testimonials.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Testimonial $testimonial
     * @return Response
     */
    public function deleteTestimonial($id)
    {
        $testimonial = Testimonial::where('id', '=', $id);
        if ($testimonial->delete()) {
            return response()->json(['success' => true, 'message' => 'Testimonial deleted successfully!']);
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong!']);
    }


    public function restore(Request $request, $id)
    {
        if (request()->ajax()) {
            $testimonial = Testimonial::withTrashed()->where('id', $id)->first();
            if (isset($testimonial) && !empty($testimonial)) {
                if ($testimonial->restore()) {
                    return response()->json(['success' => true, 'message' => 'Testimonial restored successfully!']);
                }
            }
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong!']);
    }

    public function permanentDelete(Request $request, $id)
    {
        $testimonial = Testimonial::onlyTrashed()->whereId($id)->first();
        if (request()->ajax()) {
            if ($testimonial->forceDelete()) {
                return response()->json(['success' => true, 'message' => 'Testimonial deleted permanently successfully!']);
            }
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong!']);
    }
}
