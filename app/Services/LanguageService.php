<?php

namespace App\Services;

use App\Models\Language;
use App\Repositories\Interfaces\LanguageRepositoryInterface as LanguageRepository;
use App\Services\Interfaces\LanguageServiceInterface;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

/**
 * Class UserService
 * @package App\Services
 */
class LanguageService implements LanguageServiceInterface
{
    protected $languageRepository;

    public function __construct(LanguageRepository $languageRepository)
    {
        $this->languageRepository = $languageRepository;
    }
    public function paginate(Request $request)
    {
        $config = config('apps.language');
        $perPage = $request->get('per_page', 20);

        // Khởi tạo truy vấn mặc định
        $query = Language::query(); // Khởi tạo truy vấn mặc định

        // Kiểm tra nếu có từ khóa tìm kiếm
        if ($request->has('search') && $request->get('search') != '') {
            $search = $request->get('search');
            $query->where('name', 'LIKE', "%{$search}%");
        }

        // Phân trang và trả về dữ liệu
        $languages = $query->paginate($perPage);

        return [
            'languages' => $languages,
            'config' => $config,
        ];
    }

    public function handleImageUpload($image)
    {
        if ($image) {
            // Tạo một đối tượng hình ảnh từ file được tải lên
            $img = Image::make($image);

            // Giảm kích thước hình ảnh, ví dụ: giảm chiều rộng xuống 800px
            $img->resize(800, null, function ($constraint) {
                $constraint->aspectRatio(); // Giữ tỷ lệ khung hình
                $constraint->upsize(); // Không tăng kích thước hình ảnh
            });

            // Lưu hình ảnh vào thư mục
            $path = 'images/languages/' . uniqid() . '.' . $image->getClientOriginalExtension();
            $img->save(public_path('storage/' . $path));

            return $path; // Trả về đường dẫn đã lưu
        }

        return null; // Trả về null nếu không có hình ảnh
    }

}
