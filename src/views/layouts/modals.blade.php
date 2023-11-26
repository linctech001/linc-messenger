{{-- ---------------------- Image modal box ---------------------- --}}
<div id="imageModalBox" class="imageModal">
  <span class="imageModal-close">&times;</span>
  <img class="imageModal-content" id="imageModalBoxSrc">
</div>

{{-- ---------------------- Delete Modal ---------------------- --}}
<div class="app-modal" data-name="delete">
  <div class="app-modal-container">
    <div class="app-modal-card" data-name="delete" data-modal='0'>
      <div class="app-modal-header">{{ __('messenger.are_you_sure') }}?</div>
      <div class="app-modal-body">{{ __('messenger.cannot_undo') }}</div>
      <div class="app-modal-footer">
        <a href="javascript:void(0)" class="app-btn cancel">{{ __('messenger.cancel') }}</a>
        <a href="javascript:void(0)" class="app-btn a-btn-danger delete">{{ __('messenger.delete') }}</a>
      </div>
    </div>
  </div>
</div>
{{-- ---------------------- Alert Modal ---------------------- --}}
<div class="app-modal" data-name="alert">
  <div class="app-modal-container">
    <div class="app-modal-card" data-name="alert" data-modal='0'>
      <div class="app-modal-header"></div>
      <div class="app-modal-body"></div>
      <div class="app-modal-footer">
        <a href="javascript:void(0)" class="app-btn cancel">{{ __('messenger.cancel') }}</a>
      </div>
    </div>
  </div>
</div>
{{-- ---------------------- Settings Modal ---------------------- --}}
<div class="app-modal" data-name="settings">
  <div class="app-modal-container">
    <div class="app-modal-card" data-name="settings" data-modal='0'>
      <form id="update-settings" action="{{ route('avatar.update') }}" enctype="multipart/form-data" method="POST">
        @csrf
        {{-- <div class="app-modal-header">{{ __('messenger.update_profile_settings') }}</div> --}}
        <div class="app-modal-body">
          {{-- Udate profile avatar --}}
          <div class="avatar av-l upload-avatar-preview chatify-d-flex" style="background-image: url('{{ Auth::user()->getProfilePhoto() }}');"></div>
          <!-- <p class="upload-avatar-details"></p>
          <label class="app-btn a-btn-primary update" style="background-color:{{$messengerColor}}">
            Upload New
            <input class="upload-avatar chatify-d-none" accept="image/*" name="avatar" type="file" />
          </label> -->
          {{-- Dark/Light Mode  --}}
          <p class="divider"></p>
          <p class="app-modal-header">{{ __('messenger.dark_mode') }} <span class="{{ Auth::user()->dark_mode > 0 ? 'fas' : 'far' }} fa-moon dark-mode-switch" data-mode="{{ Auth::user()->dark_mode > 0 ? 1 : 0 }}"></span></p>
          {{-- change messenger color  --}}
          <p class="divider"></p>
          {{-- <p class="app-modal-header">{{ __('messenger.change') }} {{ __('messenger.name_unknown') }} {{ __('messenger.color') }}</p> --}}
          <div class="update-messengerColor">
            @foreach (config('chatify.colors') as $color)
            <span style="background-color: {{ $color}}" data-color="{{$color}}" class="color-btn"></span>
            @if (($loop->index + 1) % 5 == 0)
            <br />
            @endif
            @endforeach
          </div>
        </div>
        <div class="app-modal-footer">
          <a href="javascript:void(0)" class="app-btn cancel">{{ __('messenger.cancel') }}</a>
          <input type="submit" class="app-btn a-btn-success update" value="{{ __('messenger.save_changes') }}" />
        </div>
      </form>
    </div>
  </div>
</div>