<div id="print-{{ $response->id }}" class="response-print fixed text-black p-4" style="width: 475px; top: 0; z-index: -9999999;">
    <div class="p-4 xl:px-6">
        @unless(empty($response->prompt))
            <div class="flex flex-col justify-center items-center">
                <h3 class="response-prompt block bg-black text-white px-3 pb-3 font-display text-base uppercase font-semibold leading-none">{{$response->prompt}}</h3>
            </div>
        @endunless
        
        <h1 class="response-content font-display font-light text-xl xl:text-3xl leading-normal">{{$response->content}}</h1>
        <div class="uppercase font-bold mt-5 inline-block leading-normal"><span class="response-name">{{$response->name}}</span><br /> <span class="response-city">{{$response->city ?? ''}}</span></div>
    </div>
    {{-- <div class="mx-auto w-1/4 px-4 flex justify-center items-center mt-8 mb-4">
        <img
            src="https://api.qrserver.com/v1/create-qr-code/?data={{ $response->getUrl() }}&amp;size=100x100"
            alt=""
            title=""
        />
    </div> --}}
    <p class="mx-auto w-full text-center text-sm px-4 mb-8 text-black font-mono">
        @if($response->space->print_footer)
        {!! nl2br($response->space->print_footer) !!}
        @else
        {{ $response->space->name }}
        <br />
        Traveling Stanzas | www.travelingstanzas.com
        @endif
    </p>
</div>