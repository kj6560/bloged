<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model as Eloquent;
class Conference extends Eloquent
{
	
	protected  $table = "conference";
    // CRUD OPERATIONS
	public function create(array $data)
	{
		
	}
	
	public function read(int $id)
	{
		$data = Conference::all();

		return $data;
	}
	
	
}