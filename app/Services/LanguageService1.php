<?php

namespace App\Services;

use App\Services\Interfaces\LanguageService1Interface;
use App\Repositories\Interfaces\LanguageRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class LanguageService1
 * @package App\Services
 */
class LanguageService1 implements LanguageService1Interface
{
    protected $languageRepository;

    public function __construct(LanguageRepositoryInterface $languageRepository)
    {
        $this->languageRepository = $languageRepository;
    }

    public function create(Request $request)
    {
        DB::beginTransaction();

        try {
            // Lấy dữ liệu từ request, loại bỏ các trường không cần thiết
            $payload = $request->except(['_token', 'send']);

            // Gọi repository để tạo mới ngôn ngữ
            $this->languageRepository->create($payload);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            // Bạn có thể ghi log hoặc xử lý lỗi tại đây nếu cần
            return false;
        }
    }
    private function paginateSelect()
    {
        return [
            'id',
            'name',
            'canonical',
            'publish',
        ];
    }
}
