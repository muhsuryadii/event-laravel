@component('mail::message')
  # {{ $maildata['title'] }}

  {{ $maildata['message'] }}
  @if (isset($maildata['url']))
    @component('mail::button', ['url' => $maildata['url']])
      Klik
    @endcomponent
  @endif

  Thanks,<br>
  {{ config('app.name') }}
@endcomponent
