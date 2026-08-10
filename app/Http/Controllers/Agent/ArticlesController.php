<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Article;

class ArticlesController extends Controller
{
    public function index()
    {
        return view('agent-new.articles.index' ,['article'=> Article::paginate(10) ]);
    }

    public function addarticle()
    {
        return view('agent-new.articles.add');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        // return;

        // validate data
        $request->validate([
            'title' => 'required',
            'short_desc' => 'required',
            'long_desc' => 'required',
            'post_date' => 'required',
            'post_by' => 'required',
            'image' => 'required|mimes:jpeg,jpg,png|max:10000'
        ]);

        // upload image
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('frontend/assets/images/blog/inner/style1'),$imageName);

        $article = new Article;

        $article->title = $request->title;

        $article->image = $imageName;

        $article->short_desc = $request->short_desc;
        $article->long_desc = $request->long_desc;
        $article->post_date = $request->post_date;
        $article->post_by = $request->post_by;

        $article->save();
        return redirect('/agent/articles')->withSuccess('Article Created !!!!');
    }

    public function destroy($id)
    {
        $article = Article::where('id',$id)->first();
        $article->delete();

        return back()->withSuccess('Article Deleted !!!!');
    }

    public function editarticle($id)
    {
        $article = Article::where('id',$id)->first();
        return view('agent.editarticle' , ['article'=> $article]);
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        // return;

        // validate data
        $request->validate([
            'title' => 'required',
            'short_desc' => 'required',
            'long_desc' => 'required',
            'post_date' => 'required',
            'post_by' => 'required',
            'image' => 'nullable|mimes:jpeg,jpg,png|max:10000'
        ]);

        $article = Article::where('id',$id)->first();

        if(isset($request->image))
        {
            // upload image
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('frontend/assets/images/blog/inner/style1'),$imageName);
            $article->image = $imageName;
        }

        $article->title = $request->title;
        $article->short_desc = $request->short_desc;
        $article->long_desc = $request->long_desc;
        $article->post_date = $request->post_date;
        $article->post_by = $request->post_by;

        $article->save();

        return redirect('/agent/articles')->withSuccess('Article Updated !!!!');
    }
}
