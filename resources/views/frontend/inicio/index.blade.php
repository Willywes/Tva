@extends('frontend.template.base')

@section('top')

    @include('frontend.inicio._carousel')

    {{--@include('frontend.inicio._destacados')--}}

@endsection

@section('content')

    @include('frontend.carta._tiendas')

@endsection

@section('styles')

@endsection

@section('scripts')


    <script>
        // makes the parallax elements
        function parallaxIt() {

            // create variables
            var $fwindow = $(window);
            var scrollTop = window.pageYOffset || document.documentElement.scrollTop;

            // on window scroll event
            $fwindow.on('scroll resize', function () {
                scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            });

            // for each of content parallax element
            $('[data-type="content"]').each(function (index, e) {
                var $contentObj = $(this);
                var fgOffset = parseInt($contentObj.offset().top);
                var yPos;
                var speed = ($contentObj.data('speed') || 1);

                $fwindow.on('scroll resize', function () {
                    yPos = fgOffset - scrollTop / speed;

                    $contentObj.css('top', yPos);
                });
            });

            // for each of background parallax element
            $('[data-type="background"]').each(function () {
                var $backgroundObj = $(this);
                var bgOffset = parseInt($backgroundObj.offset().top);
                var yPos;
                var coords;
                var speed = ($backgroundObj.data('speed') || 0);

                $fwindow.on('scroll resize', function () {
                    yPos = -((scrollTop - bgOffset) / speed);
                    coords = '40% ' + yPos + 'px';

                    $backgroundObj.css({backgroundPosition: coords});
                });
            });

            // triggers winodw scroll for refresh
            $fwindow.trigger('scroll');
        };

        parallaxIt();
    </script>

@endsection