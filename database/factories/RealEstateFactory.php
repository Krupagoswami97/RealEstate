<?php

namespace Database\Factories;

use App\Models\RealEstate;
use Illuminate\Database\Eloquent\Factories\Factory;

class RealEstateFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RealEstate::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        /*------ Note: Here validation for ISO 3066 Alpha2 Country ----*/
        $randomCOUNTRY = $this->faker->countryCode();
        if(!preg_match('/^(A(D|E|F|G|I|L|M|N|O|R|S|T|Q|U|W|X|Z)|B(A|B|D|E|F|G|H|I|J|L|M|N|O|R|S|T|V|W|Y|Z)|C(A|C|D|F|G|H|I|K|L|M|N|O|R|U|V|X|Y|Z)|D(E|J|K|M|O|Z)|E(C|E|G|H|R|S|T)|F(I|J|K|M|O|R)|G(A|B|D|E|F|G|H|I|L|M|N|P|Q|R|S|T|U|W|Y)|H(K|M|N|R|T|U)|I(D|E|Q|L|M|N|O|R|S|T)|J(E|M|O|P)|K(E|G|H|I|M|N|P|R|W|Y|Z)|L(A|B|C|I|K|R|S|T|U|V|Y)|M(A|C|D|E|F|G|H|K|L|M|N|O|Q|P|R|S|T|U|V|W|X|Y|Z)|N(A|C|E|F|G|I|L|O|P|R|U|Z)|OM|P(A|E|F|G|H|K|L|M|N|R|S|T|W|Y)|QA|R(E|O|S|U|W)|S(A|B|C|D|E|G|H|I|J|K|L|M|N|O|R|T|V|Y|Z)|T(C|D|F|G|H|J|K|L|M|N|O|R|T|V|W|Z)|U(A|G|M|S|Y|Z)|V(A|C|E|G|I|N|U)|W(F|S)|Y(E|T)|Z(A|M|W))$/m',$randomCOUNTRY)){
            $randomCOUNTRY = "";
        }
        return [
            'name' => $this->faker->word(),
            'street' => $this->faker->word(),
            'real_estate_type' => $this->faker->randomElement(['House','Land','Department','Commercial Ground', $count = 1]),
            'external_number' => $this->faker->regexify('^[a-zA-Z0-9-]+$'),
            'internal_number' => $this->faker->regexify('^[a-zA-Z0-9- ]*$'),
            'neighborhood' => $this->faker->word(),
            'city' => $this->faker->word(),
            'country' => $randomCOUNTRY,
            'rooms' => $this->faker->numberBetween(1,10),
            'bathrooms' => $this->faker->numberBetween(1,10),
            'comments' => $this->faker->word(),
        ];
    }
}
