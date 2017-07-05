<?php

class User_model extends SimpleModel
{

    public $_table = 'users';
    public $primary_key = 'id';
    protected $soft_delete = false;
    protected $validate = array(
        array(
            'field' => 'first_name',
            'label' => 'First name',
            'rules' => 'trim|required',
        ),
        array(
            'field' => 'last_name',
            'label' => 'Last name',
            'rules' => 'trim|required',
        ),
        array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'trim|is_unique[users.email]',
        ),
        array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'trim|required',
        ),
        array(
            'field' => 'country_id',
            'label' => 'Country',
            'rules' => 'trim|required',
        ),
        array(
            'field' => 'city_id',
            'label' => 'City',
            'rules' => 'trim|required',
        ),
        array(
            'field' => 'sex',
            'label' => 'Sex',
            'rules' => 'trim|required',
        ),
        array(
            'field' => 'dob',
            'label' => 'Day of birth',
            'rules' => 'trim|required',
        ),
    );
    protected $before_create = array(
        'prepareUserInfo'
    );
    protected $before_update = [];
    protected $after_create = [];
    protected $after_get = [
        'getLastVisit',
    ];
    protected $belongs_to = [
        'city' => ['model' => 'cities', 'primary_key' => 'city_id'],
        'country' => ['model' => 'countries', 'primary_key' => 'country_id'],
    ];
    protected $has_many = [
        'sessions' => ['model' => 'user_sessions_model', 'primary_key' => 'user_id'],
    ];

    private $_passwordCost = 16;

    public $login = false;
    public $id = null;
    public $info = null;

    public function __construct()
    {
        parent::__construct();
        if ((php_sapi_name() === 'cli')) {
            return;
        }

        // Loading model
        $this->load->model('user_sessions_model', 'user_sessions');
        $this->load->model('user_stat_model', 'user_stat');

        // Check login state
        if (!$this->isLogin() && !$this->checkAccess()) {
            $this->session->set_userdata(array(
                'redirect_uri' => $this->uri->uri_string(),
                'redirect_data' => array('GET' => $this->input->get(), 'POST' => $this->input->post()),
            ));
            redirect(base_url("login"));
            exit;
        }

        $formData = $this->session->userdata('redirect_data');
        if ($formData !== false) {
            if ($formData['GET']) {
                $_GET = $formData['GET'];
            }
            if ($formData['POST']) {
                $_POST = $formData['POST'];
            }
            $this->session->unset_userdata('redirect_data');
        }
        unset($formData);
    }

    private function checkAccess()
    {
        $accessListForGuest = [
            'login',
            'register',
            '',
        ];
        $uri = $this->uri->uri_string();

        // Is there a literal match?  If so we're done
        if (in_array($uri, $accessListForGuest)) {
            return true;
        }
        return false;
    }

    public function goLogin($email, $password, $isHash = false)
    {
        $user = $this->get_by([
            'email' => $email,
        ]);

        if (!$user || empty($user)) {
            return false;
        }

        if (!$isHash && !password_verify($password, $user->password)) {
            return false;
        }

        $hash = '';
        if ($isHash) {
            if (!$this->user_sessions->checkHash((int)$user->id, $password)) {
                return false;
            }
            $hash = $password;
        } else {
            $hash = $this->user_sessions->findSession($user->id);
            if (!$hash) {
                $hash = md5('fsafasf90' . $user->id . time() . microtime(true));
                $this->user_sessions->createSession($user, $hash);
            }
        }


        $this->user_stat->addVisit($user);

        $this->login = true;
        $this->info = $user;
        $this->id = $user->id;
        $this->session->set_userdata([
            'email' => $email,
            'hash' => $hash,
        ]);
        return true;
    }

    public function logout()
    {
        if (is_null($this->id)) {
            return true;
        }
        $this->user_sessions->closeSession($this->id, $this->session->userdata('hash'));
        $this->session->unset_userdata([
            'email',
            'hash',
        ]);
        $this->login = false;
        $this->info = null;
        $this->id = null;
        return true;
    }

    public function isLogin()
    {
        if (!empty($this->id)) {
            return true;
        }
        $email = $this->session->userdata('email');
        $hash = $this->session->userdata('hash');
        if (!$email || !$hash) {
            $this->logout();
            return false;
        }
        $isLogin = $this->goLogin($email, $hash, true);
        if (!$isLogin) {
            $this->logout();
            return false;
        }
        return true;
    }

    protected function prepareUserInfo($data)
    {
        $ip = ip2long($this->input->ip_address());
        $date = date('Y-m-d H:i:s');
        if (is_array($data)) {
            $data['register_date'] = $date;
            $data['register_ip'] = $ip;
            $data['password'] = $this->getPasswordHash($data['password']);
        }
        if (is_object($data)) {
            $data->register_date = $date;
            $data->register_ip = $ip;
            $data->password = $this->getPasswordHash($data->password);
        }
        return $data;
    }

    protected function getLastVisit($row)
    {
        $lastVisit = $this->user_sessions->limit(1)->order_by('last_visit', 'DESC')->get_by([
            'user_id' => is_array($row) ? (int)$row['id'] : (int)$row->id
        ]);
        if (empty($lastVisit)) {
            $lastVisit = new \STDClass;
            $lastVisit->last_visit = 'No visit';
        }
        if (is_array($row)) {
            $row['last_visit'] = $lastVisit->last_visit;
        }
        if (is_object($row)) {
            $row->last_visit = $lastVisit->last_visit;
        }
        return $row;
    }

    public function stopEmailValidation($row = array())
    {
        foreach ($this->validate as $k => $v) {
            if ($v['field'] == 'email') {
                unset($this->validate[$k]);
            }
        }
    }

    public function isAdmin()
    {
        return !is_null($this->info) ? $this->info->is_admin == 1 : false;
    }

    public function getPasswordHash($password)
    {
        return password_hash($password, CRYPT_BLOWFISH, ["cost" => $this->_passwordCost]);
    }

    public function getRegisterStat($period = 'today')
    {

        $where = '';
        switch ($period) {
            case 'today':
            default:
                $period = date('Y-m-d');
                $where = '(`register_date` >=\'' . $period .
                    ' 00:00:00\' AND `register_date` <= \'' . $period . ' 23:59:59\')';
                break;
            case 'week':
                $this->load->helper('date');
                $period = getStartAndEndDate(date('Y'), date('W'));
                $where = '(`register_date` >=\'' . $period[0] .
                    ' 00:00:00\' AND `register_date` <= \'' . $period[1] . ' 23:59:59\')';
                break;
            case 'month':
                $period = [
                    date('Y-m-01'),
                    date('Y-m-t'),
                ];
                $where = '(`register_date` >=\'' . $period[0] .
                    ' 00:00:00\' AND `register_date` <= \'' . $period[1] . ' 23:59:59\')';
        }
        $query = $query = $this->_database->query('
        SELECT
        DATE_FORMAT(register_date, \'%Y-%m\') as `date`,
        COUNT(*) as users_count,
        CONCAT(cu.name, \'--\', ct.name) as `city`
        FROM `users`
        INNER JOIN cities as ct on ct.id=users.city_id
        INNER JOIN countries as cu ON cu.id=ct.country_id
        WHERE 1=1 ' . (!empty($where) ? ' AND ' . $where : '') . '
        GROUP BY DATE_FORMAT(`register_date`, \'%Y-%m\'), ct.id
        ORDER BY `date` ASC
        ');

        $result = [];

        if ($query) {
            $query = $query->result();


            foreach ($query as $row) {
                if (empty($result[$row->date])) {
                    $result[$row->date] = [];
                }
                if (empty($result[$row->date][$row->city])) {
                    $result[$row->date][$row->city] = 0;
                }
                $result[$row->date][$row->city] += $row->users_count;
            }
        }

        return $result;
    }
}
