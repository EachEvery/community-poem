@extends('peacePoem')
@section('title', 'Home')
@section('page')


<!-- Hero, Green BG -->
<div class="bg-green-100 text-green-900 p-8 pt-24">

    <div class="max-w-lg mx-auto">


        <!-- Logos & Attribution -->
        <div class="flex flex-row-reverse mb-5">
            @component('attribution')            
            @endcomponent
        </div>

        <!-- Heading -->
        <div class="text-green-900 px-4 leading-tight flex flex-col">
            <span class="font-display text-6xl uppercase ">Global</span>
            <span class="font-display text-6xl uppercase   |  self-end    ">Peace</span>
            <span class="font-cursive text-center self-end leading-normal my-3 w-32 text-xs">Contribute a line or stanza to a global peace poem</span>
            <span class="font-display text-6xl uppercase   |  ml-2">Poem</span>
        </div>


    </div>

    <scrolly-globe class="w-full -mb-50vw mt-16 scale-up"></scrolly-globe>
</div>



<!-- Section, Yellow BG -->
<div class="bg-yellow-900 p-8 pt-32 pb-48 text-green-900">

    <span class="font-display text-9xl text-center uppercase text-outline leading-none">
        &ldquo;My<br />Voice&rdquo;
    </span>


    <div class="bg-white  p-10 -mt-10 relative pt-16 pb-32   |  ">
        <span class="text-lg uppercase text-3xl text-center block mb-3 font-display  |  ">What is it?</span>
        <p class="text-2xl mt-8 text-center leading-normal font-light">
            A global community poem in commemoration of the 50th anniversary of Kent State University’s May 4 shootings.
        </p>
    </div>



    <div class="flex flex-col mt-3">        
        <span class="whitespace-pre-line font-cursive lowercase leading-loose self-end text-lg">
        My Voice Is
        I Want
        My Voice stands for
        Give & Take
        Repetition
        My Voice
        </span>

        <img src="/img/globe-triangle@2x.png" class="w-1/2 -mt-12" />
    </div>

    <div class="mt-16">
        <h5 class="font-display font-bold leading-tight text-lg uppercase text-3xl mb-5">contribute a<br />
        line or stanza</h5>

        <p class="text-base leading">The Wick Poetry Center invites people from around the world to contribute a line or stanza to a global community peace poem titled “My Voice.” As Kent State University approaches the 50th anniversary of the May 4 shootings, the themes of the poem will reflect peace, conflict transformation, and advocacy. </p>
    </div>


    <div class="flex flex-col mt-32">

        <img src="/img/globe-square@2x.png" class="w-24 self-center -ml-5" />

        <div class="flex justify-between ">

            <span class="whitespace-pre-line font-cursive lowercase leading-loose self-end text-ms">
            My voice is a two-
            belled trumpet in 
            harmony for peace
            </span>

            <img src="/img/globe-sphere@2x.png" class="w-24 h-24" />
        </div>

    </div>

    <div class="mt-16">
        <h5 class="font-display font-bold leading-tight text-lg uppercase text-3xl mb-3">no experience<br />
            required</h5>

        <p class="text-base leading">The resulting poem will be built line-by-line from the personal experiences, thoughts, and expressions of a global community of writers. You don’t need to have any previous writing experience to participate. Simply select one or more of the prompts below to share your voice.</p>
    </div>

    <div class="relative  mt-24" style="height: 30rem">
        <img class="inset-0 absolute w-full h-full object-cover" src="/img/globe-card@2x.png"  style="transform: translate(-1rem, 1rem)" />

        <div class="bg-white inset-0 absolute w-full h-full text-green p-4 pt-16 px-8 flex flex-col">
           <span class="font-display text-5xl  uppercase text-center  text-outline leading-none text-center block">
                Respond
            </span>
            
            <p class="text-xl mt-8 text-center leading-normal">The Wick Poetry Center invites people from around the world to contribute a line or stanza to a global community peace poem titled “My Voice.”</p>

            <a href="#" class="font-display text-lg border-2 border-green-900 px-10 py-3 uppercase font-bold self-center mt-10">RESPOND</a>
        </div>
    </div>
</div>


@endsection