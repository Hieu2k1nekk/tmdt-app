<?php

namespace App\Services\Interfaces;



use Illuminate\Http\Request;

interface LanguageServiceInterface
{
    public function paginate(Request $request);
    public function handleImageUpload($image);
}
