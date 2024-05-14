@extends('layouts.app')

@section('title', 'Penjualan E-Books')

@section('contents')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div>
                <h3 class="text-center my-4">DATA PENJUALAN E-BOOKS</h3>
                <hr>
            </div>
            <div class="card border-0 shadow-sm rounded">
                <div class="card-body">
                    <form id="searchForm" action="{{ route('ebooks.search') }}" method="GET">
                        <input type="text" name="search" id="search" placeholder="Search by title or category">
                        <button type="submit">Search</button>
                    </form>

                    <!-- Konten hasil pencarian -->
                    <div id="searchResults">
                        <!-- Hasil pencarian akan dimuat di sini menggunakan AJAX -->
                    </div>
                </div>
            </div>
            <a href="{{ route('ebooks.create') }}" class="btn btn-md btn-success mb-3">ADD E-BOOK</a>
            @if(Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('success') }}
            </div>
            @endif
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">IMAGE</th>
                        <th scope="col">TITLE</th>
                        <th scope="col">DESCRIPTION</th>
                        <th scope="col">AUTHOR</th>
                        <th scope="col">CATEGORY</th>
                        <th scope="col">PRICE</th>
                        <th scope="col">PUBLISHED</th>
                        <th scope="col" style="width: 20%">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($ebooks as $ebook)
                    <tr>
                        <td class="text-center">
                            <img src="{{ asset('/storage/ebooks/'.$ebook->image) }}" class="rounded" style="width: 140px">
                        </td>
                        <td>{{ $ebook->title }}</td>
                        <td>{{ $ebook->description }}</td>
                        <td>{{ $ebook->author }}</td>
                        <td>{{ $ebook->category }}</td>
                        <td>Rp {{ number_format($ebook->price, 0, ',', '.') }}</td>
                        <td>{{ $ebook->published ? 'Yes' : 'No' }}</td>
                        <td class="text-center">
                            <form onsubmit="return confirm('Are you sure?');" action="{{ route('ebooks.destroy', $ebook->id) }}" method="POST">
                                <a href="{{ route('ebooks.show', $ebook->id) }}" class="btn btn-sm btn-dark">SHOW</a>
                                <a href="{{ route('ebooks.edit', $ebook->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">DELETE</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center">No data available.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $ebooks->links() }}
        </div>
    </div>
</div>
</div>
@endsection

<!-- jQuery AJAX Script -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#searchForm').submit(function(event) {
            event.preventDefault();
            var formData = $(this).serialize();

            $.ajax({
                url: "{{ route('ebooks.search') }}",
                type: "GET",
                data: formData,
                success: function(response) {
                    $('#searchResults').html(response);
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        });
    });
</script>
