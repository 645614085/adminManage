@if(Session::has('message'))

    <div class="form-group">
        <div class="tips {{ 'text-'. Session::get('color', 'info') }}">
            <i class="pull-right">✕</i>
            {{ Session::get('message') }}
        </div>
    </div>
@endif
@if(count($errors->all()))
    <div class="tips text-danger">
        <i class="pull-right">✕</i>
        <ul>
            @foreach($errors->all('<li class="pad-y-5">:message</li>') as $error)
                {!! $error !!}
            @endforeach
        </ul>
    </div>
@endif