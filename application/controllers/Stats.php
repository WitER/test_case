<?php

class Stats extends PanelController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->model('user_stat_model', 'user_stat');
        $weekViews = $this->user_stat->getViewsStat();
        $todayRegister = $this->user_model->getRegisterStat();

        $this->template->pageTitle('Stats');
        $this->template->build(
            'stats',
            [
                'weekViews' => $weekViews,
                'todayRegister' => $todayRegister,
            ]
        );
    }
}
