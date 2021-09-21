<?php

namespace App\Http\Controllers;

use App\Models\Classified;
use Illuminate\Http\Request;
use App\Models\UserMembreship;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\UserMembreshipResource;


class RamaBinariaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        // $userMembreships =  Classified::where('id_user_sponsor', )->with('userMembreship')->get();

        // return  $userMembreships;   
        $left = [ ];
        $right = [ ]; 
        $Ramaleft = [ ];
        $Ramaright = [ ]; 
        $userclassifieds = [];
        $userMembreships = Classified::where($id)->get();
        //Voy a buscar los usuarios que tienen registros en las dos ramas ya que esa es la condicion si estan calificados

        foreach ($userMembreships as $item) {
            $left  = Classified::where('id_user_sponsor', $item->id_user_membreship)->where('status_position_left', 1)->distinct()->get();
            $rigth  = Classified::where('id_user_sponsor', $item->id_user_membreship)->where('status_position_right', 1)->distinct()->get();
             if ($rigth->isNotEmpty() && $left->isNotEmpty()) {
                 $userclassifieds[] = $item;
             }
        }

        // Verificiar si los usuarios calificados estan activos y agrupar las ramas en un array
        foreach ($userclassifieds as $item) {
            if ($item->userMembreship->active == true) {
                if ($item->status_position_left == 1) {
                    $Ramaleft[] = $item->userMembreship->fullName;
                }
                if ($item->status_position_right == 1) {
                    $Ramaright[] = $item->userMembreship->fullName;
                }
            }
        }
        $userValidates = ['user'=> ['name'=>auth()->user()->fullName], 'lef'=>$Ramaleft, 'rigth'=>$Ramaright];
        return response()->json($userValidates);
    }

    public function viewTree()
    {
        $currentUser =  UserMembreship::where('id', auth()->user()->id)->select('id', 'name', 'last_name', 'expiration_date')->get();

        $tmpUsers = UserMembreship::where('id_referrer_sponsor', auth()->user()->id)->select('id', 'id_referrer_sponsor AS pid', 'name', 'last_name', 'expiration_date')->get();

        $hijos=[];
        foreach ($tmpUsers as $item) {
            $tmUser =  UserMembreship::where('id_referrer_sponsor', $item->id)->select('id', 'id_referrer_sponsor AS pid', 'name', 'last_name', 'expiration_date')->get();
            if ($tmUser->isNotEmpty()) {
                $hijos = $tmUser;
            }
        }

        $nivel1 = $tmpUsers->merge($currentUser);
        $users = $nivel1->merge($hijos);
        return response()->json(['data'=>$users]);
    }
}
