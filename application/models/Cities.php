<?php
class Cities extends SimpleModel
{
    public $_table = 'cities';
    protected $primary_key = 'id';
    protected $soft_delete = false;

    protected $belongs_to = [
        'country' => ['model' => 'countries', 'primary_key' => 'country_id'],
    ];
}
