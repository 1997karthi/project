<?php

namespace App\Http\Controllers;

use App\Models\Blogs;
use App\Models\BlogComments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index(Request $request){
      $blogs = Blogs::get();
      return view('base.home', compact('blogs'));
    }
    public function blogIndex(Request $request, $id){
      $blog = DB::table('blogs')->where('id', $id)->first();
      $blogComments = BlogComments::where('blog_id', $id)->get();
      $flow = $request->flow;
      return view('blog.index', compact('blog', 'flow', 'blogComments'));
    }
    public function store(Request $request){
      try{
        $Comments = new BlogComments();
        $Comments->name = $request->author_name;
        $Comments->comment = $request->content;
        $Comments->blog_id = $request->blogId;
        $Comments->save();
        return response()->json(['success' => true]);
      }catch(Exception $e){
        return response()->json(['success' => false]);
      }
    }
    public function manualAdd(Request $request){
        try{
          $Blogs = new Blogs();
          $Blogs->title = $request->blogTitle;
          $Blogs->author_name = $request->authorName;
          $Blogs->content = $request->content;
          $Blogs->image_url = $request->imageUrl;
          $Blogs->save();
          return response()->json(['success' => true, "message" => "Blog submitted successfully"]);
        }catch(Exception $e){
          return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
    public function csvImport(Request $request){
      try{
          if ($request->hasFile('file')) {
            $file = $request->file('file');
            $path = $file->getRealPath();
            $csvdata = [];
            if (($handle = fopen($path, 'r')) !== false) {
              $headers = fgetcsv($handle);
              while (($row = fgetcsv($handle)) !== false) {
                $csvdata[] = array_combine($headers, $row);
              }
              fclose($handle);
            }
            foreach($csvdata as $data){
              $Blogs = new Blogs();
              $Blogs->title = $data['blog-title'];
              $Blogs->author_name = $data['author-name'];
              $Blogs->content = $data['content'];
              $Blogs->image_url = $data['image_url'];
              $Blogs->save();
            }
          }
          return response()->json(['success' => true, 'message' => 'CSV File uploaded successfully!']);
      }catch(Exception $e){
          return response()->json(['success' => false, 'message' => $e->getMessage()]);
      }
    }
    public function blogView(Request $request){
      $blogs = Blogs::get();
      return view('blog.list', compact('blogs'));
    }
    public function blogDelete(Request $request){
        try{     
            BlogComments::where('blog_id', $request->blogId)->delete();
            DB::table('blogs')->where('id', $request->blogId)->delete();
            return response()->json(['success' => true, 'message' => 'Successfully Deleted!']);
        }catch(Exception $e){
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
    public function blogEdit(Request $request, $id){
      $blog = DB::table('blogs')->where('id', $id)->first();
      return view('blog.edit', compact('blog'));
    }
    public function editSave(Request $request){
        try{
          $blog = Blogs::find($request->blogId); // Fetch the blog using Eloquent
          if ($blog) {
              $blog->title = $request->blogTitle;
              $blog->author_name = $request->authorName;
              $blog->content = $request->content;
              $blog->image_url = $request->imageUrl;
              $blog->save(); // Save the changes
          }
          return response()->json(['success' => true, "message" => "Blog edited successfully"]);
        }catch(Exception $e){
          return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}
