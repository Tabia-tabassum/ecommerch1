<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ProductOffer;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Blog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class SiteController extends Controller
{
    public  $userId ;
    public function __construct(Request $request)
    {
        $this->userId = $request->cookie('adminId');
    }

    function home(Request $request)
    {

        $search = $request->input('search');

        if (!empty($search)) {
            $all_blog = Blog::with('category.postCategory')
                ->where('blog_title', 'like', '%' . $search . '%')
                ->orWhere('details', 'like', '%' . $search . '%')
                ->get();

        } else {
            $all_blog = Blog::with('category.postCategory')->get();
        }
        return view('home', ['all_blog' => $all_blog]);

    }

    function About()
    {
        return view('about');
    }

    function Contact()
    {
        return view('contact');
    }

    function Details(Request $request)
    {
        $id = $request->id;
        $blog_details = Blog::where('id', $id)->first();
        return view('details', ['blog_details' => $blog_details]);
    }

    function Registation()
    {
        return view('registation');
    }

    function Login()
    {
        return view('login');
    }

    public function orderProduct(Request $request, $id)
    {
        $placeOrder = ProductOffer::create([
            'product_id' => $id,
            'quantity' => $request->post('quantity'),
            'price' => $request->post('quantity') * $request->post('offerPrice'),
            'address' => $request->post('address'),
            'user_id' => $request->post('userId'),
            'phone' => $request->post('phoneNumber'),
        ]);

        if ($placeOrder) {
            return redirect()->back()->with(['success' => 'Product Ordered Successfully']);
        }
    }

//    this is admin function

    function Admin_Home()
    {
        $adminId = Cookie::get('adminId');
        $role = Cookie::get('role');
        if ($adminId && $role != 1) {
            $all_blog = Blog::where('user_id', $adminId)->get();
        } else {
            $all_blog = Blog::all(); // Or whatever query you need for non-admin users
        }
        return view('admin.admin', ['all_blog' => $all_blog]);
    }

    function Add_blog()
    {
        $data['allCategories'] = Category::all();
        return view('admin.add_blog', $data);
    }

    function update_blog(Request $request)
    {
        $adminId = Cookie::get('adminId');
        $role = Cookie::get('role');
        if ($adminId && $role != 1) {
            $all_blog = Blog::where('user_id', $adminId)->get();
        } else {
            $all_blog = Blog::all(); // Or whatever query you need for non-admin users
        }
        return view('admin.update_blog', ['all_blog' => $all_blog]);
    }


    public function showOrderDetails()
    {
        if(Cookie::get('role')==1){
            $data['allOrderDetails'] = ProductOffer::with(['getProduct'])->orderBy('id', 'DESC')->get();
        }else{
            $data['allOrderDetails'] = ProductOffer::with(['getProduct'])->where('user_id',Cookie::get('adminId'))->orderBy('id', 'DESC')->get();
        }

        return view('admin.order', $data);
    }

    public function removeOrder(Request $request)
    {
        $id = $request->input('id');

        $responce = ProductOffer::where('id', $id)->delete();

        if ($responce == 1) {
            return 1;
        }

    }

    function update_form_submit(Request $request)
    {
        $id = $request->id;
        $blog_details = Blog::where('id', $id)->with(['category'])->first();
        $allCategories =Category::all() ;

        return view('admin.update_form',['blog_details'=>$blog_details,
            'allCategories'=>$allCategories
        ]);
    }

//    admin registation
    function admin_registaion(Request $request)
    {
        $admin_name = $request->input('admin_name');
        $admin_email = $request->input('admin_email');
        $admin_password = $request->input('admin_password');
        $role = $request->input('role');

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

        $already_have_email = Admin::where('email', $admin_email)->count();
        $name = Admin::where('name', $admin_name)->count();


        if ($name) {
            return "Alreday have this Name";
        }


        if ($already_have_email) {
            return "Already have this Email";
        }

        if (filter_var($admin_email, FILTER_VALIDATE_EMAIL) == false) {
            return "Please Enter Valid Email";
        }

        $responce = Admin::insert([
            'name' => $admin_name,
            'email' => $admin_email,
            'password' => $admin_password,
            'role' => $role,

        ]);

        if ($responce == 1) {
            return 1;
        }


    }

    function admin_login(Request $request)
    {
        $admin_email_login = $request->input('admin_email_login');
        $admin_password_login = $request->input('admin_password_login');

        $admin_password_login = md5($admin_password_login);

        $responce = Admin::where('email', $admin_email_login)->where('password', $admin_password_login)->first();
        if ($responce) {
            cookie::queue('admin', $admin_email_login, 1296000);
            cookie::queue('adminId', $responce->id, 1296000);
            cookie::queue('role', $responce->role, 1296000);
            return 1;

        }


    }

    function admin_logout()
    {
        cookie::queue(cookie::forget('admin'));
        cookie::queue(cookie::forget('adminId'));
        return 1;
    }


//  add blog

    function add_blog_submit(Request $request)
    {
        $blog_title = $request->input('blog_title');
        $details = $request->input('details');
        $product_offer_price = $request->input('product_offer_price');
        $product_actual_price = $request->input('product_actual_price');

// start in blog image
        $blog_image = $request->file('blog_image')->store('/public/blog_image');

        $blog_image = (explode('/', $blog_image))[2];

        $host = $_SERVER['HTTP_HOST'];
        $blog_image = "http://" . $host . "/storage/blog_image/" . $blog_image;
// end in blog image

        $responce = Blog::create([
            'blog_title' => $blog_title,
            'details' => $details,
            'blog_image' => $blog_image,
            'user_id' => Cookie::get('adminId'),
            'product_offer_price' => $product_offer_price,
            'product_actual_price' => $product_actual_price,

        ]);

        if ($request->post('parentCategoryId')) {
            DB::table('post_categories')->insert([
                'post_id' => $responce->id,
                'category_id' => $request->post('parentCategoryId'),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        if ($responce) {
            return 1;
        }

    }

    function remove_blog(Request $request)
    {
        $id = $request->input('id');

        $responce = Blog::where('id', $id)->delete();

        if ($responce == 1) {
            return 1;
        }
    }

    function update_blog_submit_form(Request $request){
        $blog_title = $request->input('blog_title');
        $details = $request->input('details');
        $blog_edit_id = $request->input('blog_edit_id');
        $blog_image=null;
        $blog = Blog::where('id',$blog_edit_id)->first();

// start in blog image
        if ($request->file('blog_image')){
            $blog_image =  $request->file('blog_image')->store('/public/blog_image');

            $blog_image=(explode('/',$blog_image))[2];

            $host=$_SERVER['HTTP_HOST'];
            $blog_image="http://".$host."/storage/blog_image/".$blog_image;
        }else{
            $blog_image =$blog->blog_image;
        }

// end in blog image

        $responce = Blog::where('id',$blog_edit_id)->update([
            'blog_title' => $blog_title,
            'details' => $details,
            'blog_image' => $blog_image,
        ]);

        if($responce == 1){
            return 1;
        }


    }

}
