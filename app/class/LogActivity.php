<?php

class LogActivity
{
    public $db;


    public function setDbHelper($dbHelper) : self
    {
        $this->db = $dbHelper;

        return $this;
    }

    public function setLog(string $logContent) : self
    {
        $this->db->insert('log_activity', ['time' => date('Y-m-d H:i:s'), 'log' => $logContent]);

        return $this;
    }
}