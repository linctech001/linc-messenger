<?php
$seenIcon = (!!$seen ? 'check-double' : 'check');
$timeAndSeen = "<span data-time='$created_at' class='message-time'>" . ($isSender ? "<span class='fas fa-$seenIcon' seen'></span>" : '') . " <span class='time'>$timeAgo</span></span>";
?>

<div @class(['mc-sender' => $isSender, 'message-card' => true]) data-id="{{ $id }}">
  {{-- Delete Message Button --}}
  @if ($isSender)
  <div class="actions">
    <i class="fas fa-trash delete-btn" data-id="{{ $id }}"></i>
  </div>
  @endif
  {{-- Card --}}
  <div class="message-card-content">
    @if (@$attachment->type != 'image' || $message)
    <div class="message-card-body">
      <div class="message">
        {!! ($message == null && $attachment != null && @$attachment->type != 'file') ? $attachment->title : nl2br($message) !!}
        {!! $timeAndSeen !!}
        {{-- If attachment is a file --}}
        @if(@$attachment->type == 'file')
        <a href="/chatify/download/{{ $attachment->file }}" class="file-download">
          <span class="fas fa-file"></span> {{$attachment->title}}
        </a>
        @endif
      </div>
      @if (!empty($message) && is_string($message) && !$isSender)
      {{-- Translate Button --}}
      <div class="actions dropdown">
        <i class="trans-btn">
          <svg viewBox="0 0 24 24" focusable="false" width="1.2em" height="1.2em" fill="currentColor" aria-hidden="true">
            <path d="M0 0h24v24H0z" fill="none"></path>
            <path d="M12.87 15.07l-2.54-2.51.03-.03c1.74-1.94 2.98-4.17 3.71-6.53H17V4h-7V2H8v2H1v1.99h11.17C11.5 7.92 10.44 9.75 9 11.35 8.07 10.32 7.3 9.19 6.69 8h-2c.73 1.63 1.73 3.17 2.98 4.56l-5.09 5.02L4 19l5-5 3.11 3.11.76-2.04zM18.5 10h-2L12 22h2l1.12-3h4.75L21 22h2l-4.5-12zm-2.62 7l1.62-4.33L19.12 17h-3.24z " class="css-c4d79v"></path>
          </svg>
        </i>
        <div class="dropdown-content">
          <a href="javascript:transTo('Simplified Chinese', '{{ $id }}');"><span style="margin-right: 8px;">🇨🇳</span>中文</a>
          <a href="javascript:transTo('Vietnamese', '{{ $id }}');"><span style="margin-right: 8px;">🇻🇳</span>Tiếng Việt</a>
          <a href="javascript:transTo('English', '{{ $id }}');"><span style="margin-right: 8px;">🇺🇸</span>English</a>
          <a href="javascript:transTo('Japanese', '{{ $id }}');"><span style="margin-right: 8px;">🇯🇵</span>日本語</a>
        </div>
      </div>
      @endif
    </div>
    @endif
    @if (!empty($translations) && is_array($translations) && !$isSender)
    <div class="translates">
      @foreach ($translations as $translation)
      <div class="translate" data-language="{{ $translation['target_language'] }}">
          {!! nl2br($translation['body']) !!}
      </div>
      @endforeach
    </div>
    @endif
    @if(@$attachment->type == 'image')
    <div class="image-wrapper" style="text-align: {{$isSender ? 'end' : 'start'}}">
      <div class="image-file chat-image" style="background-image: url('{{ Chatify::getAttachmentUrl($attachment->file) }}')">
        <div>{{ $attachment->title }}</div>
      </div>
      <div style="margin-bottom:5px">
        {!! $timeAndSeen !!}
      </div>
    </div>
    @endif
  </div>
</div>
