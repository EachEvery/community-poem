<div id="{{ $response->id }}" class="response cursor-pointer text-primary w-full md:w-1/2 lg:w-1/3 {{$isHighlighted ? 'highlight' : 'transition'}} md:p-4 mb-8" style="opacity: 0; transform: translateY(.5rem); transition-delay: {{$delay ?? 40}}ms">
    <div class="content border-2 border-transparent p-4 xl:px-6 hover:border-primary">
        @unless(empty($response->prompt))
            <div class="flex justify-center mb-3">
                <h3 class="response-prompt bg-white p-3 font-display text-base uppercase font-semibold leading-none">{{$response->prompt}}</h3>
            </div>
        @endunless
        
        <h1 class="response-content content-text font-display font-light text-xl xl:text-3xl leading-normal">{{$response->content}}</h1>
        <div class="uppercase font-bold mt-5 inline-block leading-normal"><span class="response-name">{{$response->name}}</span><br /> <span class="response-city">{{$response->city ?? ''}}</span></div>
        <div class="language-switcher opacity-0 center">
            <div class="inner relative inline-block">
                <div class="text flex items-center bg-primary p-1 text-white rounded-full uppercase text-xs font-bold">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                    </svg>
                    <span class="block mx-1" style="font-size:0.5rem;">Language</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-2 w-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
                <select class="h-full w-full absolute opacity-0" style="left:0;top:0;">
                    @php
                        $languages = [
                            [
                                'label' => 'Original',
                                'value' => 'original'
                            ],
                            [
                                'label' => 'English',
                                'value' => 'en'
                            ],
                            [
                                'label' => 'Russian',
                                'value' => 'ru'
                            ],
                            [
                                'label' => 'Ukrainian',
                                'value' => 'uk'
                            ]
                        ];
                    @endphp
                    @foreach ($languages as $language)
                        <option value="{{ $language['value'] }}">{{ $language['label'] }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="controls hidden w-12 h-10 absolute" style="transform: rotate(-45deg)">
        
        <button class="close bg-primary text-secondary rounded-full overflow-hidden w-12 h-12 p-4 absolute cursor-pointer uppercase text-sm" style="top: 50%; left: -100%; transform: translate(0, -50%);">
            <svg class ="w-full" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M16.7067 0.706885C16.3161 0.316471 15.683 0.316564 15.2925 0.707094L9.70756 6.29309C9.31706 6.68367 8.68386 6.68371 8.29331 6.29319L2.70672 0.707066C2.31619 0.316562 1.68303 0.316584 1.29252 0.707113L0.707005 1.29266C0.316523 1.68316 0.316502 2.31626 0.706958 2.70679L6.29294 8.2938C6.68341 8.68435 6.68337 9.31749 6.29284 9.70798L0.707147 15.2932C0.316602 15.6837 0.316582 16.3169 0.7071 16.7074L1.29252 17.2929C1.68303 17.6834 2.31619 17.6834 2.70672 17.2929L8.29331 11.7068C8.68386 11.3163 9.31706 11.3163 9.70756 11.7069L15.2925 17.2929C15.683 17.6834 16.3161 17.6835 16.7067 17.2931L17.2925 16.7075C17.6832 16.317 17.6832 15.6836 17.2926 15.293L11.7064 9.70803C11.3158 9.31752 11.3157 8.68431 11.7063 8.29376L17.2928 2.70695C17.6833 2.31637 17.6833 1.68311 17.2926 1.29261L16.7067 0.706885Z" fill="currentColor"/>
            </svg>               
        </button>
        
        <button class="copy bg-primary text-secondary rounded-full overflow-hidden w-12 h-12 p-2 absolute cursor-pointer uppercase text-sm" style="top: 50%; left: 100%; transform: translate(0, -50%);">
            <svg class="success-icon w-full" x="0px" y="0px" viewBox="0 0 100 100"><g transform="translate(0,-952.36218)"><path style="text-indent:0;text-transform:none;direction:ltr;block-progression:tb;baseline-shift:baseline;enable-background:accumulate;" d="m 80.878285,977.33819 a 5.0005,5.0005 0 0 0 -3.4374,1.5 l -36.9063,36.90631 -18.5,-14.3126 a 5.0006103,5.0006103 0 1 0 -6.125,7.9063 l 22,17 a 5.0005,5.0005 0 0 0 6.5937,-0.4062 l 40,-40.00006 a 5.0005,5.0005 0 0 0 -3.625,-8.59375 z" fill="currentColor" fill-opacity="1" stroke="none" marker="none" visibility="visible" display="inline" overflow="visible"></path></g></svg>
            <svg class="primary-icon w-full" xmlns="http://www.w3.org/2000/svg" version="1.1" x="0px" y="0px" viewBox="0 0 32 32" style="enable-background:new 0 0 32 32;" xml:space="preserve"><path fill="currentColor" d="M24.5,12.5H13c-0.6,0-1,0.4-1,1v13.9c0,0.6,0.4,1,1,1h11.5c0.6,0,1-0.4,1-1V13.5C25.5,12.9,25.1,12.5,24.5,12.5z"></path><path fill="currentColor" d="M20,10.1h-8.5c-1,0-1.8,0.8-1.8,1.8v7.6H7.5c-0.6,0-1-0.5-1-1V4.6c0-0.6,0.4-1,1-1H19c0.5,0,1,0.4,1,1V10.1z"></path></svg>
        </button>
        
        <button data-share-link="{{ $response->getUrl() }}" class="share bg-primary text-secondary rounded-full overflow-hidden w-12 h-12 absolute cursor-pointer uppercase text-sm" style="top: -100%; left: 50%; transform: translate(-50%, 0);">
            <svg class="success-icon p-2 w-full" x="0px" y="0px" viewBox="0 0 100 100"><g transform="translate(0,-952.36218)"><path style="text-indent:0;text-transform:none;direction:ltr;block-progression:tb;baseline-shift:baseline;enable-background:accumulate;" d="m 80.878285,977.33819 a 5.0005,5.0005 0 0 0 -3.4374,1.5 l -36.9063,36.90631 -18.5,-14.3126 a 5.0006103,5.0006103 0 1 0 -6.125,7.9063 l 22,17 a 5.0005,5.0005 0 0 0 6.5937,-0.4062 l 40,-40.00006 a 5.0005,5.0005 0 0 0 -3.625,-8.59375 z" fill="currentColor" fill-opacity="1" stroke="none" marker="none" visibility="visible" display="inline" overflow="visible"></path></g></svg>
            <svg class="primary-icon w-full p-4" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M14.627 14.3772C14.627 14.5152 14.5151 14.6271 14.377 14.6271H2.8727C2.73463 14.6271 2.6227 14.5152 2.6227 14.3771V2.87283C2.6227 2.73475 2.73463 2.62283 2.8727 2.62283H4.88524C5.02331 2.62283 5.13524 2.5109 5.13524 2.37283V0.499878C5.13524 0.361807 5.02331 0.249878 4.88524 0.249878H0.499756C0.361685 0.249878 0.249756 0.361807 0.249756 0.499878V16.7501C0.249756 16.8882 0.361685 17.0001 0.499756 17.0001H16.75C16.888 17.0001 17 16.8882 17 16.7501V12.3646C17 12.2265 16.888 12.1146 16.75 12.1146H14.877C14.739 12.1146 14.627 12.2265 14.627 12.3646V14.3772Z" fill="currentColor"/>
                <path d="M7.479 0.249865C7.34093 0.249866 7.229 0.361795 7.229 0.499865V2.37282C7.229 2.51089 7.34093 2.62282 7.479 2.62282H12.2785C12.5013 2.62282 12.6128 2.8921 12.4553 3.04959L8.52246 6.98244C8.42483 7.08008 8.42483 7.23837 8.52246 7.336L9.91372 8.72726C10.0114 8.82489 10.1696 8.82489 10.2673 8.72726L14.2001 4.79441C14.3576 4.63691 14.6269 4.74846 14.6269 4.97118V9.77072C14.6269 9.90879 14.7388 10.0207 14.8769 10.0207H16.7499C16.8879 10.0207 16.9999 9.90879 16.9999 9.77072V0.499759C16.9999 0.361686 16.8879 0.249757 16.7498 0.249759L7.479 0.249865Z" fill="currentColor"/>
            </svg>
        </button>

        @if ($space->allow_printing)
            <button class="print bg-primary text-secondary rounded-full overflow-hidden w-12 h-12 p-3 absolute cursor-pointer uppercase text-sm" style="top: 100%; left: 50%; transform: translate(-50%, 0%);">
                <svg class="loading-icon animate-spin h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <svg class="primary-icon w-full" viewBox="0 0 21 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M19.2502 0.43722C19.2502 0.195237 18.9491 0 18.5767 0H2.4231C2.05151 0 1.74963 0.196054 1.74963 0.43722V1.74972H19.2502V0.43722Z" fill="currentColor"/>
                    <path d="M20.1247 2.625H0.87528C0.392112 2.62664 0.001638 3.01711 0 3.50028V10.4828C0.00164062 10.9651 0.392112 11.3564 0.87528 11.3572H3.50028V6.99554H17.4997V11.3572H20.1247C20.6079 11.3564 20.9984 10.9651 21 10.4828V3.50028C20.9984 3.01711 20.6079 2.62664 20.1247 2.625ZM13.5622 5.68722C13.2087 5.68722 12.8896 5.47394 12.7542 5.14746C12.6189 4.82015 12.6935 4.44362 12.9437 4.19343C13.1939 3.94323 13.5704 3.86858 13.8977 4.00394C14.2242 4.13929 14.4375 4.4584 14.4375 4.81277C14.4358 5.29512 14.0454 5.68641 13.5622 5.68723L13.5622 5.68722ZM16.6244 5.68722H16.6253C16.2709 5.68722 15.9518 5.47394 15.8164 5.14746C15.6811 4.82015 15.7557 4.44362 16.0059 4.19343C16.2561 3.94323 16.6326 3.86858 16.9599 4.00394C17.2864 4.13929 17.4997 4.4584 17.4997 4.81277C17.4989 5.29512 17.1076 5.68641 16.6252 5.68723L16.6244 5.68722Z" fill="currentColor"/>
                    <path d="M4.37468 11.3573V17.9378C4.3755 18.179 4.57073 18.3742 4.81271 18.375H16.1872C16.4291 18.3742 16.6244 18.179 16.6252 17.9378V7.87085H4.37463L4.37468 11.3573ZM14.8747 15.3128H6.12524C5.88325 15.3128 5.6872 15.1168 5.6872 14.8748C5.6872 14.6336 5.88325 14.4376 6.12524 14.4376H14.8747C15.1167 14.4376 15.3127 14.6336 15.3127 14.8748C15.3127 15.1168 15.1167 15.3128 14.8747 15.3128ZM14.8747 12.6878H6.12524C5.88325 12.6878 5.6872 12.4918 5.6872 12.2498C5.6872 12.0086 5.88325 11.8126 6.12524 11.8126H14.8747C15.1167 11.8126 15.3127 12.0086 15.3127 12.2498C15.3127 12.4918 15.1167 12.6878 14.8747 12.6878Z" fill="currentColor"/>
                </svg>    
            </button>
        @endif

    </div>
</div>