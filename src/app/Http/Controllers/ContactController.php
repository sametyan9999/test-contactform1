<?php
namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Contact;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    /**
     * お問い合わせフォーム表示
     */
    public function create()
    {
        $categories = Category::all();
        return view('contacts.create', compact('categories'));
    }

    /**
     * 確認画面表示（バリデーション済みの入力を表示）
     */
    public function confirm(ContactRequest $request)
    {
        $validated = $request->validated();
        $categoryName = optional(Category::find($validated['category_id']))->content;

        return view('contacts.confirm', [
            'validated'    => $validated,
            'categoryName' => $categoryName,
        ]);
    }

    /**
     * 確認→修正（入力フォームに戻り、old() で値を復元）
     */
    public function back(ContactRequest $request)
    {
        return redirect()->route('contacts.create')->withInput($request->validated());
    }

    /**
     * 保存処理（DBへ保存後、サンクスへ）
     */
    public function store(ContactRequest $request)
    {
        $validated = $request->validated();
        // 建物名が空なら空文字を入れる（NULL回避）
        $validated['building'] = $validated['building'] ?? '';

        Contact::create($validated);

        return redirect()->route('contacts.thanks');
    }

    /**
     * サンクスページ
     */
    public function thanks()
    {
        return view('contacts.thanks');
    }
}