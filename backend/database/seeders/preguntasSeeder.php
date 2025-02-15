<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pregunta;

class preguntasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        //Preguntas para la empresa
        Pregunta::create([
            'titulo' => 'El alumno ha mostrado buena disposición para el trabajo (atención, interés, puntualidad)',
            'tipo' => 'estrellas',
            'order' => '1'
        ]);
        

        Pregunta::create([
            'titulo' => 'El comportamiento con el resto de trabajadores ha sido correcto',
            'tipo' => 'estrellas',
            'order' => '1'
        ]);
        
        Pregunta::create([
            'titulo' => 'El alumno a llegado con habilidades técnicas para aprender a trabajar',
            'tipo' => 'estrellas',
            'order' => '1'
        ]);

        Pregunta::create([
            'titulo' => 'El alumno ha llegado con habilidades básicas (concentración, trabajo en grupo)',
            'tipo' => 'estrellas',
            'order' => '1'
        ]);

        Pregunta::create([
            'titulo' => 'Después de la FCT, la empresa tiene interés en contratar al alumno',
            'tipo' => 'estrellas',
            'order' => '1'
        ]);

        Pregunta::create([
            'titulo' => 'El periodo de las FCT es suficiente para conocer si el alumno encaja en la empresa',
            'tipo' => 'estrellas',
            'order' => '1'
        ]);

        Pregunta::create([
            'titulo' => 'Estaría dispuesto a colaborar nuevamente con el centro educativo',
            'tipo' => 'estrellas',
            'order' => '1'
        ]);

        Pregunta::create([
            'titulo' => 'La empresa está satisfecha con la relación con el tutor del centro educativo',
            'tipo' => 'estrellas',
            'order' => '1'
        ]);

        Pregunta::create([
            'titulo' => 'Que carencias formativas has encontrado en el alumno',
            'tipo' => 'textarea',
            'order' => '1'
        ]);

        Pregunta::create([
            'titulo' => 'Cuales son las mayores dificultades a la hora de realizar la fase de formación',
            'tipo' => 'textarea',
            'order' => '1'
        ]);

        Pregunta::create([
            'titulo' => 'Tienes otros propósitos de mejora relativas al funcionamiento de las prácticas',
            'tipo' => 'textarea',
            'order' => '1'
        ]);


        //Preguntas para los alumnos

        Pregunta::create([
            'titulo' => 'Experiencia general en la empresa',
            'tipo' => 'estrella',
            'order' => '2'
        ]);

        Pregunta::create([
            'titulo' => 'El instructor ha mostrado buena disposición',
            'tipo' => 'estrella',
            'order' => '2'
        ]);

        Pregunta::create([
            'titulo' => 'Has utilizado conocimientos del curso en la empresa',
            'tipo' => 'estrella',
            'order' => '2'
        ]);

        Pregunta::create([
            'titulo' => 'Has recibido un buen trato de la empresa',
            'tipo' => 'estrella',
            'order' => '2'
        ]);

        Pregunta::create([
            'titulo' => 'Recomendarías la empresa para otros alumnos',
            'tipo' => 'estrella',
            'order' => '2'
        ]);

        Pregunta::create([
            'titulo' => 'Que has aprendido en la empresa que te hubiera gustado haber aprendido durante el curso',
            'tipo' => 'textarea',
            'order' => '2'
        ]);

        Pregunta::create([
            'titulo' => 'Que problemas has tenido en la empresa',
            'tipo' => 'textarea',
            'order' => '2'
        ]);

        Pregunta::create([
            'titulo' => 'Opina sobre la empresa en la que has realizado las FCT',
            'tipo' => 'textarea',
            'order' => '2'
        ]);

    }
}
