<?php 

namespace App\Permits;

use App\Permit;
use App\Role;

trait HasPermitsTrait {

   public function givePermitsTo(... $permits) {

    $permits = $this->getAllPermits($permits);
    dd($permits);
    if($permits === null) {
      return $this;
    }
    $this->permits()->saveMany($permits);
    return $this;
  }

  public function withdrawPermitsTo( ... $permits ) {

    $permits = $this->getAllPermits($permits);
    $this->permits()->detach($permits);
    return $this;

  }

  public function refreshPermits( ... $permits ) {

    $this->permits()->detach();
    return $this->givePermitsTo($permits);
  }

  public function hasPermitTo($permit) {

    return $this->hasPermitThroughRole($permit) || $this->hasPermit($permit);
  }

  public function hasPermitThroughRole($permit) {

    foreach ($permit->roles as $role){
      if($this->roles->contains($role)) {
        return true;
      }
    }
    return false;
  }

  public function hasRole( ... $roles ) {

    foreach ($roles as $role) {
      if ($this->roles->contains('slug', $role)) {
        return true;
      }
    }
    return false;
  }

  public function roles() {

    return $this->belongsToMany(Role::class,'users_roles');

  }
  public function permits() {

    return $this->belongsToMany(Permit::class,'users_permits');

  }
  protected function hasPermit($permit) {

    return (bool) $this->permits->where('slug', $permit->slug)->count();
  }

  protected function getAllPermits(array $permits) {

    return Permit::whereIn('slug',$permits)->get();
    
  }

}