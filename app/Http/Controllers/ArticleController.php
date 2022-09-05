<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Tag;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\ArticlesCollection;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = new ArticlesCollection(Article::with('tags')->latest()->paginate($request->rows));
        return response($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'title' => 'required|max:255',
            'content' => 'required',
            'photo' => 'required|mimes:jpeg,jpg,png|max:200',
            'tags' => 'array|max:5'
        ]);

        if ($validator->fails()) {
            return response($validator->messages(),400);
        } else {
            $fileName = time().'_'.$request->photo->getClientOriginalName();
            $filePath = $request->file('photo')->storeAs('uploads', $fileName, 'public');
            $data['photo'] = $filePath;

            $article = Article::create($data);
            $tag_ids = array();
            foreach ($data['tag'] as $tag_name){
                $tag = Tag::firstOrCreate(['name' => $tag_name]);
                $tag_ids[] = $tag->id;
            }
            if(count($tag_ids) > 0){
                $tags = Tag::find($tag_ids);
                $article->tags()->attach($tags);
            }
            return response(['msg' => 'Success!']);
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
        try{
            $article = Article::findOrFail($id);
            if($article->published){
                return response($article);
            } else {
                return response(['error' => 'Article is not yet published!'], 400);
            }
        } catch (ModelNotFoundException $e){
            return response(['error' => 'Article not found!'], 404);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'title' => 'required:max:255',
            'content' => 'required',
            'tags' => 'array|max:5'
        ]);

        if ($validator->fails()) {
            return response($validator->messages(), 400);
        } else {
//            $fileName = time().'_'.$request->photo->getClientOriginalName();
//            $filePath = $request->file('photo')->storeAs('uploads', $fileName, 'public');
//            $data['photo'] = $filePath;

            $article = Article::findOrFail($id);
            $article->update($data);
            $article->save();
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
        $article = Article::findOrFail($id);
        $article->delete();
        return Article::latest()->get();
    }
}
