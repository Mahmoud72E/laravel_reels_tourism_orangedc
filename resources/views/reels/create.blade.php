<form action="{{route('reel.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="text" name="title" placeholder="Title"><br><br>
    <input type="text" name="description" placeholder="Description"><br><br>
    <h3>Upload Your Video</h3>
    <input type="file" name="reel_path"><br><br>
    <h3>Chose Your Place</h3>
    <select name="place_id">
        <option value='0'>...</option>
        @foreach ($places as $place)
            <option value="{{$place->id}}">{{$place->place}}</option>
        @endforeach
    </select>
    <br><br>
    <button type="submit">submit</button>
</form>
