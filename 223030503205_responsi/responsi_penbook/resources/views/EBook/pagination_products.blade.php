@foreach ($ebooks as $ebook)
    <div>{{ $ebook->title }}</div>
    <!-- Add other fields as needed -->
@endforeach
{{ $ebooks->links() }}
