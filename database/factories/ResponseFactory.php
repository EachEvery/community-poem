<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use CommunityPoem\Response;
use Faker\Generator as Faker;

$responses = collect([
    'the Kuskokwim knows 
    silt and salmon and bison and smoke and fire 
    children running on top before ice melts 
    
    near Toy\'draya\' (Egypt Mountain) it knows braiding and twisting and gravel 
    running fast and splashing, tripping over logjams
    defying humans
    
    deepening, maturing, it knows meander 
    long slow winding 
    swallowing
    
    stuffed bunny left behind on sandy bank
    hat that blew away 
    countless pieces of abc gum
    bodies, through thin ice
    tears 
    
    it knows boats and films of 2-cycle oil,
    and barges hauling diesel
    planes flying overhead on foggy days
    miners exploring, drilling, soil and water
    mixing layers
    
    it knows 
    slow spread to delta
    merge with land and ocean and sky 
    it knows its gifts, 
    welcoming birds each spring
    ending hunger.
    Fishnets, happy families cutting fish',

    'The Colorado River doesn\'t know it will run dry
    Before it reaches the coast.
    It knows the rapids, created by the snowmelt 
    In the Spring. 
    It knows the crash of a raft 
    And the fish that swim 
    Below the white foam.
    It hears the whisper of aspen, in the Fall
    Then the crust of ice come Winter, though still it flows.',

    'The river remembers free
    motion under visible stars.
    It murmurs, not to agree to walls
    we impose, but to protest.
    Thwarted red salmon straining
    homeward sigh into this momentum,
    river the warbling clef
    of its song orcas turn ears towards,
    none of us wanting to die.',

    'The River knows how long it takes 
    From sky to mountain
    From mountain to sea
    And back into the sky again
    The River knows it is many parts
    Too small for the eye to see
    And yet each atom of oxygen
    Each atom of hydrogen
    Though able to stand alone
    Are now part of the River\'s whole
    The River knows that places are fleeting
    And moments are too
    That is why the River never dwells
    On what it is now
    Or what it left behind',

    'Aches for expansion
    Finding home
    In the tides
    The river knows how long it takes
    From mountain to sea
    The river knows that places are fleeting
    And moments are too
    That is why the river
    Never dwells on what it left behind',

    'The river knows odd harmony.
    How to float a stone. The patience
    It takes to peel apart trunks
    Thrown into it by wind or men
    Or the restless earth. The river
    is not restless though. The river
    Smooths even when it roars.',

    'the San Diego River knows
    The kiss of a crow\'s wings
    The foamy bubbles of detergent
    The meal of a ground acorn
    
    In an intercourse with the Pacific
    It knows
    When surf\'s up',

    'The river knows it’s source
    From whence it begins and ends
    It’s space and place and inflowing
    The non linear depth, width 
    Unending, ever changing
    Life giving',

    'The consumption of space makes
    breathing near impossible. Water
    wants what it wants. A pledge to
    sate desire, deserved.',

    'THe river knows majesty and majesty deposed; 
    The river knows how to shapeshift - trickle
    down then swell into the salty embrace of the sea.',
]);

$factory->define(Response::class, function (Faker $faker) use ($responses) {
    return [
        'name' => $faker->name,
        'city' => sprintf('%s, %s', $faker->city, $faker->state),
        'typeform_id' => str_random(10),
        'content' => $responses->random(),
        'email' => $faker->email,
    ];
});
