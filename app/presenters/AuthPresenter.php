<?php

/**
 * autorizacni presenter
 *
 * @author runt
 */
class AuthPresenter extends Presenter {

    /** @persistent */
    public $backlink='';

    // persistentni promenne
    public static function getPersistentParams(){
        return array('backlink');
    }


    public function actionLogin($backlink){

//        Debug::dump($backlink);
        $form = new AppForm($this,'form');
        
        $form->addText('username','Benutzername')
        ->addRule(Form::FILLED,'geben Sie Benutzername ein');
        
        $form->addPassword('password','Kennwort')
        ->addRule(Form::FILLED,'bitte geben Sie Kennwort ein');
        
        $form->addSubmit('login', 'anmelden');
        $form->onSubmit[] = array($this,'loginFormSubmitted');
        $form->addProtection('Bitte Anmelden');
        $this->template->form = $form;
        $this->template->title = 'Anmelden';
    }
    
    /**
     *
     * @param AppForm $form
     */
    public function loginFormSubmitted($form){
        try{
            $user = Environment::getUser();
            $user->authenticate($form['username']->getValue(),$form['password']->getValue());
            $this->getApplication()->restoreRequest($this->backlink);
            $this->redirect('Default:');
        }
        catch(AuthenticationException $e){
            $form->addError($e->getMessage());
        }
    }

    protected function beforeRender(){

        $this->template->registerFilter('Nette\Templates\CurlyBracketsFilter::invoke');
        $user = Environment::getUser();
        $authenticated = $user->isAuthenticated();
        if($authenticated)
            $authenticatedStr = 'authenticated';
        else
            $authenticatedStr = 'not authenticated';

        $rolesArray = $user->getRoles();
        $roles = join(',', $rolesArray);
        $this->template->userRoles = $roles;
        $this->template->userAuthenticatedStr = $authenticatedStr;
        $this->template->userAuthenticated = $authenticated;
        $this->template->formularName = $this->getName()."/".$this->getAction()."/".$this->getView();
        $this->template->viewName = $this->getView();
        $this->template->presenterName = $this->getName();
        $this->template->actionName = $this->getAction();

         parent::beforeRender();
    }

    public function actionLogout(){
        $user = Environment::getUser();
        $user->signOut();
        $this->redirect('login');
    }
}
?>
