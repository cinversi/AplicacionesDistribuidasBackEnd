<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Paise;
use App\Models\Persona;
use App\Models\Empleado;
use App\Models\Sectore;
use App\Models\Cliente;
use App\Models\Duenio;
use App\Models\Subastadore;
use App\Models\Subasta;
use App\Models\Producto;
use App\Models\Foto;
use App\Models\Catalogo;
use App\Models\ItemsCatalogo;
use App\Models\Asistente;
use App\Models\Pujo;
use App\Models\RegistroDeSubasta;

class SubastasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pais = new Paise();
        $pais->nombre = "Argentina";
        $pais->nombreCorto = "ARG";
        $pais->capital = "Buenos Aires";
        $pais->nacionalidad = "Argentina";
        $pais->idiomas = "Espaniol";
        $pais->save();

        $persona = new Persona();
        $persona->documento = "38392048";
        $persona->nombre = "Tomas";
        $persona->direccion = "Mitre 323";
        $persona->foto = "acaHayUnaFoto";
        $persona->save();

        $empleado = new Empleado();
        $empleado->cargo = "supervisor";
        $empleado->sector = "Clientes";
        $empleado->save();

        $sectore = new Sectore();
        $sectore->nombreSector = "Clientes";
        $sectore->codigoSector = "111";
        $sectore->responsableSector = 1;
        $sectore->save();

        $cliente = new Cliente();
        $cliente->categoria = "oro";
        $cliente->persona_id = 1;
        $cliente->empleado_id = 1;
        $cliente->numeroPais_id = 1;
        $cliente->save();

        $duenio = new Duenio();
        $duenio->numeroPais = "ARG";
        $duenio->verificaciónFinanciera = "si";
        $duenio->verificaciónJudicial = "si";
        $duenio->calificacionRiesgo = 1;
        $duenio->persona_id = 1;
        $duenio->verificador = 1;
        $duenio->save();

        $subastador = new Subastadore();
        $subastador->matricula = "3245432";
        $subastador->region = "Sur";
        $subastador->persona_id = 1;
        $subastador->save();

        $subasta = new Subasta();
        $subasta->ubicacion = "Alvear 239";
        $subasta->fecha = "2021-06-07";
        $subasta->horaInicio = "10:35";
        $subasta->horaFin = "18:25";
        $subasta->estado = "abierta";
        $subasta->capacidadAsistentes = 2;
        $subasta->tieneDeposito = "si";
        $subasta->seguridadPropia = "si";
        $subasta->categoria = "comun";
        $subasta->subastador_id = 1;
        $subasta->save();

        $producto = new Producto();
        $producto->fecha = "2021-06-07";
        $producto->disponible = "si";
        $producto->descripcionCatalogo = "esto es una descripcion";
        $producto->descripcionCompleta = "esto es una descripcion";
        $producto->revisor_id = 1;
        $producto->duenio_id = 1;
        $producto->save();

        $foto = new Foto();
        $foto->foto = "acaHayUnaFoto";
        $foto->producto_id = 1;
        $foto->save();

        $catalogo = new Catalogo();
        $catalogo->descripcion = "descripcion";
        $catalogo->responsable_id = 1;
        $catalogo->subasta_id = 1;
        $catalogo->save();

        $itemscatalogo = new ItemsCatalogo();
        $itemscatalogo->precioBase = 45;
        $itemscatalogo->comision = 3;
        $itemscatalogo->subastado = "si";
        $itemscatalogo->catalogo_id = 1;
        $itemscatalogo->producto_id = 1;
        $itemscatalogo->save();

        $asistente = new Asistente();
        $asistente->numeroPostor = 1;
        $asistente->cliente_id = 1;
        $asistente->subasta_id = 1;
        $asistente->save();

        $pujo = new Pujo();
        $pujo->asistente_id = 1;
        $pujo->item_id = 1;
        $pujo->save();

        $registrodesubasta = new RegistroDeSubasta();
        $registrodesubasta->importe = 5000;
        $registrodesubasta->comision = 10;
        $registrodesubasta->subasta_id = 1;
        $registrodesubasta->duenio_id = 1;
        $registrodesubasta->producto_id = 1;
        $registrodesubasta->cliente_id = 1;
        $registrodesubasta->save();

        // //\App\Models\User::factory()->count(5)->create(); 
        // //\App\Models\Persona::factory()->count(5)->create();
        // // \App\Models\Catalogo::factory()->count(5)->create(); 
        // // \App\Models\Cliente::factory()->count(5)->create(); 
        // // \App\Models\Subasta::factory()->count(5)->create(); 
        // // \App\Models\ItemsCatalogo::factory()->count(5)->create();
    }
}
