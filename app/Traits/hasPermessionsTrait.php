<?php

namespace App\Traits;

use App\Models\permessions;
use App\Models\roles;

trait  HasPermessionsTrait
{

      // am functiona la regay rolewa cheakm bo aka  sayrka mn permessionakam la service providerkawa boy nardwa cheak akatawa 
      // ale agar agar rolekani user aw rolle tyabu ka la service providerawa hatwa awa truea wata rasta 
      // wata ama cheake permessionaklan akatawa bapee rolakay 
    public function hasPermessionThroughRole($permession)
    {
        foreach ($permession->roles as $role) {
            // sayrka ama  ale  $this->roles()  ama relation shipakaya wata lanaw hamu rolekani am  usera agar containe  aw role bu ka la gatekawa nardumana
            // awa true bda agena false bda    wata agar lanaw hamu rolekani am usera agar hatu aw role tyabu ka lanaw gatekawa narduma aa true ada
            if ($this->roles()->contain($role)) {
                return true;
            }
        }
        return false;
    }
    
      // ama la reagy permessionawa cheak akatawa wata  ama paiwande ba table permessionawa haya ale lanaw hamu permessionakani user where name yaksan be ba name 
    //   aw permessionay ka la gatewa hatwa
    
    //ama rastaw xo permessionek aday ba userk babe role chon?? ema la hamu systeme role bo nmuna adminmman haya awesh komala permessioneke haya
    // ema deen role adain ba useraka xoy permessionakani war agre
    // balam na lera cheman krdwa babe role yaksar permessionek adain ba user  atwanin chunka user has many permession
    // bo nmuna mhamad role usera admin nya balam amawe babe away bekama admin permessione  edit_poste bdame rastaw xo la regay amawa aykam
    public function  hasPermession($permession)
    {
        return $this->permessions()->where("name", $permession->name);
    }

    // amaya ka la gateka bakaram henawatawa ka hardu functione  hasPermession u hasPermessionThroughRole m bang krdotawa amana zarurn bas bo??
    // wtuma agar la regay rolakawa bu bo nmuna ama admina u adminesh flana permessione haya  yan or||  rastaw xo am usera flan permessione habu 
    public function  hasPermessionTo($permession)
    {
        return $this->hasPermession($permession) || $this->hasPermessionThroughRole($permession);
    }


     // ama zor bakar naya bas bo cheaka  ale aw useray login krdwa flan role haya  to rolekan la controllerawa boy anere asana
    public  function hasRole(...$roles)// spread operator bakar henawa ... chunka rolekan zorn akre array bn ta ware bgre
    {

        foreach ($roles as $role) {

            if ($this->roles->contains('name', $role)) {

                return true;
            }
        }
        return false;
    }

    

    // am dwanay zherawash relation ship n bo user    user has many role   and user has many permession
    public function  roles()
    {

        return $this->belongsToMany(roles::class, 'user_roles', 'user_id', 'role_id');
    }

    public function permessions()
    {
        return $this->belongsToMany(permessions::class, 'user_permessions', 'user_id', 'permession_id');
    }
}
