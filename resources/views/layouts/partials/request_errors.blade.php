@if ($errors->any())

    <div class="alert alert-danger" role="alert" >
        <div class="alert-body" >
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>

@endif
