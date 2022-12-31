<?php

namespace App\Http\Controllers\Admin\Traits;

trait AdminCrudTrait
{
    public function removeActionsCrud()
    {
        $this->crud->removeButton('show');
        if (!backpack_user()->officePermission(get_class($this), 'create')) {
            $this->crud->removeButton('create');
        }
        if (!backpack_user()->officePermission(get_class($this), 'update')) {
            $this->crud->removeButton('update');
        }
        if (!backpack_user()->officePermission(get_class($this), 'delete')) {
            $this->crud->removeButton('delete');
        }
    }
}
