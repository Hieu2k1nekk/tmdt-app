<?php

namespace App\Http\Controllers;

use App\Services\Interfaces\LanguageServiceInterface;
use App\Models\Language;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    protected $languageService;
    public function __construct(LanguageServiceInterface $languageService)
    {
        $this->languageService = $languageService;
    }

    public function index()
    {
        $languages = Language::all();
        return view('languages.index', compact('$languages'));
    }

    // Hiển thị form tạo ngôn ngữ mới
    public function create()
    {
        return view('languages.create');
    }

    // Lưu ngôn ngữ mới
    public function store(Request $request)
    {
        $data = [
            'name' => $request->name,
            'canonical' => $request->canonical,
            'image' => $request->image,
            'user_id' => $request->user_id,

        ];
        $result = $this->languageService->create($data);
        if ($result) {
            return redirect()->route('languages.index')->with('success', 'Ngôn ngữ đã được lưu!');
        } else {
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi lưu ngôn ngữ.');
        }
    }
    public function bulkDelete()
    {
    }
}
