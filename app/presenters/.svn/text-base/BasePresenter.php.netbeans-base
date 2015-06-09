<?php
/**
 * zajisti pripojeni k db a nastaveni filtru pro sablony
 */
abstract class BasePresenter extends Presenter
{

    /** @var AplModel */
    protected $model;
    /**
     *
     * @var Acl
     */
    public $acl;
    /**
     *
     * @var Benutzer
     */
    public $user;


protected function startup() {

    parent::startup();

    $user = Environment::getUser();
    $acl  = Environment::getService('Nette\Security\IAuthorizator');

    $this->acl = $acl;
    $this->user = $user;


//    Debug::dump($user);
    
    if (!$user->isAuthenticated()) {
        if ($user->getSignOutReason() === User::INACTIVITY) {
            $this->flashMessage('Sie werden wegen inaktivitaet abgemeldet. Melden Sie sich wieder an.');
        }
        $backlink = $this->getApplication()->storeRequest();
//        $r = $this->getParam($backlink);
//        Debug::dump($r);
        $this->redirect('Auth:login', $backlink);
    }

    $this->model = new AplModel();
}

    protected function beforeRender()
    {
        $this->template->registerFilter('Nette\Templates\CurlyBracketsFilter::invoke');
        $this->template->presenterName = $this->getName();
        $this->template->actionName = $this->getAction();
        $this->template->userRealname = '';
        $user = Environment::getUser();
        $authenticated = $user->isAuthenticated();
        if($authenticated){
            $authenticatedStr = 'authenticated';
            $this->template->userRealname = $user->getIdentity()->getName();
        }
        else
            $authenticatedStr = 'not authenticated';
        $rolesArray = $user->getRoles();
        $roles = join(',', $rolesArray);
        $this->template->userRoles = $roles;
        $this->template->userAuthenticatedStr = $authenticatedStr;
        $this->template->userAuthenticated = $authenticated;
        $this->template->formularName = $this->getName()."/".$this->getAction()."/".$this->getView();
    }

    public function fillSecClasses($form_id) {
        $elements = $this->model->getElementsIDForFormID($form_id);
        $privilegesArray = $this->model->getPrivilegesArray();
        $allowedArray = array();
        foreach ($elements as $elementId) {
            $resource = $form_id."_".$elementId;
            foreach ($privilegesArray as $privilege) {
                $allowedArray[$resource][$privilege] = $this->user->isAllowed($resource,$privilege)?'enabled':'disabled';
            }
        }
        
        // priprav class pro viditelnost
        $secClasses = array();
        $readOnlyArray = array();
        foreach($allowedArray as $resource=>$privileges) {
            foreach($privilegesArray as $privilege){
                $privileges[$privilege]=='enabled'?$secClasses[$privilege][$resource]=$privilege.'_allowed':$secClasses[$privilege][$resource]=$privilege.'_denied';
                //nastavit readonly vlastnost pokud bude schreiben disabled
//                if($privilege=='schreiben' && $privileges[$privilege]=='disabled')
//                    $readOnlyArray[$resource] = "readonly='readonly'";
//                else
//                    $readOnlyArray[$resource] = "readonly=''";
            }
        }

        return array('form_id'=>$form_id,'elements'=>$elements,'allowedarray'=>$allowedArray,'secclasses'=>$secClasses,'readonly'=>$readOnlyArray);
    }

    /**
     * @param FormControl $control
     * @param array security array
     */
    public function setSecurityAttributes($control,$sec){
        $elementName = $control->getName();
        $securityIndex = $sec['form_id']."_".$elementName;
        $control->getControlPrototype()->class($sec['secclasses']['lesen'][$securityIndex]);
        if($sec['secclasses']['editieren'][$securityIndex]=='editieren_denied')
            $control->getControlPrototype()->readonly='readonly';
    }
}