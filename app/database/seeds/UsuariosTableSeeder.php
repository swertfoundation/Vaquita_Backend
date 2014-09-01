<?php

use Faker\Factory as Faker;
use vaquitapp\Entities\Usuario;

class UsuariosTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		Usuario::create([
			'username' => 'devswert',
			'password' => Hash::make('grumpycat'),
			'email' => 'leo.david.mm@gmail.com',
			'nombre' => 'Leonardo David',
			'banco' => 'Banco Estado',
			'tipo_cuenta' => 'CuentaRut',
			'numero_cuenta' => '18905437',
			'estado' => 1
		]);

		foreach(range(1, 10) as $index)
		{
			Usuario::create([
				'username' => $faker->firstName,
				'password' => Hash::make($faker->name),
				'email' => $faker->email,
				'nombre' => $faker->lastname,
				'estado' => 1
			]);
		}
	}

}