<?php

/**
 * Description of AccessPresenter
 *
 * @author runt
 */
class AccessPresenter extends Presenter {
       /** @var AplModel */
    protected $model;

    protected function startup(){
        $this->model = new AplModel();
    }

    public function actionGetUsers(){
        $users = $this->model->getAccessMitarbeiterArray();
        $this->template->users = $users;
    }

    public function actionDefault(){
        
    }

    protected function beforeRender()
    {
        $this->template->registerFilter('Nette\Templates\CurlyBracketsFilter::invoke');
        $this->setLayout(FALSE);
    }
}
?>
