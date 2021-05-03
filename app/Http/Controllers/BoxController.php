<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Box;


class BoxController extends Controller
{

    public function index()
    {
        $posts = Box::get();
        return view('posts.index', compact('posts'));
    }

    private $boxes;
    public function __construct()
    {
        $this->boxes = new Box();
    }
    public function fiche($box_id)
    {
        $boxes = $this->boxes->select('name', 'address', 'city', 'postal', 'country')
                ->where('id', $box_id)
                ->first();
        return view('posts.fiche')->with('posts', $boxes);
    }

    public function indexPost()
    {
        //$posts = Post::all();
        //return Post::where('title', 'Post Two')->get();
        //$posts = DB::select('SELECT * FROM posts');
        //$posts = Post::orderBy('title','desc')->take(1)->get();
        //$posts = Post::orderBy('title','desc')->get();

        $posts = Box::orderBy('created_at','desc')->paginate(10);
        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createPost()
    {
        return view('posts.create');

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'address' => 'required',
        ]);

        // Create Post
        $post = new Box;
        $post->title = $request->input('name');
        $post->body = $request->input('address');
        $post->user_id = auth()->user()->id;

        $post->save();

        return redirect('/')->with('success', 'Post Created');
    }

    function getAll() {
        return Box::all();
    }

    function getByID($id) {
        return Box::findOrFail($id);
    }   
    
    function create(Request $request) {
        $validator = Validator::make($request->all(), [ 
            'name' => 'required',
            'address' => 'required',
            'city' => 'required',
            'postal' => 'required',
            'country' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => "A field is missing"
            ], 400);
        } else {
            $box = Box::createDTOtoObject($request);

            $box->save();

            return response ($box, 201);
            }
    }


    function update(Request $request, $id) {
        $box = Box::findOrFail($id);

        if ($box) {
            $box = Box::updateDTOtoObject($request, $box);
            $box->save();

            return response ($box, 200);
        } else {
            return response()->json([
                'message' => "Box doesn't exist."
            ], 400);
        }
    }

    function delete(Request $request, $id) {
        $box = Box::findOrFail($id);

        if ($box) {
            $box->delete();
        } else {
            return response()->json([
                'message' => "Box doesn't exist."
            ], 400);
        }
    }

}