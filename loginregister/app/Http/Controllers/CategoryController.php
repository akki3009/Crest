<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Facade\FlareClient\Http\Response;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{

    public function index()
    {
        $cat = Category::all();
        // dd($cat);
        return view('categorylist', ['category' => $cat]);
    }

    public function create()
    {
        return view('categoryadd');
    }

    public function store(Request $request)
    {
        $request->validate([
            'cname' => 'required|unique:categorys',
            'cimage' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'cimage' => 'dimensions:max_width=1024,max_height=720',
            'corder' => 'required',
            'cstatus' => 'required'
        ]);
        $cat = new Category();
        $cat->cname = $request->input('cname');
        $cat->corder = $request->input('corder');
        $cat->cstatus = $request->input('cstatus');

        if ($request->file('cimage')) {
            $file = $request->file('cimage');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            // echo $filename;
            $file->move(public_path('/asset/img/Categoryimage'), $filename);
            $cat->cimage = $filename;
        } else {
            return $request;
            $cat->cimage = '';
        }
        $cat->save();
        return redirect('/categoryindex')->with('success', 'Category Sucessfully Added');
    }

    public function edit($id)
    {

        $cat = Category::find($id);
        // dd($cat);
        return view('categoryadd', ['editcate' => $cat]);
    }
    public function update(Request $request, $id)
    {
        // dd($id);
        $request->validate([
            'cname' => 'required',
            'corder' => 'required',
            'cstatus' => 'required'
        ]);
        $image = $request->cimage;
        // dd($image);
        if ($image != null) {
            $file = $request->file('cimage');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            // echo $filename;
            $file->move(public_path('asset/img/Categoryimage'), $filename);
            Category::where("id", $id)->update(array(
                "cname" => $request->cname,
                "corder" => $request->corder,
                "cstatus" => $request->cstatus,
                "cimage" => $request->$filename
            ));
        } else {
            Category::where("id", $id)->update(array(
                "cname" => $request->cname,
                "corder" => $request->corder,
                "cstatus" => $request->cstatus
            ));
        }
        return redirect('/categoryindex')->with('success', 'Category Sucessfully Updated');
    }

    public function destroy($id)
    {
        $del = Category::find($id);
        if (file_exists(public_path('asset/img/Categoryimage/' . $del->cimage))) {
            unlink(public_path('asset/img/Categoryimage/' . $del->cimage));
            $del->delete();
            return redirect('/categoryindex')->with('error', 'Category Sucessfully Deleted');
        }
    }

     public function catSearch(Request $request)
    {
        // dd($request->all());
        if($request->ajax()){
            $output="";
            $cat = Category::where('cname', 'LIKE', '%'.$request->search_val.'%')->get();
            if($cat){
                foreach ($cat as $value) {
                    $output .="<tr>".
                    '<td>'.$value->id.'</td>'.
                    '<td>'.$value->cname.'</td>'.
                    '<td><img src='.url('asset/img/Categoryimage/'.$value->cimage) .' width="70px" height="70px"></td>'.
                    '<td>'.$value->corder.'</td>'.
                    '<td>'.$value->cstatus.'</td>'.
                    '<td>'.$value->created_at->format('d/m/Y').'</td>'.
                    '<td>'.$value->updated_at->format('d/m/Y').'</td>'.
                    '<td><a class="btn btn-success" href='."edit/$value->id".'>Edit</a></td>'.
                    '<td><a class="btn btn-danger" href='."delete/$value->id".'>Delete</a></td>'.
                    '</tr>';
                }
                return Response($output);
            }
        }
    }
}
