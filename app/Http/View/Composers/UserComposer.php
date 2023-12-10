<?php
namespace App\Http\View\Composers;

use Illuminate\View\View;
use Auth;

class UserComposer
{
    public function compose(View $view)
    {
        $userType = $this->determineUserType(); // Sua lógica para determinar o tipo de usuário
        $userName = $this->determineUserName(); 
        $isAdmin = $this->determineIsAdmin();
        $view->with('userType', $userType)->with('userName', $userName)->with('isAdmin', $isAdmin);
    }

    protected function determineUserType()
    {
        if (Auth::check()) {
            $pessoa = Auth::user()->pessoa;

            if ($pessoa->isproprietario == true) {
                return 'proprietario';
            } else {
                return 'cliente';
            }
        }
        else
        {
            return 'visitante';
        }
    }

    protected function determineUserName()
    {
        if (Auth::check()) {
            $pessoa = Auth::user()->pessoa;
            return $pessoa->nome;
        }
        else
        {
            return 'Visitante';
        }
    }

    protected function determineIsAdmin()
    {
        if (Auth::check()) {
            $user = Auth::user();
            return $user->isadmin;
        }
        else
        {
            return false;
        }
    }
}
