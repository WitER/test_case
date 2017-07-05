<?php
class Countries extends SimpleModel
{
    public $_table = 'countries';
    protected $primary_key = 'id';
    protected $soft_delete = false;

    protected $has_many = [
        'cities' => ['model' => 'cities', 'primary_key' => 'country_id'],
    ];

    public function delete($id)
    {
        $delete = parent::delete($id);
        if ($delete) {
            $this->load->model('cities');
            $this->cities->delete_by([
                'country_id' => $id,
            ]);
        }
        return $delete;
    }

    public function delete_by()
    {
        $countries = $this->get_by();
        if (!$countries || empty($countries)) {
            return false;
        }
        $delete = parent::delete_by();
        if ($delete) {
            $this->load->model('cities');
            foreach ($countries as $country) {
                $this->cities->delete_by([
                    'country_id' => $country->id,
                ]);
            }
        }
        return $delete;
    }
}
