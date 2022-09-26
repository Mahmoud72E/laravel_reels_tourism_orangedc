<form action="{{route('comment.store')}}" method="POST">
    @csrf
    <input type="text" name='comment'>
    <input type="hidden" name='uid' value="1">
    <input type="hidden" name="rid" value="{{$rid}}">
    <button type="submit">Submit</button>
</form>