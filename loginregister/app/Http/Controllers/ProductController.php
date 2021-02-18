<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $data = DB::table('products')
            ->join('categorys', 'categorys.id', '=', 'products.cname')
            ->join('product_images', 'product_images.productid', '=', 'products.id')
            ->select('categorys.cname as catid', 'categorys.id', 'products.*', 'product_images.*')
            ->where('product_images.istatus', '=', 'Active')
            ->get();
        // dd($data);
        return view('productlist')->with('product', $data);
    }

    public function create()
    {
        $category = Category::select('id', 'cname')->get();
        // dd($category);
        return view('productadd')->with('category', $category);
        // return view('productadd');
    }

    public function store(Request $request)
    {
        $request->validate([
            'pname' => 'required|unique:products',
            'cname' => 'required',
            'price' => 'required',
            'saleprice' => 'required',
            'quantity' => 'required',
            'porder' => 'required',
            'pstatus' => 'required'
        ]);
        $product = new Product();
        $product->pname = $request->input('pname');
        $product->cname = $request->input('cname');
        $product->productcode = mt_rand(999, 9999);
        $product->price = $request->input('price');
        $product->saleprice = $request->input('saleprice');
        $product->quantity = $request->input('quantity');
        $product->porder = $request->input('porder');
        $product->pstatus = $request->input('pstatus');
        $img = $request->file('imagename');
        if ($img) {
            $allowedfileExtention = ['jpeg', 'png', 'jpg'];
            foreach ($img as $k => $imagefile) {
                $imagename = $imagefile->getClientOriginalName();
                $extention = $imagefile->getClientOriginalExtension();
                $imagename = time() . '-' . rand() . '-' . $imagename;
                $check = in_array($extention, $allowedfileExtention);
                if ($check) {
                    if ($k == 0) {
                        $imgstatus = 'Active';
                    } else {
                        $imgstatus = 'Inactive';
                    }
                    $imagefile->move(public_path('asset/img/Productimage'), $imagename);
                    $product->save();
                    $productImage = new ProductImage();
                    $productImage->productid = $product->id;
                    $productImage->imagename = $imagename;
                    $productImage->istatus = $imgstatus;
                    $productImage->save();
                } else {
                    return redirect('/addproduct')->with('error', 'Pls Select Only jpeg or png image');
                }
            }
        }
        return redirect('/productindex')->with('success', 'Product Sucessfully Added');
    }

    public function show(Request $request)
    {
        $query = DB::table('products')
            ->join('categorys', 'categorys.id', '=', 'products.cname')
            ->join('product_images', 'product_images.productid', '=', 'products.id')
            ->select('categorys.cname as catid', 'categorys.id', 'products.*', 'product_images.*')
            ->where('product_images.istatus', '=', 'Active');
        if ($request->prod_search) {
            $search = $request->prod_search;
            $prodData = $query
                ->where('products.pname', 'like', '%' . $search . '%')
                ->where('categorys.cname','like','%'.$search.'%')
                ->get();    
        } else if ($request->start_price && $request->end_price) {
            $prodData = $query->whereBetween('products.price', [$request->start_price, $request->end_price])
                ->get();
        } else if ($request->qunatity_from && $request->qunatity_to) {
            $prodData = $query->whereBetween('products.quantity', [$request->qunatity_from, $request->qunatity_to])
                ->get();
        } else {
            return redirect('/productindex');
        }
        return view('productlist')->with('product', $prodData);
    }

    public function edit($id)
    {
        $editprod = Product::find($id);
        // dd($editprod->imagenames);
        if ($editprod) {
            $category = Category::all();
            $images = ProductImage::all()->where('productid', $id);
            // dd($images);
            return view('productadd')->with('editprod', $editprod)
                ->with('category', $category)
                ->with('images', $images);
        }
    }

    public function setactive($id, $imgid)
    {
        // dd($imgid);
        ProductImage::where('imgid', $imgid)->update(['istatus' => 'Active']);
        ProductImage::where('productid', $id)->where('imgid', '!=', $imgid)->update(['istatus' => 'Inactive']);
        return redirect()->back();
    }

    public function delimage($imgid)
    {
        // dd($imgid);
        $del = ProductImage::find($imgid);
        if (file_exists(public_path('asset/img/Productmage/' . $del->imagename))) {
            unlink(public_path('asset/img/Productmage/' . $del->imagename));
            $del->delete();
            return redirect()->back();
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'pname' => 'required',
            'cname' => 'required',
            'price' => 'required',
            'saleprice' => 'required',
            'quantity' => 'required',
            'porder' => 'required',
            'pstatus' => 'required'
        ]);
        $productImage = $request->imagename;
        if ($productImage != null) {
            Product::where('id', $id)->update(array(
                'pname' => $request->pname,
                'cname' => $request->cname,
                'price' => $request->price,
                'saleprice' => $request->saleprice,
                'quantity' => $request->quantity,
                'porder' => $request->porder,
                'pstatus' => $request->pstatus,
            ));
            $img = $request->file('imagename');
            if ($img) {
                $allowedfileExtention = ['jpeg', 'png', 'jpg'];
                foreach ($img as $imagefile) {
                    $imagename = $imagefile->getClientOriginalName();
                    $extention = $imagefile->getClientOriginalExtension();
                    $imagename = time() . '-' . rand() . '-' . $imagename;
                    $check = in_array($extention, $allowedfileExtention);
                    if ($check) {
                        $imagefile->move(public_path('asset/img/Productimage'), $imagename);
                        $productImage = new ProductImage();
                        $productImage->productid = $id;
                        $productImage->imagename = $imagename;
                        $productImage->istatus = 'Inactive';
                        $productImage->save();
                    }
                }
            }
            return redirect('/productindex')->with('success', 'Product Sucessfully Updated');
        } else {
            Product::where('id', $id)->update(array(
                'pname' => $request->pname,
                'cname' => $request->cname,
                'price' => $request->price,
                'saleprice' => $request->saleprice,
                'quantity' => $request->quantity,
                'porder' => $request->porder,
                'pstatus' => $request->pstatus,
            ));
            return redirect('/productindex')->with('success', 'Product Sucessfully Updated');
        }
    }

    public function destroy($id)
    {
        $imagename = ProductImage::where('productid', $id)->get();
        foreach ($imagename as $filename) {
            if (file_exists(public_path('asset/img/ProductImage/' . $filename->imagename))) {
                unlink(public_path('asset/img/ProductImage/' . $filename->imagename));
            }
        }
        ProductImage::where('productid', $id)->delete();
        Product::where('id', $id)->delete();
        return redirect('/productindex')->with('error', 'Product Sucessfully Deleted');
    }
}
