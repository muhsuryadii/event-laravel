@component('mail::message')
  # {{ $maildata['title'] }}

  {{ $maildata['message'] }}
  @if (isset($maildata['url']))
    @component('mail::button', ['url' => $maildata['url']])
      Klik
    @endcomponent
  @endif
  @if (isset($maildata['humas']))
    @component('mail::button', ['url' => 'http://wa.me/' . $maildata['humas']->no_wa])
      {{ $maildata['humas']->nama }}
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
