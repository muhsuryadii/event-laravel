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
    <p
      style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';font-size:16px;line-height:1.5em;margin-top:0;text-align:left">
      Anda juga dapat menambahkan pengingat ke Google Calendar dengan menekan tombol dibawah ini.
    </p>
    @component('mail::button', ['url' => $maildata['googleCalendar']])
      Tambah Ke Kalender
    @endcomponent
  @endif

  Thanks,<br>
  {{ config('app.name') }}
@endcomponent
