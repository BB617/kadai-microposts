@if (Auth::user()->is_favoriting($micropost->id))
    {{-- お気に入りを外すボタンのフォーム --}}
    {!! Form::open(['route' => ['favorites.unfavorite', $micropost_id->id], 'method' => 'delete']) !!}
        {!! Form::submit('Unfavorite', ['class' => "btn btn-danger btn-block"]) !!}
    {!! Form::close() !!}
    @else
    {{-- お気に入り登録のボタンのフォーム --}}
    {!! Form::open(['route' => ['favorites.favorite', $micropost->id]]) !!}
        {!! Form::submit('Favorite', ['class' => "btn btn-primary btn-block"]) !!}
    {!! Form::close() !!}
@endif