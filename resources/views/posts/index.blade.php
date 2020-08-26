@extends('layouts.app')
@inject('categories','App\Models\Category')
    @section('page_title')
    Posts
    @endsection
    @section('additional_styles')
    <link rel="stylesheet"
        href="{{ asset('adminlte/plugins/css/dataTables.bootstrap4.min.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('adminlte/plugins/css/responsive.bootstrap4.min.css') }}" />
    @endsection
    @section('additional_scripts')
    <script src="{{ asset('adminlte/plugins/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/js/responsive.bootstrap4.min.js') }}"></script>
    <script>
        $(function () {
            $("#table").DataTable({
                responsive: true,
                autoWidth: false,
                paging: false,
                searching: false,
                info: false,
            });
        });
    </script>
    @endsection
    @section('content')
    <!-- Content Header (Page header) -->


    <!-- Main content -->
    <section class="content">
        @include('partials.validation-errors')
        @include('flash::message')
        <div class="row justify-content-end mr-4 mb-3" id="filter-tools">

            <form class="form-inline ml-3" id="filter" action="{{ route('post.index') }}">
                <div class="input-group input-group-sm mr-2">
                    <input class="form-control form-control-navbar" type="search" name="search" value=""
                        style="background-color: #fff;" placeholder="Search" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-navbar"
                            style="background-color: #fff; border:1px solid #CED4DA; border-left:0; color:rgba(0,0,0,.6)"
                            type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
                <select class="form-control custom-select" onchange="document.getElementById('filter').submit();"
                    name="category" id="category">
                    <option selected="" disabled="">Select Category</option>
                    @foreach($categories->all() as $category)
                        <option value={{ $category->id }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </form>

            <a href="{{ route('post.create') }}" class="btn btn-primary ml-2"><i
                    class="fas fa-plus"></i> Add Post</a>
        </div>
        <!-- Default box -->
        @forelse($records as $post)
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <!-- Box Comment -->
                    <div class="card card-widget">
                        <div class="card-header">
                            <div class="user-block">
                                <span class="username">{{ $post->title }}</span>
                                <span class="description">{{ $post->created_at }}</span>
                            </div>
                            <div class="card-tools">
                                <a href="{{ route('post.edit',['post'=>$post->id]) }}"
                                    class="btn btn-tool">
                                    <i class="far fa-edit"></i></a>
                                <a href="{{ route('post.destroy',['post'=>$post->id]) }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('{{ 'delete'.$post->id }}').submit();"
                                    class="btn btn-tool"><i class="fas fa-trash"></i></a>
                                <form id="{{ 'delete'.$post->id }}"
                                    action="{{ route('post.destroy',['post'=>$post->id]) }}"
                                    method="POST" style="display: none;">
                                    @method('delete')
                                    @csrf
                                </form>
                            </div>
                            <!-- /.user-block -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body" style="display: block;">
                            <img class="img-fluid pad mb-4" src="{{ asset($post->photo) }}" alt="Photo">

                            <p>{{ $post->content }}</p>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        @empty
            <div class="card">
                <div class="card-header">
                    <h3>Posts</h3>
                </div>
                <div class="card-body">No Data</div>
            </div>
        @endforelse
        <!-- /.card -->
        @if(count($records))
            <div class="row justify-content-center">

                {{ $records->links() }}
            </div>
        @endif
    </section>
    <!-- /.content -->
    @endsection