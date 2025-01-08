<?php

namespace App\Repositories;

use App\Models\Language;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\LanguageRepositoryInterface;

/**
 * Class UserService
 * @package App\Services
 */
class LanguageRepository extends BaseRepository implements LanguageRepositoryInterface
{
    public function getModel()
    {
        return Language::class;
    }

}
