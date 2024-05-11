@if (count($errors) > 0)

    <div class="alert alert-fill-danger">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h3 style="margin-right: 10px">الأخطاء</h3>
        @foreach($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    </div>
@endif