@php
    $session=Session::get('alert');
@endphp
<div class="alert {{$session['clase']}}">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <strong>{{$session['tipo']}}</strong>: {!! $session['msg'] !!}
</div>
