<?php
namespace App\Models;

use CodeIgniter\Model;

class Delegates extends Model
{
    protected $table = 'delegates';
    protected $primaryKey = 'id';

    protected $returnType = 'array';
    protected $useSoftDeletes = true;
<<<<<<< HEAD
    protected $allowedFields = ['fname','lname','lb','phone','email','category','school','ref','paid','gender'];
=======
    protected $allowedFields = ['fname','lname','lb','phone','email','category','school','ref','old','paid','gender'];
>>>>>>> 5b6c122 (2022)

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
