<?php

namespace App\Filters;

class WriteOffFilter extends QueryFilter
{

    public function location_id($id = null) {
//        return $this->builder->where('location_id', '=', $id);

        if ($id == 'Не выбрано') return $this->builder->where('location_id', '>', 0)->where('status_id', '=', 3);

        return $this->builder->when($id, function ($query) use($id) {
            $query->where('location_id', '=', $id)->where('status_id', '=', 3);
        });
    }

    public function type_id($id = null) {

        if ($id == 'Не выбрано') return $this->builder->where('type_id', '>', 0)->where('status_id', '=', 3);

        return $this->builder->when($id, function ($query) use($id) {
            $query->where('type_id', '=', $id)->where('status_id', '=', 3);
        });
    }
}
