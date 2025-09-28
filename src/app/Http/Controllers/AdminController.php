<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $contacts = Contact::with('category')->get();
        $users = User::all();
        return view('admin.index', compact('contacts', 'users'));
    }

    public function show($id)
    {
        $contact = Contact::with('category')->findOrFail($id);
        return view('admin.show', compact('contact'));
    }

    public function destroy($id)
    {
        Contact::findOrFail($id)->delete();
        return redirect()->route('admin.index')->with('success', '削除しました');
    }
}