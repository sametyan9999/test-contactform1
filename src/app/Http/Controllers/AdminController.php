<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Category;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AdminController extends Controller
{
    
    public function index(Request $request)
    {
        $query = Contact::with('category');

        // 名前検索（姓・名・フルネーム）
        if ($request->filled('name')) {
            $name = $request->name;
            $query->where(function ($q) use ($name) {
                $q->where('last_name', 'like', "%$name%")
                  ->orWhere('first_name', 'like', "%$name%")
                  ->orWhereRaw("CONCAT(last_name, first_name) LIKE ?", ["%$name%"]);
            });
        }

        // メールアドレス検索
        if ($request->filled('email')) {
            $query->where('email', 'like', "%{$request->email}%");
        }

        // 性別検索
        if ($request->filled('gender') && $request->gender !== 'all') {
            $query->where('gender', $request->gender);
        }

        // お問い合わせ種類検索
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // 日付検索
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        // ページネーション（7件ごと）
        $contacts = $query->paginate(7)->appends($request->all());
        $categories = Category::all();

        return view('admin.index', compact('contacts', 'categories'));
    }

    public function show($id)
    {
        $contact = Contact::with('category')->findOrFail($id);
        return response()->json($contact); // モーダル用にJSONを返す
    }

    public function destroy(Request $request, $id)
    {
        Contact::findOrFail($id)->delete();
        return redirect()->route('admin.index')->with('success', '削除しました');
    }

    // CSVエクスポート
    public function export(Request $request): StreamedResponse
    {
        $query = Contact::with('category');

        // 同じ検索条件を適用
        if ($request->filled('name')) {
            $name = $request->name;
            $query->where(function ($q) use ($name) {
                $q->where('last_name', 'like', "%$name%")
                  ->orWhere('first_name', 'like', "%$name%")
                  ->orWhereRaw("CONCAT(last_name, first_name) LIKE ?", ["%$name%"]);
            });
        }
        if ($request->filled('email')) {
            $query->where('email', 'like', "%{$request->email}%");
        }
        if ($request->filled('gender') && $request->gender !== 'all') {
            $query->where('gender', $request->gender);
        }
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        $contacts = $query->get();

        $response = new StreamedResponse(function () use ($contacts) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['姓', '名', '性別', 'メールアドレス', '電話番号', '住所', '建物名', 'カテゴリ', '内容', '登録日時']);

            foreach ($contacts as $contact) {
                fputcsv($handle, [
                    $contact->last_name,
                    $contact->first_name,
                    $contact->gender,
                    $contact->email,
                    $contact->tel,
                    $contact->address,
                    $contact->building,
                    $contact->category->content ?? '',
                    $contact->detail,
                    $contact->created_at,
                ]);
            }
            fclose($handle);
        });

        $response->headers->set('Content-Type', 'text/csv; charset=UTF-8');
        $response->headers->set('Content-Disposition', 'attachment; filename="contacts.csv"');

        return $response;
    }
}