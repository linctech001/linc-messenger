<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Chatify\Traits\UUID;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Services\OpenAIService;

class ChMessage extends Model
{
    use UUID, SoftDeletes;

    public function translations(): HasMany
    {
        return $this->hasMany(ChMessageTranslate::class, 'translate_from', 'id');
    }

    public function messageTranslate($language): string
    {
        $translation = $this->translations()->where('target_language', $language)->first();

        if ($translation) {
            return $translation->body;
        } else {
            // 如果不存在翻译，调用接口进行翻译
            $translatedContent = $this->translateViaApi($this->body, $language);

            // 保存新的翻译到数据库
            $this->translations()->create([
                'translate_from' => $this->id,
                'target_language' => $language,
                'body' => $translatedContent
            ]);

            return $translatedContent;
        }
    }

    private function translateViaApi(string $needTranslateMessage, string $targetLanguage): string
    {
        // 调用接口进行翻译
        $openAIService = new OpenAIService();
        return $openAIService->translateText($needTranslateMessage, $targetLanguage);
    }
}
