@component('mail::message')
  # {{ $maildata['title'] }}

  {{ $maildata['message'] }}
  @if (isset($maildata['url']))
    @component('mail::button', ['url' => $maildata['url']])
      Klik
    @endcomponent
  @endif

  @if (isset($maildata['button']))
    <a href="http://www.google.com/calendar/render?
          action=TEMPLATE
          &text=[event-title]
          &dates=[start-custom format='Ymd\\THi00\\Z']/[end-custom format='Ymd\\THi00\\Z']
          &details=[description]
          &location=[location]
          &trp=false
          &sprop=
          &sprop=name:"
      target="_blank" rel="nofollow">Add to my calendar</a>
  @endif

  Thanks,<br>
  {{ config('app.name') }}
@endcomponent
