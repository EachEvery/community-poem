@extends('peacePoem')
@section('title', 'About')
@section('page')
<div class="bg-blue-100 text-green-900 p-8 pt-32 lg:px-32 xl:px-48">
    <div class="container md:mx-auto lg:flex justify-between" style="max-width: 65rem">
        <div class="md:max-w-sm lg:mr-10 xl:mr-0">
            <h1 class="font-display md:text-6xl text-3xl  uppercase leading-tight mb-5 ">Peace Poems<br />Contest</h1>

            <p class="xl:text-lg">The Wick Poetry Center is now accepting poetry submissions as part of the commemoration of the 50th anniversary of the May 4 shootings. The poems should resonate with the themes of peace, conflict transformation, and student advocacy. Visit the contest submission page for full guidelines.</p>

            <a href="#" class="inline-block font-display bg-white text-lg border-2 border-green-900 px-8 py-3 uppercase font-bold mt-10" open-typeform>Respond</a>
        </div>

        <div class="max-w-md md:mb-24 mt-24 lg:mt-0">
            <div class="mt-32 md:mt-0">
                <h3 class="text-lg uppercase text-3xl md:text-6xl block font-display font-bold">Categories</h3>
                <h3 class="text-lg uppercase text-3xl md:text-6xl block mt-3 font-display font-bold text-outline-thin">Youth</h3>
                <h3 class="text-lg uppercase text-3xl md:text-6xl block mt-1 font-display font-bold text-outline-thin">Adult Student</h3>
                <h3 class="text-lg uppercase text-3xl md:text-6xl block mt-1 font-display font-bold text-outline-thin">Non-Student</h3>
            </div>

            <div class="mt-12">
                <div class="flex justify-between mb-10">
                    <h1 class="text-lg uppercase text-3xl md:text-5xl block font-display font-bold self-end leading-tight">NAOMI<br />
                    SHIHAB NYE</h1>

                    <img src="/img/naomi@2x.png" alt="Naomi Shihab Nye" class="rounded-full w-32 h-32 border-4 border-green-900 xl:-mr-24 lg:w-48 lg:h-48" />
                </div>

                <p class="xl:text-lg">Poet, songwriter, and novelist, Naomi Shihab Nye, will will select one winner from each category who will receive $500 and an all-expenses-paid trip to Kent State University to read their poems during the May 4 Music and Poetry Event on April 21. 
                    <br /><br />
                    Two poets will receive honorable mention prizes for $250 and an all-expenses-paid trip to Kent State to read their poems during the April 21 event. All winners will have their poems set to a musical composition by students in the Kent State University School of Music.</p>        
            </div>
        </div>
    </div>
</div>
@endsection