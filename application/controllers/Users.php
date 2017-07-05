<?php

class Users extends PanelController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if (!$this->user_model->isAdmin()) {
            show_404();
            exit;
        }
        $this->template->pageTitle('Users');
        $this->template->build(
            'users/index',
            [
                'users' => $this->user_model->with('city')->with('country')->get_all(),
            ]
        );
    }

    public function register()
    {
        if ($this->user_model->id) {
            redirect(base_url());
        }
        $this->load->library('form_validation');
        $user = new \STDClass();
        $user->id = null;
        $user->email = null;
        $user->first_name = null;
        $user->last_name = null;
        $user->dob = date('Y-m-d');
        $user->sex = null;
        $user->password = null;
        $user->country_id = null;
        $user->city_id = null;

        if (!empty($this->input->post())) {
            $data = $this->input->post();
            foreach ($data as $k => $v) {
                $user->{$k} = $v;
            }
            if ($this->user_model->validate($user)) {
                $user->dob = date('Y-m-d', strtotime($user->dob . ' 00:00:00'));
                $this->user_model->insert($user);
                redirect('login');
            }
        }

        $this->load->model('countries');
        $countries = $this->countries->with('cities')->get_all();
        $cities = [];
        foreach ($countries as $country) {
            $cities[$country->id] = $country->cities;
        }
        $cities = json_encode($cities);

        $this->template->pageTitle('Register');
        $this->template->append_styles([
            '/assets/vendor/chosen/chosen.min.css',
        ]);
        $this->template->append_scripts([
            '/assets/vendor/chosen/chosen.jquery.min.js',
        ]);

        $this->template->append_inline_script("
$(document).ready(function () {
    var cities = " . $cities . ";
    $('#countries').chosen();
    $('#cities').chosen();
    $('#countries').on('change', function(event, data){
        // First check if data exists, because if the change event
        // isn't triggered by Chosen `data` is undefined
        if(data){
            if(data.selected != ''){
                $('#cities').empty();
                if (cities[data.selected] != undefined) {
                    $.each(cities[data.selected], function (i, v) {
                        $('#cities').append('<option value=' + v.id + '>' + v.name + '</option>');
                    });
                    $('#cities').trigger('chosen:updated');
                    //$('#cities').show();
                }
            }else{
                //$('#cities').hide();
            }
        }
    });
});
        ");
        $this->template->build(
            'users/register',
            [
                'user' => $user,
                'countries' => $countries,
            ]
        );
    }

    public function login()
    {
        if ($this->user_model->id) {
            redirect(base_url());
        }
        $this->load->library('form_validation');

        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Пароль', 'trim|required');

        $email = '';
        $message = '';

        if (!empty($this->input->post())) {
            $email = $this->input->post('email');
            $password = $this->input->post('password');

            if ($this->form_validation->run() && $this->user_model->goLogin($email, $password)) {
                $redirectUri = $this->session->userdata('redirect_uri');
                if (!$redirectUri) {
                    $redirectUri = $this->input->get('redirect');
                }
                if ($redirectUri) {
                    $this->session->unset_userdata('redirect_uri');
                    redirect(base_url($redirectUri), 'refresh');
                }
                redirect("/");
            }
            $message = 'Not valid email or password';
        }

        $this->template->pageTitle('Log In');
        $this->template->build(
            'users/login',
            [
                'email' => $email,
                'message' => $message,
            ]
        );
    }

    public function logout()
    {
        $this->user_model->logout();
        redirect(base_url());
    }
}
