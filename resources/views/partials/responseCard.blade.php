<div class="response text-green-900 md:w-1/2 lg:w-1/3 mb-12 px-8 xl:px-10 transition" style="opacity: 0; transform: translateY(.5rem); transition-delay: {{$delay ?? 40}}ms">
    @unless(empty($response->prompt))
        <div class="flex justify-center mb-3">
            <h3 class="bg-white p-3 font-display text-base uppercase font-semibold leading-none">{{$response->prompt}}</h3>
        </div>
    @endunless
    
    <h1 class="font-display font-light text-xl xl:text-3xl leading-normal">{{$response->content}}</h1>
    <span class="uppercase font-bold mt-5 inline-block leading-normal">{{$response->name}}<br /> {{$response->city ?? ''}}</span>
</div>