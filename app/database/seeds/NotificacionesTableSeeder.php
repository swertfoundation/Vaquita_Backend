<?php

use vaquitapp\Entities\Notificaciones;

class NotificacionesTableSeeder extends Seeder {

	public function run()
	{
		Notificaciones::create([
			'nombre' => 'Vaca Flacas',
			'icono'  => 'icon-flaca',
			'estado'  => 1
		]);
	}

}