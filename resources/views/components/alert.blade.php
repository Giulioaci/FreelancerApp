@if (session('status'))
    <div class="mb-4 rounded-xl bg-green-100 p-4 text-green-700">
        {{ session('status') }}
    </div>
@endif
