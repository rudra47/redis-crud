<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Facades\Redis;

class BlogController extends Controller
{
    public function blogs()
    {
        $time_start = microtime(true);

        $cachedBlogs = Redis::get('blogs');

        $time_end = microtime(true);
        $execution_time = ($time_end - $time_start);

        if (isset($cachedBlogs)) {
            $blogs = json_decode($cachedBlogs);

            return view('blog', compact('blogs', 'execution_time'));
        }else {
            $time_start = microtime(true);

            $blogs = Blog::all();

            $time_end = microtime(true);
            $execution_time = ($time_end - $time_start);

            Redis::set('blogs', json_encode($blogs));

            return view('blog', compact('blogs', 'execution_time'));
        }
    }
    public function blog_edit($id)
    {
        $blog = Blog::find($id);
         return view('blog_edit', compact('blog'));
    }

    public function blog_edit_action(Request $request, $id)
    {
        Blog::find($id)->update([
            'title' => $request->title,
            'content' => $request->blog_content,
        ]);
        $blogs = collect(json_decode(Redis::get('blogs')));
        $blog = $blogs->where('id', $id)->first();
        $blog->title = $request->title;
        $blog->content = $request->blog_content;
        $index = $blogs->search($blog);
        $blogs[$index] = $blog;

        Redis::set('blogs', json_encode($blogs));

        return redirect()->route('blogs');
    }

    public function blog_delete($id)
    {
        Blog::find($id)->delete();
        $blogs = collect(json_decode(Redis::get('blogs')));
        $blog = $blogs->where('id', $id)->first();
        $index = $blogs->search($blog);
        $blogs->forget($index);

        Redis::set('blogs', json_encode($blogs));

        return redirect()->route('blogs');
    }
}
