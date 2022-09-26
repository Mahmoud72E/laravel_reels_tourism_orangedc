<div class="container">

    <a href="{{route('reel.create')}}">+ Add New Reel</a><br><br>
    @foreach ($reels as $reel)
        <a href="{{route('reel.show', $reel->id )}}">
            <img src="{{asset('reels/'. $reel->reel_path)}}" alt="" width="90px" height="100px">
        </a><br>
        <p>{{$reel->title}}</p>
        <p>{{$reel->description}}</p>
        {{-- <p>{{$reel->reel_path}}</p> --}}



        <a href="{{route('comment.index', $reel->id)}}">add Comment</a>
        <a href="{{route('share.button', $reel->id)}}">share</a><br><br>
    @endforeach


    {{-- <h3>Encrypt Database Fields in Laravel</h3> --}}
    {{-- $reels->id --}}

    <h1>
    <br>
    <table class="table">
       <thead>
          <tr>
            {{-- <th>{{$userid->name}}</th>
             <th>{{$placeid->place}}</th> --}}
             <th></th>
             <th></th>
          </tr>
       </thead>
       <tbody>
          @foreach($reels as $key => $data)
          <tr>
             {{-- <td>{{ $key+1 }}</td>
             <td>{{ $data->title }}</td>
             <td>{{ $data->reel_path }}</td>
             <td>{{ $data->description }}</td> --}}
          </tr>
       </tbody>
       @endforeach
    </table>
 </div>
