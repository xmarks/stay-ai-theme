{{--
  Template Name: Simple Text
--}}

@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-xxl-6 col-xl-8 col-lg-10 col-12 offset-xxl-3 offset-xl-2 offset-lg-1">
        <div class="simple-text">
          @while (have_posts())
            @php(the_post())
            @includeFirst(['partials.content-page', 'partials.content'])
          @endwhile
        </div>
      </div>
    </div>
  </div>
@endsection
