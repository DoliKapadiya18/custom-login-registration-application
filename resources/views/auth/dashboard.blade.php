@extends('auth.layouts')

@section('content')

<div class="row justify-content-center mt-5">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Dashboard</div>
            <div class="card-body">
                
                @if ($message = Session::get('success'))
                    <div id="alert" class="alert alert-success">
                        {{ $message }}
                    </div>
                @else
                    <div id="alert" class="alert alert-success">
                        You are logged in!
                    </div>       
                @endif
                
                <h5>Welcome to the Dashboard</h5>
            </div>
        </div>
    </div>    
</div>
    
@endsection

@section('js')
    <script>
        $(document).ready(function () { 
            $("#alert").fadeOut(3000);
        });
    </script>
@endsection