<footer class="blog-footer">
    <p>
        {{-- Fly Up --}}
        <a href="#">Back to top</a>
    </p>
    {{-- Unique Visitors/Browsers Stat --}}
    @include('partial.visitors')
    {{-- Copyright --}}
    <p class="mt-4 mb-2">
        &copy; {{ date('Y') }}
        <a href="http://massmediagroup.pro" target="_blank" title="Open official website in the new window">
            {{config('app.marketing_name')}}
        </a>
    </p>
</footer>