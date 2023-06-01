@extends('admin.layout')

@section('thelogin')
<!--start content-->
<main class="page-content m-auto mt-5">   
    <div class="card col-md-12 col-lg-3 m-auto mt-5">
                @if(count($errors) > 0)
                <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
                </div>
                @endif
        <div class="card-body">
            <div class="border p-3 rounded">
                <h6 class="mb-0 text-uppercase">SHECLUDED (Login)</h6>
                <hr/>
                <form class="row g-3" action="{{Route('check-user')}}" method="post">
                    @if(Session::has('fail'))
                    <div class="alert alert-danger">{{Session::get('fail')}}</div>
                    @endif
                    @csrf
                    <div class="col-12">
                        <label class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" value="" />
                    </div>
                    <div class="col-12">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" />
                    </div>
                    <div class="col-12 text-center">
                        <a href="javascript:;">Forgot Password?</a>
                    </div>
                    <div class="col-5 m-auto mt-4">
                        <div class="d-grid">
                            <button type="submit" name="login" class="btn btn-primary">Sign in</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
<!--end page main-->
@endsection