<?php
namespace App\Repositories;

interface UserRepositoryInterface {
    public function get_all_users();

    public function get_user_by_id($id);

    public function append_user_comments($id, $comments);
    
    public function first_or_create($collection);
    
    public function create_or_update($collection, $id);

    public function delete($id);
}