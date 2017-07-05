<?php
class User_sessions_model extends SimpleModel
{

    public $_table = 'users_sessions';
    public $primary_key = 'id';
    protected $soft_delete = true;
    protected $soft_delete_key = 'closed';


    public function findSession($userId)
    {
        $testRow = $this->get_by([
            'user_id' => (int)$userId,
            'ip' => ip2long($this->input->ip_address()),
            'user_agent' => $this->input->user_agent(),
        ]);
        if ($testRow && !empty($testRow)) {
            return $testRow->hash;
        }
        return false;
    }

    public function checkHash($userId, $hash)
    {
        $testRow = $this->get_by([
            'hash' => $hash,
            'user_id' => $userId,
        ]);
        if (!$testRow || empty($testRow)) {
            return false;
        }
        $this->updateLastVisit($testRow);
        return true;
    }

    public function createSession($user, $hash)
    {
        $this->insert([
            'hash' => $hash,
            'user_id' => $user->id,
            'ip' => ip2long($this->input->ip_address()),
            'last_visit' => date('Y-m-d H:i:s'),
            'logged_in' => date('Y-m-d H:i:s'),
            'user_agent' => $this->input->user_agent(),
        ]);
    }

    public function updateLastVisit($row)
    {
        $this->update($row->id, [
            'last_visit' => date('Y-m-d H:i:s'),
            'ip' => ip2long($this->input->ip_address()),
        ]);
    }

    public function closeSession($userId, $hash)
    {
        $this->delete_by([
            'hash' => $hash,
            'user_id' => $userId,
        ]);
    }
}
