<?php
namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Contact;
use App\Http\Requests\ContactRequest;
use Illuminate\Http\Request;

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

        // 📞 電話番号を結合
        $validated['tel'] = $validated['tel1'] . '-' . $validated['tel2'] . '-' . $validated['tel3'];

        $categoryName = optional(Category::find($validated['category_id']))->content;

        return view('contacts.confirm', [
            'validated'    => $validated,
            'categoryName' => $categoryName,
        ]);
    }

    /**
     * 確認→修正（入力フォームに戻り、old() で値を復元）
     */
    public function back(Request $request)
    {
        return redirect()
            ->route('contacts.create')
            ->withInput($request->all());
    }

    /**
     * 保存処理（DBへ保存後、サンクスへ）
     */
    public function store(Request $request)
    {
        $data = $request->all();

        // 📞 電話番号を結合
        $data['tel'] = $data['tel1'] . '-' . $data['tel2'] . '-' . $data['tel3'];

        // 🔽 余分な hidden 値を削除
        unset($data['tel1'], $data['tel2'], $data['tel3']);

        // 建物名が空なら空文字に
        $data['building'] = $data['building'] ?? '';

        Contact::create($data);

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