<?php

namespace App\Models;

use App\Services\OpenAIService;
use Chatify\Traits\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

use Illuminate\Database\Eloquent\SoftDeletes;

class ChMessage extends Model
{
    use UUID;
    use SoftDeletes;

    public const FAVORITE_IN = 1;// 加入收藏
    public const FAVORITE_OUT = 0;// 移出收藏

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
