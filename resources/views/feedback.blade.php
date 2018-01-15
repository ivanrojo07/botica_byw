@if(Session::has('feedback'))
    <div class="alert {{ Session::get('alert_type') }}">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>{{ Session::get('feedback') }}</strong>
    </div>
@endif