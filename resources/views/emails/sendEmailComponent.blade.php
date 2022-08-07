@component('mail::message')
  # {{ $maildata['title'] }}

  {{ $maildata['message'] }}
  @if (isset($maildata['url']))
    @component('mail::button', ['url' => $maildata['url']])
      Klik
    @endcomponent
  @endif
  @if (isset($maildata['humas']))
    @component('mail::button', ['url' => 'http://wa.me/' . $maildata['title']->no_wa])
      {{ $maildata['title']->nama }}
    @endcomponent
  @endif
  @if (isset($maildata['googleCalendar']))
    @component('mail::button', ['url' => $maildata['googleCalendar']])
      Tambah Ke Kalender
    @endcomponent
  @endif

  Thanks,<br>
  {{ config('app.name') }}
@endcomponent
