<!--Check if there are any messages within the session-->
{{-- <div class="" style=" width:50%; margin:0 auto;margin-top: 10%;"> --}}
@if(session('success'))
    <div class="alert rounded mt-5 alert-success" style="margin-top: 8%; width:50%; margin:0 auto;" align="center">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert rounded mt-5 alert-danger bg-danger text-white fw-bolder " style="margin-top: 8%;  width:50%;  margin:0 auto;" align="center"> 
        {{ session('error') }}
    </div>
@endif

@if ($errors->any())
    <div class="alert rounded mt-5 alert-danger bg-danger  text-white fw-bolder" style="margin-top: 8%;  width:50%;  margin:0 auto;" align="center">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
</div>