<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SellerController extends Controller
{
    public function index()
    {
        $all_blog['all_blog']=Admin::where('role',2)->get();
        return view('admin.seller',$all_blog);
    }

    public function editAllSeller($id)
    {
        $item = Admin::where('id',$id)->first();
        return view('admin.update_seller',['item'=>$item]);
    }

    public function storeSeller(Request $request)
    {
        $admin_password = $request->input('password');
        // Validate password strength start
        $uppercase = preg_match('@[A-Z]@', $admin_password);
        $lowercase = preg_match('@[a-z]@', $admin_password);
        $number = preg_match('@[0-9]@', $admin_password);
        $specialChars = preg_match('@[^\w]@', $admin_password);

        if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($admin_password) < 8) {
            return "Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.";
        }
        // Validate password strength end

        $admin_password = md5($admin_password);

        Admin::create([
            'name'=>$request->input('name'),
            'email'=>$request->input('email'),
            'role'=>2,
            'password'=>$admin_password,
        ]);

        return redirect()->route('admin.seller');
    }

    public function addSeller()
    {
        return view('admin.add_seller');
    }

    public function deleteSeller(Request $request)
    {
        $id = $request->input('id');

        $responce = Admin::where('id', $id)->delete();

        if ($responce == 1) {
            return 1;
        }
    }

    public function updateSeller(Request $request,$id)
    {
        Admin::where('id',$id)->first()->update([
            'name'=>$request->input('name'),
            'email'=>$request->input('email'),
        ]);

        return redirect()->route('admin.seller');
    }
}
