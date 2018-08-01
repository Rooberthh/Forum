@extends('admin.layout.app')

@section('administration-content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create a Channel</div>
                    <div class="card-body">
                        <form action="{{ route('admin.channels.store') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="title">Name:</label>
                                <input type="text" class="form-control" id="title" name="name" value="{{old('name')}}" required>
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <input type="text" class="form-control" id="description" name="description" value="{{ old('description') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="color">Color</label>
                                <input type="text" class="form-control" id="color" name="color" value="{{ old('color') }}" required>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Create Channel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
