<?php

class CTaskController
{

    private $m_iUserID, $m_iTaskID;

    public function __construct( int $m_iUserID, int $m_iTaskID )
    {
        $this->m_iUserID = $m_iUserID;
        $this->m_iTaskID = $m_iTaskID;
    }

    public function IsValid( )
    {
        return true;
    }

    public function GetTasks( )
    {
        $m_aTasks = array
        (
            array
            (
                "context" => "Однажды дед насрал в коляску. Сколько говна в коляске?",
                "type" => 0,
                "options" => array
                (
                    "Много",
                    "Не очень много",
                    "Вообще нету"
                ),
            )
        );

        // function routine

        return $m_aTasks;
    }

}