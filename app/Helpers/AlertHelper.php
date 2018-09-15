<?php

namespace App\Helpers;


use Illuminate\Session\SessionManager;
use Illuminate\View\Factory;

class AlertHelper
{
    protected $session;
    protected $view;

    function __construct(SessionManager $sessionManager, Factory $view)
    {
        $this->session = $sessionManager;
        $this->view = $view;
    }

    /**Setea el mensaje
     * @param $msg
     * @param $tipo [exito, alerta, error, informacion]
     */
    public function setMessage($msg, $tipo)
    {
        switch ($tipo) {
            case 'exito';
                $clase = 'alert-success';
                $tipo = 'Éxito';
                break;
            case 'alerta':
                $clase = 'alert-warning';
                break;
            case 'error':
                $clase = 'alert-danger';
                $tipo = 'Error';
                break;
            case 'informacion':
                $clase = 'alert-info';
                $tipo = 'Información';
                break;
        }
        $this->session->flash('alert', compact('msg', 'clase', 'tipo'));
    }
    public function render()
    {
        return $this->view->make('components.alert', $this->session->get('alert'));
    }
}
