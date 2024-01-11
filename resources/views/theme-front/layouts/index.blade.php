<!DOCTYPE html>
<html lang="en" dir="ltr">



@section('htmlheader')
	@include('theme-front.layouts.htmlheaders')
@show

<body>
    @include('theme-front.layouts.menu')


    @yield('content')

    @include('theme-front.layouts.footer')

    @section('scripts')
        @include('theme-front.layouts.scripts')
    @show


</body>


</html>
