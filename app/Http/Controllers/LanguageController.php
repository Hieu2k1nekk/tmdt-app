<?php

namespace App\Http\Controllers;

use App\Services\Interfaces\LanguageServiceInterface;
use App\Models\Language;
use Illuminate\Http\Request;
use App\Services\Interfaces\LanguageServiceInterface as LanguageService;
use App\Repositories\Interfaces\LanguageRepositoryInterface as LanguageRepository;
use Illuminate\Support\Facades\Auth;

class LanguageController extends Controller
{
    protected $languageService;
    protected $languageRepository;
    public function __construct(LanguageService $languageService,LanguageRepository $languageRepository)
    {
        $this->languageService = $languageService;
        $this->languageRepository = $languageRepository;
    }

    public function index(Request $request)
    {
        $data = $this->languageService->paginate($request);

        return view('languages.index', [
            'languages' => $data['languages'],
            'config' => $data['config'],
        ]);
    }

    // Hiển thị form tạo ngôn ngữ mới
    public function create()
    {
        return view('languages.create');
    }

    // Lưu ngôn ngữ mới
    public function store(Request $request)
    {
        $imagePath = $this->languageService->handleImageUpload($request->file('image'));

        $data = [
            'name' => $request->name,
            'canonical' => $request->canonical,
            'image' => $imagePath,
            'user_id' => Auth::id(),

        ];
        $result = $this->languageRepository->create($data);
        if ($result) {
            return redirect()->route('language.index')->with('success', 'Ngôn ngữ đã được lưu!');
        } else {
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi lưu ngôn ngữ.');
        }
    }
    public function bulkDelete()
    {
    }
}
