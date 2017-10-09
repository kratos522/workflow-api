<?php

use Illuminate\Database\Seeder;

class PersonasNaturaslesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\PersonaNatural::class, 20)->create()->each(function ($pn) {
          $persona = new App\Persona;
          $persona->numero_documento_identidat = str_random(10);
          $pn->persona()->save($persona);
        });
    }
}
