
<div class="p-4 shadow border-slate-300">
    @php
        $highlighter = new \Tempest\Highlight\Highlighter();
        $code = trim($highlighter->parse($slot, 'php'));
    @endphp
    {!! $code !!}
</div>
