<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Http\Requests\ContactRequest;

class Test1Controller extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function confirm(ContactRequest $request)
    {
        $contact = $request->only(['last_name', 'first_name', 'gender', 'email', 'phone1', 'phone2', 'phone3', 'address', 'building', 'inquiry_type', 'detail']);
        $genders = [1 => '男性', 2 => '女性', 3 => 'その他'];
        $contact['gender'] = $genders[$contact['gender']];

        return view('confirm', compact('contact'));
    }

    public function store(ContactRequest $request)
    {
        // dd($request->gender); この時点でgenderは"男性"
        $contact = $request->only(['last_name', 'first_name', 'gender', 'email', 'address', 'building', 'inquiry_type', 'detail']);
        $genders = ['男性' => 1, '女性' => 2, 'その他' => 3];
        $contact['gender'] = $genders[$contact['gender']];
        // dd($contact['gender']); この時点でgenderは"1"
        $contact['tell'] = $request->phone1 . '-' . $request->phone2 . '-' . $request->phone3;

        // inquiry_type フィールドを設定
        // $contact['inquiry_type'] = $request->input('inquiry_type');

        Contact::create($contact);

        // $categories = $request->only(['inquiry_type']);
        // Category::create($categories);

        return view('thanks');
    }
}
