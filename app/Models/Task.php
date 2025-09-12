<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Model Task
 * Representa uma tarefa no banco de dados
 */
class Task extends Model
{
    use SoftDeletes; // Permite "remoção suave" sem apagar o registro

    protected $fillable = ['title', 'description', 'status'];

    protected $casts = ['id' => 'integer'];
}
