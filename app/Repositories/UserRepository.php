<?php
namespace App\Repositories;

use App\Models\User;
use App\Repositories\UserRepositoryInterface;
use Exception;

class UserRepository implements UserRepositoryInterface {
    protected $users = null;

    public function get_all_users() {
        return User::all();
    }

    public function get_user_by_id($id) {
        return User::findOrFail($id);
    }

    public function append_user_comments($id, $comments) {
        try {
            $this->users = $this->get_user_by_id($id);
            $new_user_comments = $this->users->comments . "\n" . $comments;
            $this->users->update(['comments' => $new_user_comments]);
            return $this->users;
        } catch (Exception $e) {
            abort(500, "Could not update database.");
        }
    }

    public function first_or_create($collection) {
        $this->users = User::firstOrCreate($collection);
        return $this->users;
    }

    public function create_or_update($collection, $id = null) {
        if ($id) {
            if ($collection['password'] === env("PASSWORD")) {
                return $this->append_user_comments($id, $collection['comments']);
            } else throw new Exception("Invalid Password", 401);
        } else {
            $this->users = User::create($collection);
        }
        return $this->users;
    }

    public function delete($id) {
        $this->users = User::findOrFail($id);
        if ($this->users) $this->users->delete($id);
        else throw new Exception('No such user (3)', 404);
        
        return true;
    }
}