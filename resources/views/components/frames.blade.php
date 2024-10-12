<!-- resources/views/components/frames.blade.php -->
<div class="frame-container d-none d-md-block">
    @for ($i = 0; $i <= 143; $i++)
        <img src="{{ asset('frames/fotograma_' . str_pad($i, 5, '0', STR_PAD_LEFT) . '.png') }}" alt="Fotograma {{ $i }}" class="frame">
    @endfor
</div>
