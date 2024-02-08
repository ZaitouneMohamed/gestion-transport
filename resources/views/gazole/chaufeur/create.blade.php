@extends('gazole.layouts.master')

@section('content')
    <form method="POST" action="{{ route('chaufeur.store') }}">
        @csrf
        <div class="row">
            <div class="col-6">
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Full Name *</label>
                    <input type="text" name="full_name" placeholder="chaufeur name" class="form-control"
                        id="exampleInputPassword1">
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Code *</label>
                    <input type="text" name="code" placeholder="chaufeur code" class="form-control"
                        id="exampleInputPassword1">
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Email</label>
                    <input type="email" name="email" placeholder="chaufeur email" class="form-control"
                        id="exampleInputPassword1">
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">phone</label>
                    <input type="text" name="phone" placeholder="chaufeur phone" class="form-control"
                        id="exampleInputPassword1">
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">numero 2</label>
                    <input type="text" name="numero_2" placeholder="chaufeur phone" class="form-control"
                        id="exampleInputPassword1">
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">adresse</label>
                        <textarea name="adresse" id="" placeholder="chaufeur adresse" class="form-control" cols="30" rows="10"></textarea>
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">cnss</label>
                    <input type="text" name="cnss" placeholder="chaufeur cnss" class="form-control"
                        id="exampleInputPassword1">
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">cni</label>
                    <input type="text" name="cni" placeholder="chaufeur cni" class="form-control"
                        id="exampleInputPassword1">
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
