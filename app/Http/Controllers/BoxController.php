<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Box;


class BoxController extends Controller
{
    private $boxes;
    public function __construct()
    {
        $this->boxes = new Box();
    }

    #Afficher la fiche d'un établissement
    public function fiche($box_id)
    {
        $boxes = $this->boxes->select('name', 'address', 'city', 'postal', 'country')
                ->where('id', $box_id)
                ->first();
        return view('posts.fiche')->with('posts', $boxes);
    }

    public function __constructPost()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    #Afficher la liste des établissements dans l'ordre de création
    public function indexPost()
    {

        $posts = Box::orderBy('created_at','desc')->paginate(10);
        return view('posts.index')->with('posts', $posts);
    }

    #Afficher la page pour créer un établissement
    public function createPost()
    {
        return view('posts.create');

    }

    #Créer un établissement et stocker ses valeurs dans la bdd
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'address' => 'required',
            'city' => 'required',
            'postal' => 'required',
            'country' => 'required',
        ]);

        $post = new Box;
        $post->name = $request->input('name');
        $post->address = $request->input('address');
        $post->city = $request->input('city');
        $post->postal = $request->input('postal');
        $post->country = $request->input('country');
        $post->save();

        return redirect('/')->with('success', 'Post Created');
    }

    #Supprimer un établissement
    public function destroy($id)
    {
        $post = Box::find($id);
        $post->delete();
        return redirect('/')->with('success', 'Post Removed');
    }

    #Récupérer tous les établissements depuis la bdd
    function getAll() {
        return Box::all();
    }

    #Récupérer un établissement avec son ID
    function getByID($id) {
        return Box::findOrFail($id);
    }   
    
    #Créer un établissement dans la bdd
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

    #Modifier un établissement dans la bdd
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

    #Supprimer un établissement dans la bdd
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