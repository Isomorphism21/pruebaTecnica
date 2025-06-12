<?php
namespace App\Helpers;
class ContribuyenteHelper
{
    public static function generarNombreCompleto($nombres, $apellidos){
        return trim($nombres . ' ' . $apellidos);
    }

    public static function validarEmail($email){
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    public static function separarRazonSocial($razonSocial){
        $palabras = explode(' ', trim($razonSocial));

        if (count($palabras) >= 2) {
            $apellidos = implode(' ', array_slice($palabras, -2));
            $nombres = implode(' ', array_slice($palabras, 0, -2));
        } else {
            $nombres = $razonSocial;
            $apellidos = '';
        }

        return [
            'nombres' => $nombres,
            'apellidos' => $apellidos,
        ];
    }

    public static function contarLetrasRecursivo($texto, &$frecuencias = []) {
        if ($texto === '') {
            return $frecuencias;
        }

        $letra = $texto[0];

        if (isset($frecuencias[$letra])) {
            $frecuencias[$letra]++;
        } else {
            $frecuencias[$letra] = 1;
        }

        return self::contarLetrasRecursivo(substr($texto, 1), $frecuencias);
    }

}