<x-app-costumer-layout>

  <section>

    <div class='mt-16'>
      <div class="container">
        <h2 class="text-center text-2xl font-bold uppercase text-slate-700">
          List Event
        </h2>
        <div class="flex flex-row flex-wrap pb-5 pt-3">
          @foreach ($events as $event)
            
            @include('pages.customer.event.eventCard')
          @endforeach

        </div>
      </div>
    </div>

  </section>

</x-app-costumer-layout>
