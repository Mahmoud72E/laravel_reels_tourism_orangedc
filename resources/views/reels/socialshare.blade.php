
    <ul>
        @foreach ($socialShare as $key => $social)
        <li><a href="{{$social}}">{{$key}}</a></li>
        @endforeach
    </ul>
