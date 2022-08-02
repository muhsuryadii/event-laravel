@extends('errors::minimal')

@section('title', __('Server Error'))
@section('code', '500')
@section('message', __('Terjadi Kesalahan Pada Server'))

{{-- <x-app-costumer-layout>
  <section>
  </section>
</x-app-costumer-layout> --}}
