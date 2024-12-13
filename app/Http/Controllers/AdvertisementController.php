<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdvertisementController extends Controller
{
    public function index(){
        $categories = Category::all();
        $advertisements = Advertisement::all()->where('status', 'Одобрено');
        return view('advertisement', compact('categories','advertisements'));
    }
    public function category($id){
        $categories = Category::all();
        $advertisements = Advertisement::where('category_id', $id) -> where('status', 'Одобрено')->get();
        return view('adv-category', compact('categories', 'advertisements'));
    }
    public function form(){
        $categories = Category::all();
        return view('adv_form', compact('categories'));
    }
    public function create(Request $request){
        $request -> validate([
            'title' => 'required|min:8',
            'description' => 'required',
            'ad_photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ],
        [
            'title.required' => 'Пустой заголовок, хуесос',
            'title.min' => 'Напряги извилины на 8 символов',
            'description.required' => 'Описание забыл',

            'ad_photo.required' => 'Фото забыл, даун',
            'ad_photo.image' => 'Это не фотка, еблан',
            'ad_photo.mimes' => 'Фотку или гифку, уебан',
            'ad_photo.max' => 'Миксимум 2мб, хуесос',
        ]);
        $ad_photo = time(). '.' . $request-> ad_photo -> extension();
        $user = Auth::user();
        $adv = Advertisement::create([
            'user_id' => $user->id,
//            'user_id' => $user->username, Правильный варинат = Раскоментить на паре
            'category_id' => $request -> category,
            'title' => $request -> title,
            'description' => $request -> description,
            'ad_photo' => $ad_photo,
            'status' => 'На рассмотрении',
        ]);
        $request -> ad_photo -> move(public_path('images/adimages'), $ad_photo);

        $category = Category::find([$request -> category]);
        $adv -> categories() -> attach($category);

        return redirect('');
    }
    public function destroy($id){
        Advertisement::where('id', $id) -> update(['status' => 'Отклонено']);
        return back();
    }
}
