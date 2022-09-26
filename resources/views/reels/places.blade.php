
<form action="{{route('reel.index')}}" method="GET">

    @csrf
    <select name="place_id">
        <option value='0'>...</option>
        @foreach ($places as $place)
            <option value="{{$place->id}}">{{$place->place}}</option>
        @endforeach
    </select><br><br>
    <button type="submit">submit</button>
</form>
