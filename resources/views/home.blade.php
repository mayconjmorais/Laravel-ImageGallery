@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Welcome back, '). Auth::user()->name }}

                    <div class="form-group row mb-1">
                        <form action= "{{ route('imagestore') }}" method= "POST" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="image" required>
                            <input type="submit" name="upload" value="Add">
                            <input type="hidden" name="owner" value= "{{$user->id}}" ><br>
                            <input type="checkbox" name="hidden" id="hide" >
                            <label>Hidden</label>
                        </form>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="card-body">
                    @csrf
                    <table class="table">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Owner</th>
                            <th scope="col">Hidden</th>
                            <th scope="col">Date</th>
                            <th scope="col">Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($images as $img)
                                @if ($img->owner === $user->id)
                                    <tr>
                                        <th scope="row">{{$img->id}}</th>
                                        <td>{{$img->title}}</td>
                                        <td>{{$img->owner}}</td>
                                        <td>
                                            @if ($img->hidden === 'on')
                                                <a href="/hiddenimage/{{$img->id}}" class="btn btn-success">on</button>
                                            @else
                                                <a href="/hiddenimage/{{$img->id}}" class="btn btn-warning">off</button>
                                            @endif
                                        </td>
                                        <td>{{$img->created_at}}</td>
                                        <td>
                                            <a class=" js-del btn btn-danger" href="/deleteimage/{{$img->id}}">
                                                <i>DELETE</i>
                                            </a>
                                        </td>
                                        </tr>    
                                    @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
