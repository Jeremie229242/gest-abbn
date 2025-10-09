<?php
use Illuminate\Support\Str;









if (!function_exists('isActiveRoute')) {
    /**
     * Vérifie si la route courante appartient à un groupe (ex: "Admin.materiels")
     *
     * @param string|array $patterns Nom(s) de routes ou préfixes
     * @param string $class Classe CSS à retourner si match
     * @return string
     */
    function isActiveRoute($patterns, $class = 'active')
    {
        if (is_array($patterns)) {
            foreach ($patterns as $pattern) {
                if (request()->routeIs($pattern . '*')) {
                    return $class;
                }
            }
            return '';
        }

        return request()->routeIs($patterns . '*') ? $class : '';
    }
}

function getRolesName(){
    $rolesName = "";
    $i = 0;
    foreach(auth()->user()->roles as $role){
        $rolesName .= $role->name;

        //
        if($i < sizeof(auth()->user()->roles) - 1 ){
            $rolesName .= ",";
        }

        $i++;

    }

    return $rolesName;

}
