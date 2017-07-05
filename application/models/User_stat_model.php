<?php
class User_stat_model extends SimpleModel
{

    public $_table = 'users_stat';
    public $primary_key = 'id';
    protected $soft_delete = false;

    public function addVisit($user)
    {
        $testRow = $this->get_by([
            'date' => date('Y-m-d'),
            'user_id' => (int)$user->id,
        ]);
        if (!$testRow || empty($testRow)) {
            $testRow = $this->insert([
                'user_id' => (int)$user->id,
                'date' => date('Y-m-d'),
            ]);
            $testRow = $this->get((int)$testRow);
        }
        if ($testRow) {
            $this->update((int)$testRow->id, [
                'visits' => (int)$testRow->visits + 1,
            ]);
        } else {
            log_message('error', 'Visit for user: ' . $user->id . ' is not created');
        }
    }

    public function getViewsStat($period = 'week')
    {
        $query = $this->select('
            date,
            COUNT(id) as users_count,
            SUM(visits) as views_count
        ', false)
            ->group_by('date')
            ->order_by('date');

        switch ($period) {
            case 'week':
            default:
                $this->load->helper('date');
                $period = getStartAndEndDate(date('Y'), date('W'));
                break;
            case 'month':
                $period = [
                    date('Y-m-01'),
                    date('Y-m-t'),
                ];
        }
        $stats = $query = $query->get_many_by([
            'date >=' => $period[0],
            'date <=' => $period[1],
        ]);
        $result = [];
        $period   = new DatePeriod(
            new DateTime($period[0] . ' 00:00:00'),
            new DateInterval('P1D'),
            new DateTime($period[1] . ' 23:59:59')
        );
        foreach ($period as $date) {
            $dt =$date->format('Y-m-d');
            $emptyObj = new STDClass();
            $emptyObj->date = $dt;
            $emptyObj->users_count = 0;
            $emptyObj->views_count = 0;

            $result[$dt] = $emptyObj;
            unset($emptyObj);
        }

        foreach ($stats as $stat) {
            $result[$stat->date] = $stat;
        }


        unset($stats, $period);
        return $result;
    }
}
