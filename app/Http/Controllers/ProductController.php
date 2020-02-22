<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Product;
use Auth;

class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'captcha' => 'required|captcha',
        ],
        [
            'captcha.captcha' => 'Please enter the correct captcha.',
        ]);
        if ($validator->fails()) 
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $file = $request->file('image');
        $image_name = 'PR'.rand(11111, 99999).'.'.$file->getClientOriginalExtension();
        $destinationPath = 'uploads/products';
        $file->move($destinationPath, $image_name);
        Product::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'image' => $image_name
        ]);
        return redirect('product')->with('success', 'Product added successfully!');
    }
}
