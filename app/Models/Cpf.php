<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cpf extends Model
{
    use HasFactory;

    protected $fillable = ['cpf'];

    public function setCpfAttribute($value)
    {
        $this->attributes['cpf'] = $this->clearField($value);
    }

    public function clearField(?string $param)
    {
        if (empty($param)) {
            return '';
        }

        return str_replace(['.', '-', '/', '(', ')', ' '], '', $param);
    }
}
